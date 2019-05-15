<?php
/**
 *
 * phpBB Studio - GitHub OAuth2 light. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbstudio\goa\auth\provider\oauth\service;

use phpbb\auth\provider\oauth\service\exception;
use OAuth\Common\Http\Exception\TokenResponseException;
use OAuth\Common\Exception\Exception as AccountResponseException;
/**
* phpBB Studio - GitHub OAuth2 light service
*/
class github extends \phpbb\auth\provider\oauth\service\base
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \phpbb\request\request */
	protected $request;

	/**
	 * Constructor.
	 *
	 * @param  \phpbb\config\config			$config		Config object
	 * @param  \phpbb\language\language		$lang		Language object
	 * @param  \phpbb\request\request		$request	Request object
	 * @return void
	 * @access public
	 */
	public function __construct(
		\phpbb\config\config $config,
		\phpbb\language\language $lang,
		\phpbb\request\request_interface $request)
	{
		$this->config	= $config;
		$this->lang		= $lang;
		$this->request	= $request;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_service_credentials()
	{
		return array(
			'key'		=> $this->config['auth_oauth_studio_github_key'],
			'secret'	=> $this->config['auth_oauth_studio_github_secret'],
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function perform_auth_login()
	{
		if (!($this->service_provider instanceof \OAuth\OAuth2\Service\GitHub))
		{
			throw new exception('AUTH_PROVIDER_OAUTH_ERROR_INVALID_SERVICE_TYPE');
		}

		/* This was a callback request from GitHub, get the token */
		try
		{
			$this->service_provider->requestAccessToken($this->request->variable('code', ''));
		}
		catch (TokenResponseException $e)
		{
			trigger_error($this->lang->lang('PHPBBSTUDIO_GOA_EXCEPTION_TOKEN', $e->getMessage()), E_USER_WARNING);
		}

		$result['login'] = '';

		/* Send a request with it */
		try
		{
			$result = json_decode($this->service_provider->request('/user'), true);
		}
		catch (AccountResponseException $e)
		{
			trigger_error($this->lang->lang('PHPBBSTUDIO_GOA_EXCEPTION_USER_INFO', $e->getMessage()), E_USER_WARNING);
		}

		/**
		 * https://developer.github.com/v3/oauth_authorizations/#response-8
		 * Return the unique identifier returned from GitHub
		 * Username
		 */
		return $result['login'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function perform_token_auth()
	{
		if (!($this->service_provider instanceof \OAuth\OAuth2\Service\GitHub))
		{
			throw new exception('AUTH_PROVIDER_OAUTH_ERROR_INVALID_SERVICE_TYPE');
		}

		$result['login'] = '';

		/* Send a request with it */
		try
		{
			$result = json_decode($this->service_provider->request('/user'), true);
		}
		catch (AccountResponseException $e)
		{
			trigger_error($this->lang->lang('PHPBBSTUDIO_GOA_EXCEPTION_USER_INFO', $e->getMessage()), E_USER_WARNING);
		}

		/**
		 * https://developer.github.com/v3/oauth_authorizations/#response-8
		 * Return the unique identifier returned from GitHub
		 * Username
		 */
		return $result['login'];
	}
}
