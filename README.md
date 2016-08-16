# WHCMS-Helper

A PHP class help you work with WHCMS External API better.

## Example Code
With API Key
```php
$whcms_api = new WhcmsHelper('http://yourdomain.com/whcms/');
$whcms_api->username = 'whcms_username';
$whcms_api->password = 'whcms_password';
$whcms_api->ip_access = false;
$whcms_api->api_key = 'your_api_key'; //Your API key in WHCMS configuration.php file.
$stats = $whcms_api->sendRequest('getstats');
```
Without API Key
```php
$whcms_api = new WhcmsHelper('http://yourdomain.com/whcms/');
$whcms_api->username = 'whcms_username';
$whcms_api->password = 'whcms_password';
$stats = $whcms_api->sendRequest('getstats');
```
_I code this class for learning purpose so all contributors are welcome to join._
