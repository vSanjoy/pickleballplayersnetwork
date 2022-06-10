<?php
/*
    # Company Name      :
    # Author            :
    # Created Date      :
    # Page/Class name   : Controller
    # Purpose           : Base controller to extend
*/

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $currentLang;
    private $setLang;
    public $websiteLanguages;
    
    public function __construct() {
        $this->websiteLanguages = config('global.WEBSITE_LANGUAGE');   
        \View::share(['websiteLanguages' => $this->websiteLanguages]);

        $segmentValue = \Request::segment(1);
        if ($segmentValue) {
            if (array_key_exists($segmentValue, $this->websiteLanguages)) {
                Session::put('websiteLang', '');
                Session::put('websiteLang', $segmentValue);
                \App::setLocale($segmentValue);
            } else {
                Session::put('websiteLang', '');
                Session::put('websiteLang', \App::getLocale());
                \App::setLocale(\App::getLocale());
            }
        }

        // Start :: All league related access availability
        $isAccessAvailable  = isAccessBlocked();
        \View::share(['isAccessAvailable' => $isAccessAvailable]);
        // End :: All league related access availability
    }

    /*
        * Function Name : generateToastMessage
        * Purpose       : This function is to generate Toast message
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : $type, $validationFailedMessages, $extraTitle = false
        * Return Value  : Mixed
    */
    public function generateToastMessage($type, $validationFailedMessages, $extraTitle = false) {
        switch($type) {
            case 'success':
                if (!$extraTitle) {
                    $extraTitle = trans('custom_admin.message_success');
                }
                toastr()->success($validationFailedMessages, $extraTitle.'!');
                break;
            case 'warning':
                if (!$extraTitle) {
                    $extraTitle = trans('custom_admin.message_warning');
                }
                toastr()->warning($validationFailedMessages, $extraTitle.'!');
                break;
            case 'error':
                if (!$extraTitle) {
                    $extraTitle = trans('custom_admin.message_error');
                }
                toastr()->error($validationFailedMessages, $extraTitle.'!');
                break;
            default:
                if (!$extraTitle) {
                    $extraTitle = trans('custom_admin.message_info');
                }
                toastr()->info($validationFailedMessages, $extraTitle.'!');
        }
    }

    /*
        * Function Name : getRandomPassword
        * Purpose       : This function is to generate random password
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : $type, $validationFailedMessages, $extraTitle = false
        * Return Value  : Mixed
    */
    public function getRandomPassword($stringLength = 8) {
        $capitalRandom = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 2)), 0, 2);
        $smallRandom   = substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 3)), 0, 3);
        $specailRandom = substr(str_shuffle(str_repeat("!@#$%^&*", 1)), 0, 1);
        $numberRandom  = substr(str_shuffle(str_repeat("0123456789", 1)), 0, 2);
        
        $randonString = $capitalRandom.$smallRandom.$specailRandom.$numberRandom;

        return $randonString;
    }

    /*
        * Function Name : OTP
        * Purpose       : This function is to generate OTP
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : $type, $validationFailedMessages, $extraTitle = false
        * Return Value  : Mixed
    */
    public function OTP($stringLength = 8) {
        $capitalRandom = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 2)), 0, 2);
        $smallRandom   = substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 3)), 0, 3);
        $numberRandom  = substr(str_shuffle(str_repeat("0123456789", 1)), 0, 2);
        
        $randonString = $capitalRandom.$smallRandom.$numberRandom;

        return $randonString;
    }

}
