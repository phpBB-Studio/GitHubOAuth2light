<?php
/**
 *
 * phpBB Studio - GitHub OAuth2 light. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbstudio\goa\migrations;

class install_config extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return $this->config->offsetExists('auth_oauth_github_key');
	}

	public static function depends_on()
	{
		return array('\phpbb\db\migration\data\v32x\v325rc1');
	}

	/**
	 * Add, update or delete data stored in the database during extension installation.
	 *
	 * @return array Array of data update instructions
	 */
	public function update_data()
	{
		return array(
			array('config.add', array('auth_oauth_github_key', '')),
			array('config.add', array('auth_oauth_github_secret', '')),
		);
	}
}
