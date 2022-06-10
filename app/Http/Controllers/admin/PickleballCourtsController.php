<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : PickleballCourtsController
# Purpose           : Pickleball Court Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use App\Traits\GeneralMethods;
use App\Models\State;
use App\Models\Net;
use App\Models\PickleballCourt;
use App\Models\PickleballCourtNetAvailability;
use DataTables;

class PickleballCourtsController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'PickleballCourts';
    public $management;
    public $modelName       = 'PickleballCourt';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'pickleballCourt';
    public $listUrl         = 'pickleballCourt.list';
    public $listRequestUrl  = 'pickleballCourt.ajax-list-request';
    public $addUrl          = 'pickleballCourt.add';
    public $editUrl         = 'pickleballCourt.edit';
    public $statusUrl       = 'pickleballCourt.change-status';
    public $deleteUrl       = 'pickleballCourt.delete';
    public $viewFolderPath  = 'admin.pickleballCourt';
    public $model           = 'PickleballCourt';

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

        $this->management   = trans('custom_admin.label_pickleball_court');
        $this->model        = new PickleballCourt();

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
            'pageTitle'     => trans('custom_admin.label_pickleball_court_list'),
            'panelTitle'    => trans('custom_admin.label_pickleball_court_list'),
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
        $data['pageTitle'] = trans('custom_admin.label_pickleball_court_list');
        $data['panelTitle']= trans('custom_admin.label_pickleball_court_list');

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
                        ->addColumn('state', function ($row) {
                            if ($row->stateDetails) {
                                return $row->stateDetails->title;
                            } else {
                                return 'NA';
                            }
                        })
                        ->addColumn('entered_by', function ($row) {
                            if ($row->enteredByDetails) {
                                return $row->enteredByDetails->full_name;
                            } else {
                                return 'NA';
                            }
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
            'pageTitle'     => trans('custom_admin.label_add_pickleball_court'),
            'panelTitle'    => trans('custom_admin.label_add_pickleball_court'),
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'title'     => 'required',
                    'state_id'  => 'required',
                    'city'      => 'required',
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
                    $saveData                               = [];
                    $saveData['title']                      = $request->title ?? null;
                    $saveData['slug']                       = generateUniqueSlug($this->model, trim($request->title,' '));
                    $saveData['state_id']                   = $request->state_id ?? null;
                    $saveData['city']                       = $request->city ?? null;
                    $saveData['address']                    = $request->address ?? null;
                    $saveData['address_2']                  = $request->address_2 ?? null;
                    $saveData['zip']                        = $request->zip ?? null;
                    $saveData['accessibility']              = $request->accessibility ?? null;
                    $saveData['indoor_outdoor']             = $request->indoor_outdoor ?? null;
                    $saveData['number_of_courts']           = $request->number_of_courts ?? null;
                    $saveData['lights']                     = $request->lights ?? null;
                    $saveData['cost']                       = $request->cost ?? null;
                    $saveData['reservations_requirements']  = $request->reservations_requirements ?? null;
                    $saveData['phone_no']                   = $request->phone_no ?? null;
                    $saveData['website']                    = $request->website ?? null;
                    $saveData['sort']                       = generateSortNumber($this->model);
                    $saveData['entered_by_user_id']         = Auth::guard('admin')->user()->id ?? null;
                    $save = $this->model->create($saveData);

                    if ($save) {
                        // Inserting data
                        if (isset($request->net_availability) && count($request->net_availability)) {
                            $netAvailability = [];
                            foreach ($request->net_availability as $key => $item) {                    
                                $netAvailability[$key]['pickleball_court_id']   = $save->id;
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
            'pageTitle'     => trans('custom_admin.label_edit_pickleball_court'),
            'panelTitle'    => trans('custom_admin.label_edit_pickleball_court'),
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
                            PickleballCourtNetAvailability::where('pickleball_court_id', $id)->delete();
                            
                            $netAvailability = [];
                            foreach ($request->net_availability as $key => $item) {                    
                                $netAvailability[$key]['pickleball_court_id']   = $id;
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