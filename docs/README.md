# phpBB Studio - GitHub OAuth2 light

## Requirements

phpBB >= 3.2.7, PHP extension intl, PHP extension cUrl, SSL/HTTPS enabled and capable site.

## Installation

Copy the extension to phpBB/ext/phpbbstudio/dol

Go to "ACP" > "Customise" > "Extensions" and enable the "phpBB Studio - GitHub OAuth2 light" extension.

## Application settings:

https://github.com/settings/developers

Copy and save the `Client ID` and `Client Secret` to use in the `ACP / client communication / authentication /` page.

## OAuth2 Redirects:

Two links is what you need to use in Redirects for the application to work.

Homepage URL
`https://www.example.com/board/`

Authorization callback URL
`https://www.example.com/board/ucp.php?mode=login&login=external&oauth_service=studio_github`


replace `http://www.example.com/board` with your Board's URL ;-D

## License

[GPLv2](license.txt)
