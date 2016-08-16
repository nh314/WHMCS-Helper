<?php
/**
 * WHCMS External API Helper
 * PHP Version 5
 * 
 * @category WHCMS_Helper
 * @package  WHCMS_Helper
 * @author   Phan Nguyen <nh314@outlook.com>
 * @license  https://www.gnu.org/licenses/gpl.txt GPLv2 (or later) 
 * @link     https://github.com/parobit/WHCMS-Helper
 */


/**
 * WHCMS API Response Type
 * PHP Version 5
 * 
 * @category WHCMS_Helper
 * @package  WHCMS_Helper
 * @author   Phan Nguyen <nh314@outlook.com>
 * @license  https://www.gnu.org/licenses/gpl.txt GPLv2 (or later) 
 * @link     https://github.com/parobit/WHCMS-Helper
 */
abstract class ResponseType
{
    const JSON = 'json';
    const XML = 'xml';
}


/**
 * WHCMS External API Helper
 *
 * @category WHCMS_Helper
 * @package  WHCMS_Helper
 * @author   Phan Nguyen <nh314@outlook.com>
 * @license  https://www.gnu.org/licenses/gpl.txt GPLv2 (or later) 
 * @link     https://github.com/parobit/WHCMS-Helper
 */
class WhcmsHelper
{
    /**
     * WHCMS Url with trailing slash (e.g. http://yourdomain.com/billing/)
     *
     * @var $string
     */
    public $whcms_url;
    public $username, $password, $ip_access, $api_key, $res_type;

    /**
     * Initialize the class and set its properties.
     * 
     * @param string       $whcms_url WHCMS Url with trailing slash
     * @param string       $username  WHCMS Username
     * @param string       $password  WHCMS Password
     * @param boolean      $ip_access Enable WHCMS API ip access mode.
     * @param string       $api_key   API key in your WHCMS configuration.php file.
     * @param ResponseType $res_type  Use ResponseType::JSON or ResponseType::XML
     */
    function __construct(
        $whcms_url=null,
        $username=null, $password=null,
        $ip_access=true, $api_key = null,
        $res_type= ResponseType::JSON
    ) {
    
        $this->whcms_url = $whcms_url;
        $this->username = $this->username;
        $this->password = isset($password) ? md5($password) : null;
        $this->ip_access = $ip_access;
        $this->api_key = $api_key;
        $this->res_type = $res_type;
    }

    /**
     * Call WHCMS API
     * 
     * @param string       $action   Main action send to WHCMS API handler
     * @param array        $params   Array of attribute send to WHCMS API handler
     * @param ResponseType $res_type Use ResponseType::JSON or ResponseType::XML
     * 
     * @return mixed         An object created by decode response data.
     */
    public function sendRequest($action, $params = array(), $res_type = null)
    {
        $params['action'] = $action;
        $params['username'] = $this->username;
        $params['password'] = $this->password;
        $params['responsetype'] = isset($res_type) ? $res_type : $this->res_type;
        if ($this->ip_access!=true) {
            $params['accesskey'] = $this->api_key;
        }

        

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->whcms_url . 'includes/api.php');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

        $response = curl_exec($ch);
        
        if (curl_error($ch)) {            
            $data = array(
             'result' => 'error',
             'message' => curl_errno($ch) . ' - ' . curl_error($ch)
            );
            
            $response = $data;
        } else {
            $response = json_decode($response);    
        }
        curl_close($ch);
        return $response;
    }
}
?>