<?php

namespace UserControllerSpace;

use UserModelNamespace\UserModel;
use DateTime;
use onesignal\client\api\DefaultApi;
use onesignal\client\Configuration;
use onesignal\client\model\GetNotificationRequestBody;
use onesignal\client\model\Notification;
use onesignal\client\model\StringMap;
use onesignal\client\model\Player;
use onesignal\client\model\UpdatePlayerTagsRequestBody;
use onesignal\client\model\ExportPlayersRequestBody;
use onesignal\client\model\Segment;
use onesignal\client\model\FilterExpressions;
use PHPUnit\Framework\TestCase;
use GuzzleHttp;


class UserController
{
    private $con;
    public function __construct()
    {
        global $con;
        $this->con = $con;
    }
    function home()
    {
        require_once('app/views/home.php');
        $this->executeFilter();
    }
    /**
     * The following function creates a new user and connects to the UserModel
     */
    function create()
    {
        if (isset($_POST['submit'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $store = new UserModel;
            $errorMsg = $store->createUser($this->con, $first_name, $last_name, $email);
            if ($errorMsg === "") {
                // Enter push notification function here
                $this->sendPush($first_name);
                require_once('app/views/success.php');
            } else require_once('app/views/home.php');
            setcookie("FirstName", $first_name, time() + 20, "/");
        }
    }

    public function sendPush($first_name)
    {
        $config = Configuration::getDefaultConfiguration()
            ->setAppKeyToken(APP_KEY_TOKEN);

        $apiInstance = new DefaultApi(
            new GuzzleHttp\Client(),
            $config
        );
        $notification = $this->createNotification('User: ' . $first_name . ' has subscribed!');
       
        $result = $apiInstance->createNotification($notification);
        error_log(print_r($result, true));
    }

    function createNotification($enContent): Notification
    {
        $content = new StringMap();
        $content->setEn($enContent);

        $notification = new Notification();
        $notification->setAppId(APP_ID);
        $notification->setContents($content);
        $notification->setIncludedSegments(['All']);

        return $notification;
    }


    /**
     * @param callable Parameter will lead code to the next step, if middleware conditions are met
     * @return mixed Returning a possible function or string.
     */
    function cookieMiddleware($next)
    {
        return isset($_COOKIE["FirstName"]) ? call_user_func($next) : "No Cookie Set! ";
    }

    /**
     * Defines the function to be executed if middleware conditions are met
     * Example, return include('XYZ')
     */
    function echoCookie()
    {
        echo "Hello " . $_COOKIE["FirstName"] . "  ";
    }

    /**
     * Middleware Controller
     */
    function executeFilter()
    {
        $response = $this->cookieMiddleware([$this, 'echoCookie']);
        // If a string is returned it's an error.  
        echo is_string($response) ? $response : $response;
    }
}
