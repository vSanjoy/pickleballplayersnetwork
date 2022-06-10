<?php
/*
    * Class name    : CitiesController
    * Purpose       : Home page of the website
    * Author        :
    * Created Date  :
    * Modified date :
*/
namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\Cms;
use App\Models\City;
use App\Models\Season;
use App\Models\PlayerLeagueAssignment;
use App\Models\PlayerLeagueAssignmentTeam;
use App\Models\User;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\PreferredHomeCourt;
use App\Models\Score;
use App\Models\ScoreSet;
use App\Jobs\SendCityLeagueMessage;
use App\Jobs\SendScoreToAllUsersInSpecificLeague;
use DataTables;

class CitiesController extends Controller
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
        $this->cityModel    = new City();
    }

    /*
        * Function name : index
        * Purpose       : Home page of the city
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data for the home page of a city
    */
    public function index(Request $request) {
        if (Session::get('cityId') == '') {
            return redirect()->route('site.home');
        } else {
            $cityId     = Session::get('cityId') ?? '';
            $stateId    = Session::get('stateId') ?? '';
            
            if ($cityId != '') {
                $cityDetails    = $this->cityModel->where(['id' => $cityId])->first();
                $cmsPage        = $this->cmsModel->where(['parent_id' => $cityId, 'is_home_page' => 'Y'])->first();
                if ($cmsPage != null) {
                    $getMetaDetails = getMetaDetails('cms', $cmsPage->id);
                } else {
                    $getMetaDetails = getMetaDetails('cms', 1);
                    $cmsPage        = $this->cmsModel->where('id', 1)->first();
                }
                
                return view('site.city_home', [
                    'title'             => $getMetaDetails['title'],
                    'metaKeywords'      => $getMetaDetails['metaKeywords'],
                    'metaDescription'   => $getMetaDetails['metaDescription'],
                    'cmsDetails'        => $cmsPage
                    ]);
            }
        }
    }
    
    /*
        * Function Name : partner
        * Purpose       : This function is get partner details
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function partner(Request $request, $citySlug = null) {
        $pageSlug = request()->segment(count(request()->segments()));

        $cityDetails    = $this->cityModel->where(['slug' => $citySlug])->first();
        $cmsPage        = $this->cmsModel->where(['parent_id' => $cityDetails->id, 'slug' => $pageSlug])->first();
        if ($cmsPage != null) {
            $getMetaDetails = getMetaDetails('cms', $cmsPage->id);
        } else {
            $getMetaDetails = getMetaDetails('cms', 1);
            $cmsPage        = $this->cmsModel->where('id', 1)->first();
        }
        
        return view('site.city_partner', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
            ]);
    }

    /*
        * Function Name : rules
        * Purpose       : This function is get rules details
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function rules(Request $request, $citySlug = null) {
        $pageSlug = request()->segment(count(request()->segments()));

        $cityDetails    = $this->cityModel->where(['slug' => $citySlug])->first();
        $cmsPage        = $this->cmsModel->where(['parent_id' => $cityDetails->id, 'slug' => $pageSlug])->first();
        if ($cmsPage != null) {
            $getMetaDetails = getMetaDetails('cms', $cmsPage->id);
        } else {
            $getMetaDetails = getMetaDetails('cms', 1);
            $cmsPage        = $this->cmsModel->where('id', 1)->first();
        }
        
        return view('site.city_rules', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
            ]);
    }

    /*
        * Function Name : pickleballCourt
        * Purpose       : This function is get pickleball court details
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function pickleballCourts(Request $request, $citySlug = null) {
        $pageSlug = request()->segment(count(request()->segments()));

        $cityDetails    = $this->cityModel->where(['slug' => $citySlug])->first();
        $cmsPage        = $this->cmsModel->where(['parent_id' => $cityDetails->id, 'slug' => $pageSlug])->first();
        if ($cmsPage != null) {
            $getMetaDetails = getMetaDetails('cms', $cmsPage->id);
        } else {
            $getMetaDetails = getMetaDetails('cms', 1);
            $cmsPage        = $this->cmsModel->where('id', 1)->first();
        }
        
        return view('site.city_pickleball_court', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
            ]);
    }
    
    /*
        * Function Name : findAMatch
        * Purpose       : This function is get find a match details
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function findAMatch(Request $request, $citySlug = null) {
        $pageSlug = request()->segment(count(request()->segments()));

        $cityDetails    = $this->cityModel->where(['slug' => $citySlug])->first();
        $cmsPage        = $this->cmsModel->where(['parent_id' => $cityDetails->id, 'slug' => $pageSlug])->first();
        if ($cmsPage != null) {
            $getMetaDetails = getMetaDetails('cms', $cmsPage->id);
        } else {
            $getMetaDetails = getMetaDetails('cms', 1);
            $cmsPage        = $this->cmsModel->where('id', 1)->first();
        }
        
        return view('site.city_find_a_match', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'cmsDetails'        => $cmsPage,
            ]);
    }

    /*
        * Function Name : league
        * Purpose       : This function is get league details
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function league(Request $request, $citySlug = null, $playerAssignmentId = null) {
        $assignmentId       = $playerAssignmentId;
        $playerAssignmentId = customEncryptionDecryption($playerAssignmentId, 'decrypt');
        $userIds            = $teamIds = $includingLoggedInUser = [];
        $userList           = $teamList = '';
        $isRegisteredInThisLeague = false;
        $getMetaDetails     = getMetaDetails();

        if (!Auth::user()) {
            return redirect()->route('site.home');
        }

        // Start :: If session expired then re-initialize
        $cityDetails = City::where(['slug' => $citySlug])->first();
        if ($cityDetails) {
            Session::put([
                'stateId'   => $cityDetails->state_id,
                'stateName' => $cityDetails->stateDetails->title,
                'cityId'    => $cityDetails->id,
                'cityName'  => $cityDetails->title,
                'citySlug'  => $cityDetails->slug
            ]);
        } else {
            return redirect()->route('site.home');
        }
        // End :: If session expired then re-initialize

        $playerLeagueAssignmentDetails  = PlayerLeagueAssignment::where(['id' => $playerAssignmentId])
                                                                ->with([
                                                                    'cityDetails' => function($cityQuery) {
                                                                        $cityQuery->select('id','title');
                                                                    },
                                                                    'seasonDetails' => function($seasonQuery) {
                                                                        $seasonQuery->select('id','title');
                                                                    },
                                                                    'regionDetails' => function($regionQuery) {
                                                                        $regionQuery->select('id','title');
                                                                    },
                                                                    'playerTypeDetails' => function($playerTypeQuery) {
                                                                        $playerTypeQuery->select('id','title');
                                                                    },
                                                                    'competitiveLevelDetails' => function($competitiveLevelQuery) {
                                                                        $competitiveLevelQuery->select('id','title');
                                                                    }
                                                                ])
                                                                ->first();
        
        if ($playerLeagueAssignmentDetails) {
            // Start :: checking if the logged in user registered on that league or not (means Same Region and League (Player type))
            // if (Auth::user()) {
            //     // Player must be registered in specific league
            //     if (Auth::user()->playerLeaguePartners->count()) {
            //         foreach (Auth::user()->playerLeaguePartners as $league) {
            //             if ($league->playing_region_id == $playerLeagueAssignmentDetails->region_id && $league->player_type_id == $playerLeagueAssignmentDetails->player_type_id) {
            //                 $isRegisteredInThisLeague = true;
            //             }
            //         }
            //     }
            // }
            // End :: checking if the logged in user registered on that league or not (means Same Region and League (Player type))

            $players  = PlayerLeagueAssignment::where([
                                                    'city_id' => $playerLeagueAssignmentDetails->city_id,
                                                    'season_id' => $playerLeagueAssignmentDetails->season_id,
                                                    'region_id' => $playerLeagueAssignmentDetails->region_id,
                                                    'player_type_id' => $playerLeagueAssignmentDetails->player_type_id,
                                                    'competitive_level_id' => $playerLeagueAssignmentDetails->competitive_level_id,
                                                    // 'title' => $playerLeagueAssignmentDetails->title,
                                                ])
                                                ->with(['playerLeagueAssignmentUserDetails', 'playerLeagueAssignmentTeamDetails'])
                                                ->get();
            if ($players->count()) {
                foreach ($players as $playerKey => $assignment) {
                    // Start :: If player type Singles then collect user ids
                    if ($assignment->is_doubles == 'N') {
                        if ($assignment->playerLeagueAssignmentUserDetails) {
                            foreach ($assignment->playerLeagueAssignmentUserDetails as $userDetails) {
                                $includingLoggedInUser[] = $userDetails->user_id;

                                // if (Auth::user()->id != $userDetails->user_id) {
                                    $userIds[] = $userDetails->user_id;
                                // }
                            }
                        }
                    }
                    // End :: If player type Singles then collect user ids

                    // Start :: If player type Doubles collect team ids
                    else if ($assignment->is_doubles == 'Y') {
                        if ($assignment->playerLeagueAssignmentTeamDetails->count()) {
                            foreach ($assignment->playerLeagueAssignmentTeamDetails as $teamDetails) {
                                $teamIds[] = $teamDetails->team_id;
                            }
                        }
                    }
                    // End :: If player type Doubles collect team ids
                }

                // Start :: If player type Singles then fetch users list as per user ids
                if ($playerLeagueAssignmentDetails->is_doubles == 'N') {
                    // Start :: Admin must assign Player in specific league to submit score or view contact informations
                    if (count($includingLoggedInUser)) {
                        if (Auth::user() && (in_array(Auth::user()->id, $includingLoggedInUser))) {
                            $isRegisteredInThisLeague = true;
                        } else {
                            $isRegisteredInThisLeague = false;
                        }
                    } else {
                        $isRegisteredInThisLeague = false;
                    }
                    // End :: Admin must assign Player in specific league to submit score or view contact informations

                    if (count($userIds)) {
                        asort($userIds);
                        $userList = User::select('id', 'full_name', 'email')
                                        ->whereIn('id', $userIds)
                                        ->where(['is_waiver_signed' => 'Y', 'status' => '1'])
                                        ->whereNull(['deleted_at'])
                                        ->with([
                                            'userDetails' => function($query) {
                                                $query->select('user_id', 'preferred_home_court_id')
                                                    ->with([
                                                        'preferredHomeCourtDetails' => function($subQuery) {
                                                            $subQuery->select('id', 'title');
                                                        }
                                                    ]);
                                            }
                                        ])
                                        ->get();
                    }
                }
                // End :: If player type Singles then fetch users list as per user ids
                // Start :: If player type Doubles then fetch teams list as per team ids
                else if ($playerLeagueAssignmentDetails->is_doubles == 'Y') {
                    if (count($teamIds)) {
                        asort($teamIds);

                        $teamMemberList = TeamMember::whereIn('team_id', $teamIds)->get();
                        if ($teamMemberList->count()) {
                            foreach ($teamMemberList as $teamMember) {
                                $includingLoggedInUser[] = $teamMember->user_id;

                                // if (Auth::user()->id == $teamMember->user_id) {
                                //     if (($key = array_search($teamMember->team_id, $teamIds)) !== false) {
                                //         unset($teamIds[$key]);
                                //     }
                                // }
                            }
                        }

                        // Start :: Admin must assign Player in specific league to submit score or view contact informations
                        if (count($includingLoggedInUser)) {
                            if (Auth::user() && (in_array(Auth::user()->id, $includingLoggedInUser))) {
                                $isRegisteredInThisLeague = true;
                            } else {
                                $isRegisteredInThisLeague = false;
                            }
                        } else {
                            $isRegisteredInThisLeague = false;
                        }
                        // End :: Admin must assign Player in specific league to submit score or view contact informations

                        $teamList = Team::whereIn('id', $teamIds)
                                        ->where(['status' => '1'])
                                        ->whereNull(['deleted_at'])
                                        ->with([
                                            'teamMemberDetails' => function($query) {
                                                $query->with([
                                                        'mainUserDetails' => function($subQuery) {
                                                            $subQuery->select('id', 'full_name', 'email')
                                                                    ->with([
                                                                        'userDetails' => function($subSubQuery) {
                                                                            $subSubQuery->select('user_id', 'preferred_home_court_id')
                                                                                ->with([
                                                                                    'preferredHomeCourtDetails' => function($subSubSubQuery) {
                                                                                        $subSubSubQuery->select('id', 'title');
                                                                                    }
                                                                                ]);
                                                                        }
                                                                    ]);
                                                        }
                                                    ]);
                                            }
                                        ])
                                        ->get();
                    }
                }
                // End :: If player type Doubles then fetch teams list as per team ids
            }

            $totalMatchList = Score::where('player_league_assignment_id', $playerAssignmentId)											
                                    ->orderBy('match_date', 'DESC')
                                    ->orderBy('created_at', 'DESC')
                                    ->get();

            $data['cities'] = City::where(['status' => '1'])->whereNull(['deleted_at'])->select('id', 'title')->orderBy('sort', 'ASC')->get();
        } else {
            return redirect()->route('site.home');
        }

        return view('site.city_league', [
            'title'                     => $getMetaDetails['title'],
            'metaKeywords'              => $getMetaDetails['metaKeywords'],
            'metaDescription'           => $getMetaDetails['metaDescription'],
            'leagueDetails'             => $playerLeagueAssignmentDetails,
            'userList'                  => $userList,
            'teamList'                  => $teamList,
            'totalMatchLists'           => $totalMatchList,
            'assignmentId'              => $assignmentId,
            'isRegisteredInThisLeague'  => $isRegisteredInThisLeague,
            ]);
    }
	
    /*
        * Function Name : submitScore
        * Purpose       : This function is submit score details
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function submitScore(Request $request, $citySlug = null, $playerAssignmentId = null) {
        $assignmentId       = $playerAssignmentId;
        $playerAssignmentId = customEncryptionDecryption($playerAssignmentId, 'decrypt');
        $userIds            = $teamIds = $winnerTeamIds = $opponentTeamIds = [];
        $userList           = $teamList = $winnerTeamList = $opponentTeamList = '';
        $getMetaDetails     = getMetaDetails();

        if (!Auth::user()) {
            return redirect()->route('site.home');
        }

        // Start :: If session expired then re-initialize
        $cityDetails = City::where(['slug' => $citySlug])->first();
        if ($cityDetails) {
            Session::put([
                'stateId'   => $cityDetails->state_id,
                'stateName' => $cityDetails->stateDetails->title,
                'cityId'    => $cityDetails->id,
                'cityName'  => $cityDetails->title,
                'citySlug'  => $cityDetails->slug
            ]);
        } else {
            return redirect()->route('site.home');
        }
        // End :: If session expired then re-initialize

        $playerLeagueAssignmentDetails  = PlayerLeagueAssignment::where(['id' => $playerAssignmentId])
                                                                ->with([
                                                                    'cityDetails' => function($cityQuery) {
                                                                        $cityQuery->select('id','title');
                                                                    },
                                                                    'seasonDetails' => function($seasonQuery) {
                                                                        $seasonQuery->select('id','title');
                                                                    },
                                                                    'regionDetails' => function($regionQuery) {
                                                                        $regionQuery->select('id','title');
                                                                    },
                                                                    'playerTypeDetails' => function($playerTypeQuery) {
                                                                        $playerTypeQuery->select('id','title');
                                                                    },
                                                                    'competitiveLevelDetails' => function($competitiveLevelQuery) {
                                                                        $competitiveLevelQuery->select('id','title');
                                                                    }
                                                                ])
                                                                ->first();

        if ($playerLeagueAssignmentDetails) {
            $players  = PlayerLeagueAssignment::where([
                                                    'city_id' => $playerLeagueAssignmentDetails->city_id,
                                                    'season_id' => $playerLeagueAssignmentDetails->season_id,
                                                    'region_id' => $playerLeagueAssignmentDetails->region_id,
                                                    'player_type_id' => $playerLeagueAssignmentDetails->player_type_id,
                                                    'competitive_level_id' => $playerLeagueAssignmentDetails->competitive_level_id,
                                                    // 'title' => $playerLeagueAssignmentDetails->title,
                                                ])
                                                ->with(['playerLeagueAssignmentUserDetails', 'playerLeagueAssignmentTeamDetails'])
                                                ->get();
            
            if ($players->count()) {
                foreach ($players as $playerKey => $playerVal) {
                    // Start :: If player type Singles then collect user ids
                    if ($playerVal->is_doubles == 'N') {
                        if ($playerVal->playerLeagueAssignmentUserDetails) {
                            foreach ($playerVal->playerLeagueAssignmentUserDetails as $userDetails) {
                                if (Auth::user()->id != $userDetails->user_id) {
                                    $userIds[] = $userDetails->user_id;
                                }
                            }
                        }
                    }
                    // End :: If player type Singles then collect user ids

                    // Start :: If player type Doubles collect team ids
                    else if ($playerVal->is_doubles == 'Y') {
                        if ($playerVal->playerLeagueAssignmentTeamDetails->count()) {
                            foreach ($playerVal->playerLeagueAssignmentTeamDetails as $teamDetails) {
                                $teamIds[] = $teamDetails->team_id;
                            }
                        }
                    }
                    // End :: If player type Doubles collect team ids
                }

                // Start :: If player type Singles then fetch users list as per user ids
                if ($playerLeagueAssignmentDetails->is_doubles == 'N') {
                    if (count($userIds)) {
                        asort($userIds);
                        $userList = User::select('id', 'full_name', 'email')
                                        ->whereIn('id', $userIds)
                                        ->where(['is_waiver_signed' => 'Y', 'status' => '1'])
                                        ->whereNull(['deleted_at'])
                                        ->with(['userDetails'])
                                        ->get();
                    }
                }
                // End :: If player type Singles then fetch users list as per user ids

                // Start :: If player type Doubles then fetch teams list as per team ids
                if ($playerLeagueAssignmentDetails->is_doubles == 'Y') {
                    if (count($teamIds)) {
                        asort($teamIds);

                        $opponentTeamIds = $teamIds;

                        $teamMemberList = TeamMember::whereIn('team_id', $teamIds)->get();
                        if ($teamMemberList->count()) {
                            foreach ($teamMemberList as $teamMember) {
                                if (Auth::user()->id == $teamMember->user_id) {
                                    $winnerTeamIds[] = $teamMember->team_id;    // Winner team dropdown (Whose partner is logged in user)

                                    if (($key = array_search($teamMember->team_id, $opponentTeamIds)) !== false) {
                                        unset($opponentTeamIds[$key]);          // Setting opponent team dropdown (Whose partner is NOT logged in user)
                                    }
                                }
                            }
                        }

                        if (count($winnerTeamIds)) {
                            $winnerTeamList = Team::whereIn('id', $winnerTeamIds)
                                                ->where([
                                                    'status' => '1',
                                                    'season_id' => $playerLeagueAssignmentDetails->season_id,
                                                    'region_id' => $playerLeagueAssignmentDetails->region_id,
                                                    'player_type_id' => $playerLeagueAssignmentDetails->player_type_id,
                                                ])
                                                ->whereNull(['deleted_at'])
                                                ->with([
                                                    'teamMemberDetails' => function($query) {
                                                        $query->with([
                                                                'mainUserDetails' => function($subQuery) {
                                                                    $subQuery->select('id', 'full_name', 'email')
                                                                            ->with(['userDetails']);
                                                                }
                                                            ]);
                                                    }
                                                ])
                                                ->get();
                        }

                        if ($opponentTeamIds) {
                            $opponentTeamList = Team::whereIn('id', $opponentTeamIds)
                                                    ->where([
                                                        'status' => '1',
                                                        'season_id' => $playerLeagueAssignmentDetails->season_id,
                                                        'region_id' => $playerLeagueAssignmentDetails->region_id,
                                                        'player_type_id' => $playerLeagueAssignmentDetails->player_type_id,
                                                    ])
                                                    ->whereNull(['deleted_at'])
                                                    ->with([
                                                        'teamMemberDetails' => function($query) {
                                                            $query->with([
                                                                    'mainUserDetails' => function($subQuery) {
                                                                        $subQuery->select('id', 'full_name', 'email')
                                                                                ->with(['userDetails']);
                                                                    }
                                                                ]);
                                                        }
                                                    ])
                                                    ->get();
                        }

                    }
                }
                // End :: If player type Doubles then fetch teams list as per team ids
            }
        } else {
            return redirect()->route('site.home');
        }
		
		$courtList = PreferredHomeCourt::where(['status' => '1'])->whereNull(['deleted_at'])->select('id', 'title')->orderBy('sort', 'ASC')->get();
		
        return view('site.submit_score', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'leagueDetails'     => $playerLeagueAssignmentDetails,
            'userList'          => $userList,
            'teamList'          => $teamList,
            'assignmentId'      => $assignmentId,
			'courtList'         => $courtList,
            'winnerTeamList'    => $winnerTeamList,
            'opponentTeamList'  => $opponentTeamList,
            ]);
    }

    /*
        * Function name : ajaxCityLeagueSubmitScore
        * Purpose       : This function is to city league submit score
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxCityLeagueSubmitScore(Request $request) {
        $title          = trans('custom.message_error');
        $message        = trans('custom.error_something_went_wrong');
        $type           = 'error';
        $messageDetails = $emailIds = $userIds = [];
        $score          = $reasonForForfeit = $winnerName = $loserName = '';

        try {
            if ($request->ajax()) {
                if ($request->player_assignment_id != '') {
                    $leagueTitle        = customEncryptionDecryption($request->league_title, 'decrypt');
                    $playerAssignmentId = customEncryptionDecryption($request->player_assignment_id, 'decrypt');
                    
                    $playerLeagueAssignmentDetails  = PlayerLeagueAssignment::where(['id' => $playerAssignmentId])
                                                                ->with([
                                                                    'cityDetails' => function($cityQuery) {
                                                                        $cityQuery->select('id','title');
                                                                    },
                                                                    'seasonDetails' => function($seasonQuery) {
                                                                        $seasonQuery->select('id','title');
                                                                    },
                                                                    'regionDetails' => function($regionQuery) {
                                                                        $regionQuery->select('id','title');
                                                                    },
                                                                    'playerTypeDetails' => function($playerTypeQuery) {
                                                                        $playerTypeQuery->select('id','title');
                                                                    },
                                                                    'competitiveLevelDetails' => function($competitiveLevelQuery) {
                                                                        $competitiveLevelQuery->select('id','title');
                                                                    }
                                                                ])
                                                                ->first();
                    if ($playerLeagueAssignmentDetails) {
                        $matchDate = $request->year.'-'.$request->month.'-'.$request->day;
                        if ( strtotime($matchDate) <= strtotime(date('Y-m-d')) ) {      // Match date must not be future date
                            $newScore                               = new Score();
                            $newScore->state_id                     = $playerLeagueAssignmentDetails->state_id;
                            $newScore->city_id                      = $playerLeagueAssignmentDetails->city_id;
                            $newScore->season_id                    = $playerLeagueAssignmentDetails->season_id;
                            $newScore->region_id                    = $playerLeagueAssignmentDetails->region_id;
                            $newScore->player_type_id               = $playerLeagueAssignmentDetails->player_type_id;
                            $newScore->competitive_level_id         = $playerLeagueAssignmentDetails->competitive_level_id;
                            $newScore->home_court_id                = $request->preferred_home_court;
                            $newScore->player_league_assignment_id  = $playerAssignmentId;
                            $newScore->is_doubles                   = $playerLeagueAssignmentDetails->is_doubles;
                            $newScore->match_date                   = $matchDate;
                            $newScore->match_format                 = $request->matchFormat;
                            $newScore->win_by_forfeit               = $request->win_by_forfeit ? json_encode($request->win_by_forfeit) : NULL;
                            $newScore->created_by                   = Auth::user()->id;
                            if ($playerLeagueAssignmentDetails->is_doubles == 'N') {    // Match type Singles
                                $newScore->winner_id                = $request->winner_id;
                                $newScore->loser_id                 = $request->loser_id;
                            } else {                                                    // Match type Doubles
                                $newScore->winner_team_id           = $request->winner_team_id;
                                $newScore->loser_team_id            = $request->loser_team_id;

                                $winnerTeamMemberIds                = $loserTeammemberIds = [];
                                $winnerTeamMemberList               = TeamMember::where(['team_id' => $request->winner_team_id])->get();
                                if ($winnerTeamMemberList->count()) {
                                    foreach ($winnerTeamMemberList as $user) {
                                        $winnerTeamMemberIds[] = $user->user_id;
                                    }
                                    $newScore->winner_team_user_ids = count($winnerTeamMemberIds) ? json_encode($winnerTeamMemberIds, JSON_NUMERIC_CHECK) : NULL;
                                }
                                $loserTeamMemberList                = TeamMember::where(['team_id' => $request->loser_team_id])->get();
                                if ($loserTeamMemberList->count()) {
                                    foreach ($loserTeamMemberList as $user) {
                                        $loserTeammemberIds[] = $user->user_id;
                                    }
                                    $newScore->loser_team_user_ids  = count($loserTeammemberIds) ? json_encode($loserTeammemberIds, JSON_NUMERIC_CHECK) : NULL;
                                }
                            }

                            // Start :: Match type Singles
                            if ($playerLeagueAssignmentDetails->is_doubles == 'N') {
                                // Start :: List of email ids of individuals players in that particular league
                                $players  = PlayerLeagueAssignment::where([
                                    'city_id' => $playerLeagueAssignmentDetails->city_id,
                                    'season_id' => $playerLeagueAssignmentDetails->season_id,
                                    'region_id' => $playerLeagueAssignmentDetails->region_id,
                                    'player_type_id' => $playerLeagueAssignmentDetails->player_type_id,
                                    'competitive_level_id' => $playerLeagueAssignmentDetails->competitive_level_id,
                                    // 'title' => $playerLeagueAssignmentDetails->title,
                                    'is_doubles' => 'N',
                                ])
                                ->with(['playerLeagueAssignmentUserDetails'])
                                ->get();

                                if ($players->count()) {
                                    foreach ($players as $playerKey => $playerVal) {
                                        if ($playerVal->playerLeagueAssignmentUserDetails) {
                                            foreach ($playerVal->playerLeagueAssignmentUserDetails as $userDetails) {
                                                $userIds[] = $userDetails->user_id;
                                            }
                                        }

                                        if (count($userIds)) {
                                            $userIds = array_unique($userIds);
                                            asort($userIds);

                                            $userList = User::select('id', 'full_name', 'email')
                                                            ->whereIn('id', $userIds)
                                                            // ->where('id', '<>', Auth::user()->id)
                                                            ->where([
                                                                'is_waiver_signed' => 'Y',
                                                                'status' => '1',
                                                                'send_score_confirmation' => 'Y'
                                                            ])
                                                            ->whereNull(['deleted_at'])
                                                            ->get();
                                            if ($userList) {
                                                foreach ($userList as $user) {
                                                    $emailIds[] = $user->email;     // Getting user email ids
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            // End :: Match type Singles
                            // Start :: Match type Doubles
                            else if ($playerLeagueAssignmentDetails->is_doubles == 'Y') {
                                // Start :: List of email ids of Teams players in that particular league
                                $players  = PlayerLeagueAssignment::where([
                                    'city_id' => $playerLeagueAssignmentDetails->city_id,
                                    'season_id' => $playerLeagueAssignmentDetails->season_id,
                                    'region_id' => $playerLeagueAssignmentDetails->region_id,
                                    'player_type_id' => $playerLeagueAssignmentDetails->player_type_id,
                                    'competitive_level_id' => $playerLeagueAssignmentDetails->competitive_level_id,
                                    // 'title' => $playerLeagueAssignmentDetails->title,
                                    'is_doubles' => 'Y',
                                ])
                                ->with(['playerLeagueAssignmentTeamDetails'])
                                ->get();

                                if ($players->count()) {
                                    foreach ($players as $playerKey => $playerVal) {
                                        if ($playerVal->playerLeagueAssignmentTeamDetails) {
                                            foreach ($playerVal->playerLeagueAssignmentTeamDetails as $teamDetails) {
                                                if ($teamDetails->teamDetails) {
                                                    foreach ($teamDetails->teamDetails->teamMemberDetails as $userDetails) {
                                                        // if (Auth::user() && Auth::user()->id != $userDetails->user_id) {
                                                            $userIds[] = $userDetails->user_id;
                                                        // }
                                                    }
                                                }
                                            }
                                        }
                                        if (count($userIds)) {      // Remove duplicate
                                            $userIds = array_unique($userIds);
                                            asort($userIds);

                                            $userList = User::select('id', 'full_name', 'email')
                                                            ->whereIn('id', $userIds)
                                                            // ->where('id', '<>', Auth::user()->id)
                                                            ->where([
                                                                'is_waiver_signed' => 'Y',
                                                                'status' => '1',
                                                                'send_score_confirmation' => 'Y'
                                                            ])
                                                            ->whereNull(['deleted_at'])
                                                            ->get();
                                            if ($userList) {
                                                foreach ($userList as $user) {
                                                    $emailIds[] = $user->email;     // Getting user email ids
                                                }
                                            }
                                        }
                                    }
                                }
                                // End :: List of email ids of Teams players in that particular league
                            }
                            // End :: Match type Doubles

                            if ($request->matchFormat == 2) {   // Radio button 2 : If match format 1 game to 15
                                if (!$request->win_by_forfeit) {    // If NOT Win By Forfeit any checkbox selected
                                    $game1winnerscore   = $request->game1winnerscore;
                                    $game1loserscore    = $request->game1loserscore;

                                    if ($game1winnerscore >= 2) {     // Game 1 winner score must be 2 or more so that game 1 score = game 1 loser score - 2
                                        if ( $game1winnerscore >= ($game1loserscore + 2) ) {   // Game 1 winner score must be greater than game 2 loser score + 2
                                            $save   = $newScore->save();    // Saving data into Scores table
                                            
                                            if ($save) {
                                                // Insert into score sets table
                                                $newScoreSet                        = new ScoreSet();
                                                $newScoreSet->score_id              = $newScore->id;
                                                $newScoreSet->game_1_winner_score   = $game1winnerscore;
                                                $newScoreSet->game_1_loser_score    = $game1loserscore;
                                                $score = $newScoreSet->game_1_winner_score.'-'.$newScoreSet->game_1_loser_score;
                                                
                                                $newScoreSet->save();

                                                // Start :: Mail to individuals / team players in that particular league
                                                if (count($emailIds)) {
                                                    $mailDetails['title']               = 'PPN League Match ('.$leagueTitle.')';
                                                    $mailDetails['league']              = $leagueTitle;
                                                    $mailDetails['score']               = $score;
                                                    $mailDetails['reason_forfeit']      = $reasonForForfeit;
                                                    $mailDetails['match_date']          = $request->month.'/'.$request->day.'/'.$request->year;
                                                    $mailDetails['court']               = $newScore->homeCourtDetails ? $newScore->homeCourtDetails->title : '';
                                                    $mailDetails['to_email']            = $emailIds;
                                                    $mailDetails['is_doubles']          = $newScore->is_doubles;

                                                    if ($playerLeagueAssignmentDetails->is_doubles == 'N') {        // For Singles
                                                        $winnerName = $newScore->winnerSinglesDetails->full_name ?? '';
                                                        $loserName  = $newScore->loserSinglesDetails->full_name ?? '';

                                                        $mailDetails['winner_details']  = $newScore->winnerSinglesDetails;
                                                        $mailDetails['loser_details']   = $newScore->loserSinglesDetails;

                                                        $mailDetails['winner_season_record']    = getSinglesOverallRecord($request->winner_id);
                                                        $mailDetails['loser_season_record']     = getSinglesOverallRecord($request->loser_id);
                                                    }
                                                    else if ($playerLeagueAssignmentDetails->is_doubles == 'Y') {   // For Doubles
                                                        if ($newScore->winnerTeamDetails) {
                                                            $teamMembers = 1; $winnerName = '';
                                                            foreach ($newScore->winnerTeamDetails->teamMemberDetails as $key => $teamMember) {
                                                                $winnerName .= $teamMember->userDetails->full_name;

                                                                if ($teamMembers < $newScore->winnerTeamDetails->teamMemberDetails->count()) {
                                                                    $winnerName .= ' / ';
                                                                }
                                                                $teamMembers++;

                                                                $mailDetails['winner_details'][$key] = $teamMember->userDetails->toArray();
                                                            }
                                                        }
                                                        if ($newScore->loserTeamDetails) {
                                                            $teamMembers = 1; $loserName = '';
                                                            foreach ($newScore->loserTeamDetails->teamMemberDetails as $key => $teamMember) {
                                                                $loserName .= $teamMember->userDetails->full_name;

                                                                if ($teamMembers < $newScore->loserTeamDetails->teamMemberDetails->count()) {
                                                                    $loserName .= ' / ';
                                                                }
                                                                $teamMembers++;

                                                                $mailDetails['loser_details'][$key] = $teamMember->userDetails->toArray();
                                                            }
                                                        }

                                                        $mailDetails['winner_season_record']    = getTeamOverallRecord($request->winner_team_id);
                                                        $mailDetails['loser_season_record']     = getTeamOverallRecord($request->loser_team_id);
                                                    }

                                                    $subject    = 'Match Submission: '.$winnerName.' over '.$loserName;
                                                    if ($score) {
                                                        $subject.= ' ('.$score.')';
                                                    }
                                                    $mailDetails['subject']             = $subject;
                                                    $mailDetails['winner_name']         = $winnerName;
                                                    $mailDetails['loser_name']          = $loserName;

                                                    // Mail
                                                    $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);
                                                    dispatch(new SendScoreToAllUsersInSpecificLeague($mailDetails, $siteSettings));
                                                }
                                                // End :: Mail to individuals / team players in that particular league

                                                $title      = trans('custom.message_success');
                                                $message    = trans('custom.message_scores_updated_successfully');
                                                $type       = 'success';
                                            }
                                        } else {
                                            $title      = trans('custom.message_error');
                                            $message    = trans('custom.error_winner_score_must_be_greater_than_2_of_loser_score_for_1_game_to_15');
                                            $type       = 'error';
                                        }
                                    } else {
                                        $title      = trans('custom.message_error');
                                        $message    = trans('custom.error_winner_score_must_be_greater_than_2_opponent_score_for_1_game_to_15');
                                        $type       = 'error';
                                    }
                                } else {                            // If Win By Forfeit any checkbox selected
                                    $save   = $newScore->save();    // Saving data into Scores table

                                    if ($save) {
                                        // Insert into score sets table
                                        $newScoreSet            = new ScoreSet();
                                        $newScoreSet->score_id  = $newScore->id;
                                        $reasonForForfeit       = implode(', ', $request->win_by_forfeit);
                                        $newScoreSet->save();

                                        // Start :: Mail to individuals / team players in that particular league
                                        if (count($emailIds)) {
                                            $mailDetails['title']               = 'PPN League Match ('.$leagueTitle.')';
                                            $mailDetails['league']              = $leagueTitle;
                                            $mailDetails['score']               = $score;
                                            $mailDetails['reason_forfeit']      = $reasonForForfeit;
                                            $mailDetails['match_date']          = $request->month.'/'.$request->day.'/'.$request->year;
                                            $mailDetails['court']               = $newScore->homeCourtDetails ? $newScore->homeCourtDetails->title : '';
                                            $mailDetails['to_email']            = $emailIds;
                                            $mailDetails['is_doubles']          = $newScore->is_doubles;

                                            if ($playerLeagueAssignmentDetails->is_doubles == 'N') {        // For Singles
                                                $winnerName = $newScore->winnerSinglesDetails->full_name ?? '';
                                                $loserName  = $newScore->loserSinglesDetails->full_name ?? '';

                                                $mailDetails['winner_details']  = $newScore->winnerSinglesDetails;
                                                $mailDetails['loser_details']   = $newScore->loserSinglesDetails;

                                                $mailDetails['winner_season_record']    = getSinglesOverallRecord($request->winner_id);
                                                $mailDetails['loser_season_record']     = getSinglesOverallRecord($request->loser_id);
                                            }
                                            else if ($playerLeagueAssignmentDetails->is_doubles == 'Y') {   // For Doubles
                                                if ($newScore->winnerTeamDetails) {
                                                    $teamMembers = 1; $winnerName = '';
                                                    foreach ($newScore->winnerTeamDetails->teamMemberDetails as $key => $teamMember) {
                                                        $winnerName .= $teamMember->userDetails->full_name;

                                                        if ($teamMembers < $newScore->winnerTeamDetails->teamMemberDetails->count()) {
                                                            $winnerName .= ' / ';
                                                        }
                                                        $teamMembers++;

                                                        $mailDetails['winner_details'][$key] = $teamMember->userDetails->toArray();
                                                    }
                                                }
                                                if ($newScore->loserTeamDetails) {
                                                    $teamMembers = 1; $loserName = '';
                                                    foreach ($newScore->loserTeamDetails->teamMemberDetails as $key => $teamMember) {
                                                        $loserName .= $teamMember->userDetails->full_name;

                                                        if ($teamMembers < $newScore->loserTeamDetails->teamMemberDetails->count()) {
                                                            $loserName .= ' / ';
                                                        }
                                                        $teamMembers++;

                                                        $mailDetails['loser_details'][$key] = $teamMember->userDetails->toArray();
                                                    }
                                                }

                                                $mailDetails['winner_season_record']    = getTeamOverallRecord($request->winner_team_id);
                                                $mailDetails['loser_season_record']     = getTeamOverallRecord($request->loser_team_id);
                                            }

                                            $subject    = 'Match Submission: '.$winnerName.' over '.$loserName;
                                            if ($score) {
                                                $subject.= ' ('.$score.')';
                                            }
                                            $mailDetails['subject']             = $subject;
                                            $mailDetails['winner_name']         = $winnerName;
                                            $mailDetails['loser_name']          = $loserName;

                                            // Mail
                                            $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);
                                            dispatch(new SendScoreToAllUsersInSpecificLeague($mailDetails, $siteSettings));
                                        }
                                        // End :: Mail to individuals / team players in that particular league

                                        $title      = trans('custom.message_success');
                                        $message    = trans('custom.message_scores_updated_successfully');
                                        $type       = 'success';
                                    }
                                }
                            } else {       // Radio button 1 : If match format 2 out of 3 games
                                $save   = $newScore->save();    // Saving data into Scores table

                                if ($save) {
                                    // Insert into score sets table
                                    $newScoreSet                        = new ScoreSet();
                                    $newScoreSet->score_id              = $newScore->id;
                                    if (!$request->win_by_forfeit) {    // If NOT Win By Forfeit any checkbox selected
                                        $newScoreSet->game_1_winner_score   = $request->game_1_winner_score;
                                        $newScoreSet->game_1_loser_score    = $request->game_1_loser_score;
                                        $newScoreSet->game_2_winner_score   = $request->game_2_winner_score;
                                        $newScoreSet->game_2_loser_score    = $request->game_2_loser_score;
                                        $newScoreSet->game_3_winner_score   = $request->game_3_winner_score;
                                        $newScoreSet->game_3_loser_score    = $request->game_3_loser_score;

                                        $score = $request->game_1_winner_score.'-'.$request->game_1_loser_score.'; ';
                                        $score .= $request->game_2_winner_score.'-'.$request->game_2_loser_score.'; ';
                                        if ($request->game_3_winner_score != '' && $request->game_3_loser_score != '') {
                                            $score .= $request->game_3_winner_score.'-'.$request->game_3_loser_score;
                                        } else if ($request->game_3_winner_score != '' && $request->game_3_loser_score == '') {
                                            $score .= $request->game_3_winner_score.'-N/A';
                                        } else if ($request->game_3_winner_score == '' && $request->game_3_loser_score != '') {
                                            $score .= 'N/A - '.$request->game_3_loser_score;
                                        } else {
                                            $score .= 'N/A';
                                        }
                                    } else {    // Reason for Forfeit
                                        $reasonForForfeit = implode(', ', $request->win_by_forfeit);
                                    }
                                    $newScoreSet->save();

                                    // Start :: Mail to individuals / team players in that particular league except score submitting player
                                    if (count($emailIds)) {
                                        $mailDetails['title']           = 'PPN League Match ('.$leagueTitle.')';
                                        $mailDetails['winner_details']  = $newScore->winnerSinglesDetails;
                                        $mailDetails['loser_details']   = $newScore->loserSinglesDetails;
                                        $mailDetails['league']          = $leagueTitle;
                                        $mailDetails['score']           = $score;
                                        $mailDetails['reason_forfeit']  = $reasonForForfeit;
                                        $mailDetails['match_date']      = $request->month.'/'.$request->day.'/'.$request->year;
                                        $mailDetails['court']           = $newScore->homeCourtDetails ? $newScore->homeCourtDetails->title : '';
                                        $mailDetails['to_email']        = $emailIds;
                                        $mailDetails['is_doubles']      = $newScore->is_doubles;

                                        if ($playerLeagueAssignmentDetails->is_doubles == 'N') {        // For Singles
                                            $winnerName = $newScore->winnerSinglesDetails->full_name ?? '';
                                            $loserName  = $newScore->loserSinglesDetails->full_name ?? '';

                                            $mailDetails['winner_details']  = $newScore->winnerSinglesDetails;
                                            $mailDetails['loser_details']   = $newScore->loserSinglesDetails;

                                            $mailDetails['winner_season_record']    = getSinglesOverallRecord($request->winner_id);
                                            $mailDetails['loser_season_record']     = getSinglesOverallRecord($request->loser_id);
                                        }
                                        else if ($playerLeagueAssignmentDetails->is_doubles == 'Y') {   // For Doubles
                                            if ($newScore->winnerTeamDetails) {
                                                $teamMembers = 1; $winnerName = '';
                                                foreach ($newScore->winnerTeamDetails->teamMemberDetails as $key => $teamMember) {
                                                    $winnerName .= $teamMember->userDetails->full_name;

                                                    if ($teamMembers < $newScore->winnerTeamDetails->teamMemberDetails->count()) {
                                                        $winnerName .= ' / ';
                                                    }
                                                    $teamMembers++;

                                                    $mailDetails['winner_details'][$key] = $teamMember->userDetails->toArray();
                                                }
                                            }
                                            if ($newScore->loserTeamDetails) {
                                                $teamMembers = 1; $loserName = '';
                                                foreach ($newScore->loserTeamDetails->teamMemberDetails as $key => $teamMember) {
                                                    $loserName .= $teamMember->userDetails->full_name;

                                                    if ($teamMembers < $newScore->loserTeamDetails->teamMemberDetails->count()) {
                                                        $loserName .= ' / ';
                                                    }
                                                    $teamMembers++;

                                                    $mailDetails['loser_details'][$key] = $teamMember->userDetails->toArray();
                                                }
                                            }

                                            $mailDetails['winner_season_record']    = getTeamOverallRecord($request->winner_team_id);
                                            $mailDetails['loser_season_record']     = getTeamOverallRecord($request->loser_team_id);
                                        }

                                        $subject    = 'Match Submission: '.$winnerName.' over '.$loserName;
                                        if ($score) {
                                            $subject.= ' ('.$score.')';
                                        }
                                        $mailDetails['subject']         = $subject;
                                        $mailDetails['winner_name']     = $winnerName;
                                        $mailDetails['loser_name']      = $loserName;

                                        // Mail
                                        $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);
                                        dispatch(new SendScoreToAllUsersInSpecificLeague($mailDetails, $siteSettings));
                                    }
                                    // End :: Mail to individuals / team players in that particular league except score submitting player

                                    $title      = trans('custom.message_success');
                                    $message    = trans('custom.message_scores_updated_successfully');
                                    $type       = 'success';
                                }
                            }
                        } else {
                            $title      = trans('custom.message_error');
                            $message    = trans('custom.error_match_date_must_not_be_future_date');
                            $type       = 'error';
                        }
                    } else {
                        $title      = trans('custom.message_error');
                        $message    = trans('custom.error_invalid_league');
                        $type       = 'error';
                    }
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type]);
    }

    /*
        * Function name : submitScoreThankYou
        * Purpose       : Thank you page after submit score
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Display thank you message
    */
    public function submitScoreThankYou(Request $request, $citySlug = null, $playerAssignmentId = null) {
        if (!Auth::user()) {
            return redirect()->route('site.home');
        }

        $getMetaDetails = getMetaDetails();
        $siteSettings   = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);
        
        return view('site.city_league_thank_you', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'siteSettings'      => $siteSettings,
            'playerAssignmentId'=> $playerAssignmentId,
            ]);
    }

    /*
        * Function name : ajaxCityLeagueMessageSubmit
        * Purpose       : This function is to send message from city league
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function ajaxCityLeagueMessageSubmit(Request $request) {
        $title          = trans('custom.message_error');
        $message        = trans('custom.error_something_went_wrong');
        $type           = 'error';
        $emailIds       = $leagueName = $emailBody = $implodedEmailIds = '';
        $messageDetails = $mailIds = $partnerEmailIds = [];

        try {
            if ($request->ajax()) {
                if ($request->league_id != '' && $request->selected_user_ids != '') {
                    $playerAssignmentId = customEncryptionDecryption($request->league_id, 'decrypt');
                    $isDoubles          = customEncryptionDecryption($request->is_doubles, 'decrypt');

                    $playerLeagueAssignmentDetails  = PlayerLeagueAssignment::where(['id' => $playerAssignmentId])
                                                                            ->with([
                                                                                'seasonDetails' => function($seasonQuery) {
                                                                                    $seasonQuery->select('id','title');
                                                                                },
                                                                                'regionDetails' => function($regionQuery) {
                                                                                    $regionQuery->select('id','title');
                                                                                },
                                                                                'playerTypeDetails' => function($playerTypeQuery) {
                                                                                    $playerTypeQuery->select('id','title');
                                                                                },
                                                                                'competitiveLevelDetails' => function($competitiveLevelQuery) {
                                                                                    $competitiveLevelQuery->select('id','title');
                                                                                }
                                                                            ])
                                                                            ->first();
                    // $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);

                    if ($playerLeagueAssignmentDetails->seasonDetails || $playerLeagueAssignmentDetails->regionDetails || $playerLeagueAssignmentDetails->playerTypeDetails || $playerLeagueAssignmentDetails->competitiveLevelDetails) {
                        $leagueName .= $playerLeagueAssignmentDetails->seasonDetails->title;

                        if ($playerLeagueAssignmentDetails->regionDetails) {
                            $leagueName .= ' - '.$playerLeagueAssignmentDetails->regionDetails->title;
                        }
                        if ($playerLeagueAssignmentDetails->playerTypeDetails) {
                            $leagueName .= ' - '.$playerLeagueAssignmentDetails->playerTypeDetails->title;
                        }
                        if ($playerLeagueAssignmentDetails->competitiveLevelDetails) {
                            $leagueName .= ' - '.$playerLeagueAssignmentDetails->competitiveLevelDetails->title;
                        }
                        if ($playerLeagueAssignmentDetails->title) {
                            $leagueName .= ' - '.$playerLeagueAssignmentDetails->title;
                        }
                    }

                    $emailBody .= '';

                    $messageDetails['league']       = $leagueName;
                    $messageDetails['subject']      = 'PPN League Match Invitation From '.Auth::user()->full_name.' – '.$leagueName;
                    $messageDetails['emailBody']    = $emailBody;
                    $messageDetails['player_name']  = Auth::user()->full_name;
                    // $messageDetails['message']      = trim($request->message, ' ');
                    
                    if ($isDoubles == 'N') {    // For singles league
                        foreach ($request->selected_user_ids as $userId) {
                            $userList = User::select('id', 'first_name', 'full_name', 'email')
                                            ->where('id', $userId)
                                            ->first();
                            
                            $mailIds[] = $userList->email;
                        }
                    } else {                    // For Doubles league
                        // Start :: To get the logged in player partner for that player assignment league
                        $teamMembers= TeamMember::where(['user_id' => Auth::user()->id])->get();
                        if ($teamMembers->count()) {
                            foreach ($teamMembers as $teamMemberDetails) {
                                $getPlayerAssignmentTeamDetails = PlayerLeagueAssignmentTeam::where(['player_league_assignment_id' => $playerAssignmentId, 'team_id' => $teamMemberDetails->team_id])->first();
                                if ($getPlayerAssignmentTeamDetails != null) {
                                    if ($getPlayerAssignmentTeamDetails->teamDetails->teamMemberDetails) {
                                        foreach ($getPlayerAssignmentTeamDetails->teamDetails->teamMemberDetails as $member) {
                                            if (Auth::user() && Auth::user()->id != $member->user_id) {
                                                $partnerEmailIds[] = $member->userDetails->email;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        // End :: To get the logged in player partner for that player assignment league

                        $teamList   = Team::select('id', 'title')
                                            ->whereIn('id', $request->selected_user_ids)
                                            ->get();
                        if ($teamList->count()) {
                            foreach ($teamList as $team) {
                                if ($team->teamMemberDetails->count()) {
                                    foreach ($team->teamMemberDetails as $member) {
                                        if ($member->userDetails) {
                                            if (Auth::user() && Auth::user()->id != $member->userDetails->id) {
                                                $mailIds[] = $member->userDetails->email;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                    // Start :: merge 2 arrays (logged in user partner email ids + selected player email ids)
                    if (count($partnerEmailIds) && count($mailIds)) {
                        $mailIds = array_merge($partnerEmailIds, $mailIds);
                    }
                    // End :: merge 2 arrays (logged in user partner email ids + selected player email ids)

                    // Start :: imploding data by commas
                    if (count($mailIds)) {
                        $mailIds            = array_unique($mailIds);
                        $implodedEmailIds   = implode(',', $mailIds);
                    }
                    // end :: imploding data by commas
                    
                    $title      = trans('custom.message_success');
                    $message    = trans('custom.message_form_success_submit');
                    $type       = 'success';
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type, 'emailIds' => $implodedEmailIds, 'messageDetails' => $messageDetails]);
    }

    /*
        * Function Name : playerProfile
        * Purpose       : This function is get player profile details
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function playerProfile(Request $request, $citySlug = null, $playerId = null) {
        if (!Auth::user()) {    // If not logged in then redirect to the home page
            return redirect()->route('site.home');
        }
        $playerId       = customEncryptionDecryption($playerId, 'decrypt');
        $getMetaDetails = getMetaDetails();
        $playerDetails  = User::select('id', 'full_name', 'email', 'profile_pic', 'city_id', 'player_rating', 'created_at')
                                ->where('id', $playerId)
                                ->with([
                                    'userDetails' => function($query) {
                                        $query->select('user_id', 'preferred_home_court_id', 'playing_region_id')
                                            ->with([
                                                'preferredHomeCourtDetails' => function($phcQuery) {
                                                    $phcQuery->select('id', 'title');
                                                },
                                                'playingRegionDetails' => function($prQuery) {
                                                    $prQuery->select('id', 'title');
                                                }
                                            ]);
                                    },
                                    'cityDetails' => function($subQuery) {
                                        $subQuery->select('id', 'title');
                                    }
                                ])
                                ->first();

        $lastTenMatchLists = Score::where('winner_id', $playerId)
											->orwhere('loser_id', $playerId)
                                            ->orwhereJsonContains('winner_team_user_ids', [(int)$playerId])
                                            ->orwhereJsonContains('loser_team_user_ids', [(int)$playerId])
                                            ->orderBy('match_date', 'DESC')
                                            ->orderBy('created_at', 'DESC')
                                            ->take(10)
											->get();

        $overallWin = Score::where('winner_id', $playerId)
                                            ->orwhereJsonContains('winner_team_user_ids', [(int)$playerId])
                                            ->count();
                                            
        $overallLose = Score::where('loser_id', $playerId)
                                            ->orwhereJsonContains('loser_team_user_ids', [(int)$playerId])
                                            ->count();
       
        $teamLists = TeamMember::where(['user_id' => $playerId])->get();
        
        return view('site.city_player_profile', [
            'title'             => $getMetaDetails['title'],
            'metaKeywords'      => $getMetaDetails['metaKeywords'],
            'metaDescription'   => $getMetaDetails['metaDescription'],
            'playerDetails'     => $playerDetails,
			'lastTenMatchLists' => $lastTenMatchLists,
            'teamLists'         => $teamLists,
            'overallWinCount'   => $overallWin,
            'overallLoseCount'  => $overallLose,
            ]);
    }

}