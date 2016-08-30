# WHMCS-Helper

This class can send requests to the WHMCS hosting management API.

It can send HTTP requests to the WHMCS API to perform arbitrary types of operations supported by the API.

The class can send requests either with the API key or not.

## Example Code
With API Key
```php
$whmcs_api = new WhmcsHelper('http://yourdomain.com/whcms/');
$whmcs_api->username = 'whcms_username';
$whmcs_api->password = 'whcms_password';
$whmcs_api->ip_access = false;
$whmcs_api->api_key = 'your_api_key'; //Your API key in WHCMS configuration.php file.
$stats = $whmcs_api->sendRequest('getstats');
```
Without API Key
```php
$whmcs_api = new WhmcsHelper('http://yourdomain.com/whcms/');
$whmcs_api->username = 'whcms_username';
$whmcs_api->password = 'whcms_password';
$stats = $whmcs_api->sendRequest('getstats');
```
_I code this class for learning purpose so all contributors are welcome to join._
