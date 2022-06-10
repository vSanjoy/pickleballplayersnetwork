<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : PlayersController
# Purpose           : Player League Assignment Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\PickleballCourt;
use App\Models\Availability;
use App\Models\UserAvailability;
use App\Models\State;
use DataTables;

class PlayersController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'Players';
    public $management;
    public $modelName       = 'User';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'player';
    public $listUrl         = 'player.list';
    public $listRequestUrl  = 'player.ajax-list-request';
    public $addUrl          = 'player.add';
    public $editUrl         = 'player.edit';
    public $viewUrl         = 'player.view';
    public $statusUrl       = 'player.change-status';
    public $deleteUrl       = 'player.delete';
    public $viewFolderPath  = 'admin.player';
    public $model           = 'User';

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

        $this->management   = trans('custom_admin.label_player');
        $this->model        = new User();

        // Assign breadcrumb
        $this->assignBreadcrumb();
        
        // Variables assign for view page
        $this->assignShareVariables();
    }

    /*
        * Function name : list
        * Purpose       : This function is for the listing and searching
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns to the list page
    */
    public function list(Request $request) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_player'),
            'panelTitle'    => trans('custom_admin.label_player'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            // Start :: Manage restriction
            $data['isAllow']    = false;
            $restrictions       = checkingAllowRouteToUser($this->pageRoute.'.');
            if ($restrictions['is_super_admin']) {
                $data['isAllow'] = true;
            }
            $data['allowedRoutes']  = $restrictions['allow_routes'];
            // End :: Manage restriction
            $data['pickleballCourts']   = PickleballCourt::select('id','title','city','state_id')->where(['status' => '1'])->whereNull('deleted_at')->orderBy('title', 'ASC')->get();

            return view($this->viewFolderPath.'.list', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.dashboard');
        }
    }

    /*
        * Function name : ajaxListRequest
        * Purpose       : This function is for the return ajax data
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns news data
    */
    public function ajaxListRequest(Request $request) {
        $data['pageTitle'] = trans('custom_admin.label_player');
        $data['panelTitle']= trans('custom_admin.label_player');

        try {
            if ($request->ajax()) {
                // Preferred Rating
                $playerRating           = $request->player_rating;
                $filterByPlayerRating   = false;
                if ($playerRating != '') {
                    $filterByPlayerRating = true;
                    $filter['player_rating'] = $playerRating;
                }
                // Preferred Home Court
                $homeCourtId        = $request->home_court;
                $filterByHomeCourt  = false;
                if ($homeCourtId != '') {
                    $filterByHomeCourt = true;
                    $filter['home_court'] = $homeCourtId;
                }

                // Main query
                $data = $this->model->where('id', '<>', 1)->where(['type' => 'U'])->whereNull(['deleted_at']);

                // Based on player rating filter
                if ($filterByPlayerRating) {
                    $data = $data->where('player_rating', $playerRating);
                }
                // Based on preferred home court filter
                if ($filterByHomeCourt) {
                    $data->whereHas(
                            'userDetails', function ($queryPreferredHomeCourt) use ($homeCourtId) {
                                $queryPreferredHomeCourt->where('home_court', $homeCourtId);
                            });
                }

                $data = $data->orderBy('full_name','ASC')->get();

                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes)
                        ->addIndexColumn()
                        ->addColumn('player_rating', function ($row) {
                            if ($row->player_rating) {
                                return formatToTwoDecimalPlaces($row->player_rating);
                            } else {
                                return 'NA';
                            }
                        })
                        ->addColumn('home_court', function ($row) {
                            if ($row->userDetails->pickleballCourtDetails) {
                                return $row->userDetails->pickleballCourtDetails->title.' ('.$row->userDetails->pickleballCourtDetails->city.', '.$row->userDetails->pickleballCourtDetails->stateDetails->code.')';
                            } else {
                                return 'NA';
                            }
                        })
                        ->addColumn('city', function ($row) {
                            if ($row->userDetails->city) {
                                return $row->userDetails->city;
                            } else {
                                return 'NA';
                            }
                        })
                        ->addColumn('created_at', function ($row) {
                            return memberSince($row->created_at, 'F jS, Y');
                        })
                        ->addColumn('status', function ($row) use ($isAllow, $allowedRoutes) {
                            if ($isAllow || in_array($this->statusUrl, $allowedRoutes)) {
                                if ($row->status == '1') {
                                    $status = ' <a href="javascript:void(0)" data-microtip-position="top" role="" aria-label="'.trans('custom_admin.label_active').'" data-id="'.customEncryptionDecryption($row->id).'" data-action-type="inactive" class="custom_font status"><span class="badge badge-pill badge-success">'.trans('custom_admin.label_active').'</span></a>';
                                } else {
                                    $status = ' <a href="javascript:void(0)" data-microtip-position="top" role="" aria-label="'.trans('custom_admin.label_inactive').'" data-id="'.customEncryptionDecryption($row->id).'" data-action-type="active" class="custom_font status"><span class="badge badge-pill badge-danger">'.trans('custom_admin.label_inactive').'</span></a>';
                                }
                            } else {
                                if ($row->status == '1') {
                                    $status = ' <a data-microtip-position="top" role="" aria-label="'.trans('custom_admin.label_active').'" class="custom_font"><span class="badge badge-pill badge-success">'.trans('custom_admin.label_active').'</span></a>';
                                } else {
                                    $status = ' <a data-microtip-position="top" role="" aria-label="'.trans('custom_admin.label_active').'" class="custom_font"><span class="badge badge-pill badge-danger">'.trans('custom_admin.label_inactive').'</span></a>';
                                }
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($row) use ($isAllow, $allowedRoutes) {
                            $btn = '';
                            if ($isAllow || in_array($this->editUrl, $allowedRoutes)) {
                                $editLink = route($this->routePrefix.'.'.$this->editUrl, customEncryptionDecryption($row->id));

                                $btn .= '<a href="'.$editLink.'" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_edit').'"><i class="fa fa-edit"></i></a>';
                            }
                            if ($isAllow || in_array($this->editUrl, $allowedRoutes)) {
                                $viewLink = route($this->routePrefix.'.'.$this->viewUrl, customEncryptionDecryption($row->id));

                                $btn .= ' <a href="'.$viewLink.'" data-microtip-position="top" role="tooltip" class="btn btn-warning btn-circle btn-circle-sm-eye" aria-label="'.trans('custom_admin.label_view').'"><i class="fa fa-eye"></i></a>';
                            }
                            if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                                $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm delete" aria-label="'.trans('custom_admin.label_delete').'" data-action-type="delete" data-id="'.customEncryptionDecryption($row->id).'"><i class="fa fa-trash"></i></a>';
                            }
                            return $btn;
                        })
                        ->rawColumns(['status','action'])
                        ->make(true);
            }
            return view($this->viewFolderPath.'.list');
        } catch (Exception $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return '';
        }
    }

    /*
        * Function name : edit
        * Purpose       : This function is to update form
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns why choose us data
    */
    public function edit(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_edit_player'),
            'panelTitle'    => trans('custom_admin.label_edit_player'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']                 = $id;
            $data['playerId']           = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']            = $details = $this->model->where(['id' => $id])->first();
            $data['pickleballCourts']   = PickleballCourt::select('id','title','city','state_id')->where(['status' => '1'])->whereNull('deleted_at')->orderBy('title', 'ASC')->get();
            $data['states']             = State::select('id','title','code')->orderBy('title', 'ASC')->get();
            $data['availabilities']     = Availability::select('id','title','short_code')->where(['status' => '1'])->whereNull('deleted_at')->orderBy('sort', 'ASC')->get();
            $userAvailabilities         = [];
            if ($details->userAvailabilityDetails) {
                foreach ($details->userAvailabilityDetails as $userAvailability) {
                    $userAvailabilities[] = $userAvailability->availability_id;
                }
            }
            $data['userAvailabilities'] = $userAvailabilities;
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'first_name'                    => 'required',
                    'last_name'                     => 'required',
                    'email'                         => 'required|regex:'.config('global.EMAIL_REGEX'),
                    'phone_no'                      => 'required',
                    'gender'                        => 'required',
                    'month'                         => 'required',
                    'day'                           => 'required',
                    'year'                          => 'required',
                    'player_rating'                 => 'required',
                    'home_court'                    => 'required',
                    'address_line_1'                => 'required',
                    'city'                          => 'required',
                    'state'                         => 'required',
                    'zip'                           => 'required',
                    // 'availability'               => 'required',
                    'profile_pic'                   => 'mimes:'.config('global.IMAGE_FILE_TYPES').'|max:'.config('global.IMAGE_MAX_UPLOAD_SIZE'),
                );
                $validationMessages = array(
                    'first_name.required'           => trans('custom_admin.error_first_name'),
                    'last_name.required'            => trans('custom_admin.error_last_name'),
                    'email.required'                => trans('custom_admin.error_email'),
                    'email.regex'                   => trans('custom_admin.error_email_valid'),
                    'phone_no.required'             => trans('custom_admin.error_phone'),
                    'gender.required'               => trans('custom_admin.error_gender'),
                    'day'                           => trans('custom_admin.error_day'),
                    'month'                         => trans('custom_admin.error_month'),
                    'year'                          => trans('custom_admin.error_year'),
                    'player_rating'                 => trans('custom_admin.error_player_rating'),
                    'home_court.required'           => trans('custom_admin.error_preferred_home_court'),
                    'address_line_1'                => trans('custom_admin.error_address_line_1'),
                    'city'                          => trans('custom_admin.error_city'),
                    'state'                         => trans('custom_admin.error_state'),
                    'zip'                           => trans('custom_admin.error_zip'),
                    // 'availability'                  => trans('custom_admin.error_availability'),
                    'profile_pic.mimes'             => trans('custom_admin.error_image_mimes'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $checkUserExist = $this->model->where('id', '<>', $id)->where(['email' => $request->email])->count();
                    if ($checkUserExist) {
                        $this->generateToastMessage('error', 'This email is already registered with us.', false);
                        return redirect()->back()->withInput();
                    } else {
                        if (count($request->availability) < 1) {
                            $this->generateToastMessage('error', trans('custom_admin.error_availability'), false);
                            return redirect()->back()->withInput();
                        } else {
                            $profileImage                   = $request->file('profile_pic');
                            $uploadedProfileImage           = '';
                            $previousFileName               = null;
                            $unlinkStatus                   = false;

                            // Profile pic upload
                            $uploadedProfileImage           = $details->profile_pic;
                            if ($profileImage != '') {
                                if ($details->profile_pic != null) {
                                    $previousFileName   = $details->profile_pic;
                                    $unlinkStatus       = true;
                                }
                                $uploadedProfileImage   = singleImageUpload('User', $profileImage, 'profile', 'account', true, $previousFileName, $unlinkStatus);
                            }

                            $update = $details->where(['id' => $id])->update([
                                'full_name'             => trim($request->first_name, ' ').' '.trim($request->last_name, ' '),
                                'first_name'            => trim($request->first_name, ' '),
                                'last_name'             => trim($request->last_name, ' '),
                                'email'                 => trim($request->email, ' '),
                                'phone_no'              => $request->phone_no,
                                'gender'                => $request->gender ?? 'M',
                                'dob'                   => $request->year.'-'.$request->month.'-'.$request->day,
                                'player_rating'         => $request->player_rating ?? null,
                                'profile_pic'           => $uploadedProfileImage,
                                'send_score_confirmation'=> $request->send_score_confirmation ? 'Y' : 'N',
                            ]);

                            if ($update) {
                                $userDetail['home_court']           = $request->home_court ?? null;
                                $userDetail['address_line_1']       = $request->address_line_1 ?? null;
                                $userDetail['address_line_2']       = $request->address_line_2 ?? null;
                                $userDetail['city']                 = $request->city ?? null;
                                $userDetail['state']                = $request->state ?? null;
                                $userDetail['zip']                  = $request->zip ?? null;
                                $userDetail['how_did_you_find_us']  = $request->how_did_you_find_us ?? null;
                                UserDetail::where(['user_id' => $id])->update($userDetail);

                                // Start :: User availability
                                UserAvailability::where(['user_id' => $id])->forceDelete();
                                $userAvailability = [];
                                if (isset($request->availability) && count($request->availability)) {
                                    foreach ($request->availability as $key => $item) {                    
                                        $userAvailability[$key]['user_id']          = $id;
                                        $userAvailability[$key]['availability_id']  = $item;
                                    }
                                    if (count($userAvailability)) {
                                        UserAvailability::insert($userAvailability);
                                    }
                                }
                                // End :: User availability
                                
                                $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                                return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                            } else {
                                $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_updating'), false);
                                return redirect()->back()->withInput();
                            }
                        }
                    }
                }
            }
            return view($this->viewFolderPath.'.edit', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

    /*
        * Function name : view
        * Purpose       : This function is to view details
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function view(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_view_player'),
            'panelTitle'    => trans('custom_admin.label_view_player'),
            'pageType'      => 'VIEWPAGE'
        ];

        try {
            $data['id']         = $id;
            $data['seasonId']   = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']    = $details = $this->model->where(['id' => $id])->first();
            
            return view($this->viewFolderPath.'.view', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

    /*
        * Function name : status
        * Purpose       : This function is to status
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request, $id = null
        * Return Value  : Returns json
    */
    public function status(Request $request, $id = null) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                $id = customEncryptionDecryption($id, 'decrypt');
                if ($id != null) {
                    $details = $this->model->where('id', $id)->first();
                    if ($details != null) {
                        if ($details->status == '1') {
                            $details->status = '0';
                            $details->save();

                            $title      = trans('custom_admin.message_success');
                            $message    = trans('custom_admin.success_status_updated_successfully');
                            $type       = 'success';
                        } else if ($details->status == '0') {
                            $details->status = '1';
                            $details->is_waiver_signed = 'Y';
                            $details->save();

                            $title      = trans('custom_admin.message_success');
                            $message    = trans('custom_admin.success_status_updated_successfully');
                            $type       = 'success';
                        }
                    } else {
                        $message = trans('custom_admin.error_invalid');
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
        * Function name : delete
        * Purpose       : This function is to delete record
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request, $id = null
        * Return Value  : Returns json
    */
    public function delete(Request $request, $id = null) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';
        
        try {
            if ($request->ajax()) {
                $id = customEncryptionDecryption($id, 'decrypt');
                if ($id != null) {
                    $details = $this->model->where('id', $id)->first();
                    if ($details != null) {
                        UserDetail::where('user_id', $id)->delete();
                        UserAvailability::where('user_id', $id)->delete();
                        
                        $delete = $details->forceDelete();

                        if ($delete) {
                            $title      = trans('custom_admin.message_success');
                            $message    = trans('custom_admin.success_data_deleted_successfully');
                            $type       = 'success';
                        } else {
                            $message    = trans('custom_admin.error_took_place_while_deleting');
                        }
                        
                    } else {
                        $message = trans('custom_admin.error_invalid');
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
        * Function name : bulkActions
        * Purpose       : This function is to delete record, active/inactive
        * Input Params  : Request $request
        * Return Value  : Returns json
    */
    public function bulkActions(Request $request) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->ajax()) {
                $selectedIds    = $request->selectedIds;
                $actionType     = $request->actionType;
                
                if (count($selectedIds) > 0) {
                    foreach ($selectedIds as $key => $id) {
                        $userDetails = $this->model->where('id', $id)->first();

                        if ($actionType ==  'active') {
                            $userDetails->status = '1';
                            if ($userDetails->save()) {
                                // Mail to user
                                // $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);
                                // dispatch(new SendProfileActiveInactiveStatusToUser($userDetails->toArray(), 'active', $siteSettings));
                            }
                        } else if ($actionType ==  'inactive') {
                            $userDetails->status = '0';
                            if ($userDetails->save()) {
                                // Mail to user
                                // $siteSettings = getSiteSettingsWithSelectFields(['from_email', 'to_email', 'website_title', 'copyright_text', 'tag_line']);
                                // dispatch(new SendProfileActiveInactiveStatusToUser($userDetails->toArray(), 'inactive', $siteSettings));
                            }
                        }
                         else if ($actionType ==  'delete') {
                            UserDetail::where('user_id', $id)->delete();
                            UserAvailability::where('user_id', $id)->delete();

                            $this->model->where('id', $id)->delete();
                            $message    = trans('custom_admin.success_data_deleted_successfully');
                        }
                    }

                    $title      = trans('custom_admin.message_success');
                    $message    = trans('custom_admin.success_status_updated_successfully');
                    $type       = 'success';
                } else {
                    $message = trans('custom_admin.error_invalid');
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        } catch (\Throwable $e) {
            $message = $e->getMessage();
        }
        return response()->json(['title' => $title, 'message' => $message, 'type' => $type]);
    }

}