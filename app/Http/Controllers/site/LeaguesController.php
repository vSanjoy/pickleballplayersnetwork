<?php
/*
    * Class name    : LeaguesController
    * Purpose       : Users related details
    * Author        :
    * Created Date  :
    * Modified date :
*/
namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use Auth;
use Hash;
use \Validator;
use \Session;
use DB;
use App\Models\Cms;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\HomeCourt;
use App\Models\Availability;
use App\Models\UserAvailability;

class LeaguesController extends Controller
{
    use GeneralMethods;
    
    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct($data = null) {
        parent::__construct();

        // Variables assign for view page
        $this->shareVariables();

        $this->cmsModel     = new Cms();
        $this->userModel    = new User();
    }

    /*
        * Function name : findALeague
        * Purpose       : Find a league page
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function findALeague(Request $request) {
        $getMetaDetails = getMetaDetails('cms', 4);
        $cmsPage        = $this->cmsModel->where('id', 4)->first();

        return view('site.league.find_a_league', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
            ]);
    }

    
   
}