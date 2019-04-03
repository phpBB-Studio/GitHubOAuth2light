<?php
/**
 *
 * phpBB Studio - GitHub OAuth2 light. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'AUTH_PROVIDER_OAUTH_SERVICE_GITHUB'	=> 'GitHub',

	'PHPBBSTUDIO_GOA_EXCEPTION_TOKEN'		=> 'Something went wrong requesting an Battle.net OAuth2 access token.<br>
												Original error message:<br>
												<samp class="error">%s</samp><br><br>
												<em>Did you perhaps refresh the page after linking an account?</em>',

	'PHPBBSTUDIO_GOA_EXCEPTION_USER_INFO'	=> 'Something went wrong requesting the Battle.net OAuth2 account information.<br><br>
												Original error message:<br>
												<samp class="error">%s</samp>',

	// Translators please do not change the following line, no need to translate it!
	'PHPBBSTUDIO_GOA_CREDIT_LINE'			=> '<a href="https://phpbbstudio.com">GitHub OAuth2 light</a> &copy; 2019 - phpBB Studio',
));
