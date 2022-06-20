<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : LeaguesController
# Purpose           : League Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use App\Traits\GeneralMethods;
use App\Models\State;
use App\Models\League;
use DataTables;

class LeaguesController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'Leagues';
    public $management;
    public $modelName       = 'League';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'league';
    public $listUrl         = 'league.list';
    public $listRequestUrl  = 'league.ajax-list-request';
    public $addUrl          = 'league.add';
    public $editUrl         = 'league.edit';
    public $statusUrl       = 'league.change-status';
    public $deleteUrl       = 'league.delete';
    public $viewFolderPath  = 'admin.league';
    public $model           = 'League';

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

        $this->management   = trans('custom_admin.label_league');
        $this->model        = new League();

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
            'pageTitle'     => trans('custom_admin.label_league_list'),
            'panelTitle'    => trans('custom_admin.label_league_list'),
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
        $data['pageTitle'] = trans('custom_admin.label_league_list');
        $data['panelTitle']= trans('custom_admin.label_league_list');

        try {
            if ($request->ajax()) {
                // Main query
                $data = $this->model->whereNull(['deleted_at']);

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
                        ->addColumn('play_type', function ($row) {
                            if ($row->play_type == 'S') {
                                return 'Singles';
                            } else {
                                return 'Doubles';
                            }
                        })
                        ->addColumn('gender', function ($row) {
                            if ($row->gender == 'M') {
                                return 'Male';
                            } else if ($row->gender == 'F') {
                                return 'Female';
                            } else {
                                return 'Mixed';
                            }
                        })
                        ->addColumn('rating', function ($row) {
                            if ($row->rating_end == 100) {
                                return formatToOneDecimalPlaces($row->rating_start).' +';
                            } else {
                                return $row->rating;
                            }
                        })
                        ->addColumn('date', function ($row) {
                            return changeDateFormatFromUnixTimestamp($row->start_time, 'm/d').' - '.changeDateFormatFromUnixTimestamp($row->end_time, 'm/d');
                        })
                        ->addColumn('updated_at', function ($row) {
                            return changeDateFormat($row->created_at, 'm/d/Y');
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
                            // if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                            //     $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm delete" aria-label="'.trans('custom_admin.label_delete').'" data-action-type="delete" data-id="'.customEncryptionDecryption($row->id).'"><i class="fa fa-trash"></i></a>';
                            // }
                            return $btn;
                        })
                        ->rawColumns(['state','status','action'])
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
        * Function name : add
        * Purpose       : This function is to add page
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function add(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_add_league'),
            'panelTitle'    => trans('custom_admin.label_add_league'),
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'title'                         => 'required|unique:'.($this->model)->getTable().',title,NULL,id,deleted_at,NULL',
                    'zip'                           => 'required|regex:'.config('global.VALID_POSITIVE_NUMBER'),
                    'play_type'                     => 'required',
                    'gender'                        => 'required',
                    'rating'                        => 'required',
                    'amount'                        => 'required|regex:'.config('global.VALID_AMOUNT_REGEX'),
                    'maximum_registration_allowed'  => 'required|regex:'.config('global.VALID_POSITIVE_NUMBER'),
                    'start_end_date'                => 'required',
                );
                $validationMessages = array(
                    'title.required'                        => trans('custom_admin.error_title'),
                    'title.unique'                          => trans('custom_admin.error_title_unique'),
                    'zip.required'                          => trans('custom_admin.error_zip'),
                    'zip.regex'                             => trans('custom_admin.error_enter_valid_zip'),
                    'play_type.required'                    => trans('custom_admin.error_play_type'),
                    'gender.required'                       => trans('custom_admin.error_gender'),
                    'rating.required'                       => trans('custom_admin.error_rating'),
                    'amount.required'                       => trans('custom_admin.error_amount'),
                    'amount.regex'                          => trans('custom_admin.error_valid_amount'),
                    'maximum_registration_allowed.required' => trans('custom_admin.error_maximum_registration_allowed'),
                    'maximum_registration_allowed.regex'    => trans('custom_admin.error_valid_maximum_registration_allowed'),
                    'start_end_date.required'               => trans('custom_admin.error_start_end_date'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $locationDetails  = getZipToLocation($request->zip);
                    
                    if (isset($locationDetails->error_code) && $locationDetails->error_code == 404) {
                        $this->generateToastMessage('error', trans('custom_admin.error_invalid_zip'), false);
                        return redirect()->back()->withInput();
                    } else {
                        $stateDetails = State::where(['code' => $locationDetails->state])->first();
                        if ($stateDetails) {
                            $saveData                                   = [];
                            $saveData['title']                          = $request->title ?? null;
                            $saveData['slug']                           = generateUniqueSlug($this->model, trim($request->title,' '));
                            $saveData['zip']                            = $request->zip ?? null;
                            $saveData['lat']                            = $locationDetails->lat ?? null;
                            $saveData['lng']                            = $locationDetails->lng ?? null;
                            $saveData['state_id']                       = $stateDetails->id ?? null;
                            $saveData['state']                          = $stateDetails->title ?? null;
                            $saveData['city']                           = $locationDetails->city ?? null;
                            $saveData['play_type']                      = $request->play_type ?? 'D';
                            $saveData['gender']                         = $request->gender ?? 'M';
                            $saveData['rating']                         = $request->rating ?? null;
                            $rating                                     = $request->rating ?? 'M';
                            if ($rating) {
                                $explodedRating                         = explode(' - ', $rating);
                                $saveData['rating_start']               = $explodedRating[0];
                                $saveData['rating_end']                 = $explodedRating[1];
                            }
                            if ($request->start_end_date) {
                                $explodedStartEndDate                   = explode(' - ', $request->start_end_date);
                                $startDateTime                          = date('Y-m-d 00:00:00', strtotime($explodedStartEndDate[0]));
                                $endDateTime                            = date('Y-m-d 23:59:59', strtotime($explodedStartEndDate[1]));
                                $saveData['start_date_time']            = $startDateTime;
                                $saveData['end_date_time']              = $endDateTime;
                                $saveData['start_time']                 = strtotime($startDateTime);
                                $saveData['end_time']                   = strtotime($endDateTime);
                            }
                            $saveData['maximum_registration_allowed']   = $request->maximum_registration_allowed ?? null;
                            $saveData['amount']                         = $request->amount ?? 0;
                            $saveData['sort']                           = generateSortNumber($this->model);
                            $save = $this->model->create($saveData);

                            if ($save) {
                                $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                                return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                            } else {
                                $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_updating'), false);
                                return redirect()->back()->withInput();
                            }
                        } else {
                            $this->generateToastMessage('error', trans('custom_admin.error_invalid_state'), false);
                            return redirect()->back()->withInput();
                        }
                    }
                }
            }

            return view($this->viewFolderPath.'.add', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

    /*
        * Function name : edit
        * Purpose       : This function is to edit news
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns data
    */
    public function edit(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_edit_league'),
            'panelTitle'    => trans('custom_admin.label_edit_league'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']             = $id;
            $data['pickleballId']   = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']        = $details = $this->model->where(['id' => $id])->first();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->pageRoute.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'title'     => 'required',
                    'state_id'  => 'required',
                    'city'   => 'required',
                );
                $validationMessages = array(
                    'title.required'    => 'Please enter court name.',
                    'state_id.required' => 'Please select state.',
                    'city.required'     => 'Please enter city.',
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $updateData                             = [];
                    $updateData['title']                    = $request->title ?? null;
                    $updateData['slug']                     = generateUniqueSlug($this->model, trim($request->title,' '), $data['id']);
                    $updateData['state_id']                 = $request->state_id ?? null;
                    $updateData['city']                     = $request->city ?? null;
                    $updateData['address']                  = $request->address ?? null;
                    $updateData['address_2']                = $request->address_2 ?? null;
                    $updateData['zip']                      = $request->zip ?? null;
                    $updateData['accessibility']            = $request->accessibility ?? 'U';
                    $updateData['indoor_outdoor']           = $request->indoor_outdoor ?? 'U';
                    $updateData['number_of_courts']         = $request->number_of_courts ?? null;
                    $updateData['lights']                   = $request->lights ?? 'U';
                    $updateData['cost']                     = $request->cost ?? 'U';
                    $updateData['reservations_requirements']= $request->reservations_requirements ?? 'U';
                    $updateData['phone_no']                 = $request->phone_no ?? null;
                    $updateData['website']                  = $request->website ?? null;
                    $update = $details->update($updateData);
                    
                    if ($update) {
                        // Inserting data
                        if (isset($request->net_availability) && count($request->net_availability)) {
                            PickleballCourtNetAvailability::where('league_id', $id)->delete();
                            
                            $netAvailability = [];
                            foreach ($request->net_availability as $key => $item) {                    
                                $netAvailability[$key]['league_id']   = $id;
                                $netAvailability[$key]['net_id']                = $item;
                            }
                            if (count($netAvailability)) {
                                PickleballCourtNetAvailability::insert($netAvailability);
                            }
                        }

                        $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                        return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                    } else {
                        $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_updating'), false);
                        return redirect()->back()->withInput();
                    }
                }
            }

            $data['states'] = State::get();
            $data['nets']   = Net::get();
            $selectedNetIds = [];
            if ($details->pickleballCourtNetAvailabilityDetails) {
                foreach ($details->pickleballCourtNetAvailabilityDetails as $item) {
                    $selectedNetIds[] = $item->net_id;
                }
            }
            $data['selectedNetIds'] = $selectedNetIds;

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
                        if ($details->status == 1) {
                            $details->status = '0';
                            $details->save();
                            
                            $title      = trans('custom_admin.message_success');
                            $message    = trans('custom_admin.success_status_updated_successfully');
                            $type       = 'success';
                        } else if ($details->status == 0) {
                            $details->status = '1';
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
                        $delete = $details->delete();
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
                    if ($actionType ==  'active') {
                        $this->model->whereIn('id', $selectedIds)->update(['status' => '1']);
                        $message    = trans('custom_admin.success_status_updated_successfully');
                    } else if ($actionType ==  'inactive') {
                        $this->model->whereIn('id', $selectedIds)->update(['status' => '0']);
                        $message    = trans('custom_admin.success_status_updated_successfully');
                    } else if ($actionType ==  'delete') {
                        $this->model->whereIn('id', $selectedIds)->delete();
                        $message    = trans('custom_admin.success_data_deleted_successfully');
                    }
                    $title      = trans('custom_admin.message_success');
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