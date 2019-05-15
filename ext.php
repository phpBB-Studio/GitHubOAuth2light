<?php
/**
 *
 * phpBB Studio - GitHub OAuth2 light. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbstudio\goa;

/**
 * phpBB Studio - GitHub OAuth2 light Extension base
 *
 * It is recommended to remove this file from
 * an extension if it is not going to be used.
 */
class ext extends \phpbb\extension\base
{
	/**
	 * Check whether the extension can be enabled.
	 * Provides meaningful(s) error message(s) and the back-link on failure.
	 * CLI and 3.1/3.2 compatible (we do not use the $lang object here on purpose)
	 *
	 * @return bool
	 */
	public function is_enableable()
	{
		$is_enableable = true;

		$user = $this->container->get('user');
		$user->add_lang_ext('phpbbstudio/goa', 'ext_require');
		$lang = $user->lang;

		if (!(phpbb_version_compare(PHPBB_VERSION, '3.2.7', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.3.0@dev', '<')))
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_PHPBB_VERSION', '3.2.7', '3.3.0@dev');
			$is_enableable = false;
		}

		if (!function_exists('curl_version'))
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_PHP_CURL');
			$is_enableable = false;
		}

		if (!@extension_loaded('intl'))
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_PHP_INTL');
			$is_enableable = false;
		}

		$url = generate_board_url(false);

		if (!$this->has_ssl($url))
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_SSL_STREAM');
			$is_enableable = false;
		}

		$user->lang = $lang;

		return $is_enableable;
	}

	/**
	 * Determine if the site is SSL capable
	 *
	 * https://stackoverflow.com/questions/1175096/how-to-find-out-if-youre-using-https-without-serverhttps
	 *
	 * @param  string	$url	The URL of this board
	 * @return bool				True if is capable or false otherwise
	 * @access protected
	 */
	protected function has_ssl($url)
	{
		/* take the URL down to the domain name */
		$domain = parse_url($url, PHP_URL_HOST);
		/* initialize the domain name as htppS'ed */
		$ch = curl_init('https://' . $domain);
		/* set the Returntransfer enabled for Curl */ 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		/* its a HEAD */
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD');
		/* no body */
		curl_setopt($ch, CURLOPT_NOBODY, true);
		/* in case of redirects */
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		/* turn on if debugging */
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		/* head only wanted */
		curl_setopt($ch, CURLOPT_HEADER, 1);
		/* we dont want to wait forever */
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

		curl_exec($ch);

		$header = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if ($header === 200)
		{
			return true;
		}
		return false;
	}
}
