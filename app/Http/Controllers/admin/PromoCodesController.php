<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : PromoCodesController
# Purpose           : Promo Code Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\PromoCode;
use DataTables;

class PromoCodesController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'PromoCodes';
    public $management;
    public $modelName       = 'PromoCode';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'promoCode';
    public $listUrl         = 'promoCode.list';
    public $listRequestUrl  = 'promoCode.ajax-list-request';
    public $addUrl          = 'promoCode.add';
    public $editUrl         = 'promoCode.edit';
    public $statusUrl       = 'promoCode.change-status';
    public $deleteUrl       = 'promoCode.delete';
    public $sortUrl         = 'promoCode.sort';
    public $viewFolderPath  = 'admin.promoCode';
    public $model           = 'PromoCode';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct($data = null) {
        parent::__construct();

        $this->management       = trans('custom_admin.label_menu_promo_code');
        $this->model            = new PromoCode();

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
            'pageTitle'     => trans('custom_admin.label_promo_code_list'),
            'panelTitle'    => trans('custom_admin.label_promo_code_list'),
            'pageType'      => 'LISTPAGE'
        ];

        try {
            // Start :: Manage restriction
            $data['isAllow'] = false;
            $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
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
        * Return Value  : Returns why choose us data
    */
    public function ajaxListRequest(Request $request) {
        $data['pageTitle'] = trans('custom_admin.label_promo_code_list');
        $data['panelTitle']= trans('custom_admin.label_promo_code_list');

        try {
            if ($request->ajax()) {
                $data = $this->model->orderBy('id', 'desc')->get();
                $amount = 0;
                $duration = '';
                
                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes, $amount)
                        ->addIndexColumn()
                        ->addColumn('updated_at', function ($row) {
                            return changeDateFormat($row->updated_at);
                        })
                        ->addColumn('discount_type', function ($row) {
                            if ($row->discount_type == 'F') {
                                return trans('custom_admin.label_flat');
                            } else {
                                return trans('custom_admin.label_percent');
                            }
                        })
                        ->addColumn('amount', function ($row) {
                            return $amount = formatToTwoDecimalPlaces($row->amount);
                        })
                        ->addColumn('is_one_time_use', function ($row) {
                            if ($row->is_one_time_use == 'N') {
                                return trans('custom_admin.label_no');
                            } else {
                                return trans('custom_admin.label_yes');
                            }
                        })
                        ->addColumn('maximum_number_of_use', function ($row) {
                            if ($row->maximum_number_of_use !== NULL) {
                                return $row->maximum_number_of_use;
                            } else {
                                return 'NA';
                            }
                        })
                        ->addColumn('duration', function ($row) {
                            $duration = date('Y-m-d H:i', $row->start_time);
                            if ($row->end_time != null) {
                                $duration .= ' - '.date('Y-m-d H:i', $row->end_time);
                            } else {
                                $duration .= ' - NA';
                            }
                            return $duration;
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
                            $allowButtons = true;
                            if ($row->end_time !== NULL) {
                                if ( (strtotime(getCurrentDateTimeWithoutAmPm()) > $row->start_time) && (strtotime(getCurrentDateTimeWithoutAmPm()) < $row->end_time) ) {
                                    $allowButtons = false;
                                }
                            } else {
                                if (strtotime(getCurrentDateTimeWithoutAmPm()) > $row->start_time) {
                                    $allowButtons = false;
                                }
                            }

                            if ($allowButtons) {
                                if ($isAllow || in_array($this->editUrl, $allowedRoutes)) {
                                    $editLink = route($this->routePrefix.'.'.$this->editUrl, customEncryptionDecryption($row->id));
                                    
                                    $btn .= '<a href="'.$editLink.'" data-microtip-position="top" role="tooltip" class="btn btn-info btn-circle btn-circle-sm" aria-label="'.trans('custom_admin.label_edit').'"><i class="fa fa-edit"></i></a>';
                                }
                                if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                                    $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm delete" aria-label="'.trans('custom_admin.label_delete').'" data-action-type="delete" data-id="'.customEncryptionDecryption($row->id).'"><i class="fa fa-trash"></i></a>';
                                }
                            }
                            return $btn;
                        })
                        ->rawColumns(['amount','duration','status','action'])
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
        * Purpose       : This function is to add
        * Author        : 
        * Created Date  : 
        * Modified date : 
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function add(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_add_promo_code'),
            'panelTitle'    => trans('custom_admin.label_add_promo_code'),
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'code'                  => 'required|regex:'.config('global.VALID_ALPHA_NUMERIC').'|unique:'.($this->model)->getTable().',code,NULL,id,deleted_at,NULL',
                    'maximum_number_of_use' => 'nullable|regex:'.config('global.VALID_POSITIVE_NUMBER'),
                    'discount_type'         => 'required',
                    'amount'                => 'required|regex:'.config('global.VALID_AMOUNT_REGEX_EXCEPT_ZERO'),
                    'start_time'            => 'required',
                );
                $validationMessages = array(
                    'code.required'                 => trans('custom_admin.error_promo_code_code'),
                    'code.regex'                    => trans('custom_admin.error_promo_code_code_valid'),
                    'code.unique'                   => trans('custom_admin.error_promo_code_code_unique'),
                    'maximum_number_of_use.regex'   => trans('custom_admin.error_maximum_number_of_use'),
                    'discount_type.required'        => trans('custom_admin.error_discount_type'),
                    'amount.required'               => trans('custom_admin.error_amount'),
                    'amount.regex'                  => trans('custom_admin.error_valid_amount'),
                    'start_time.required'           => trans('custom_admin.error_promo_code_duration')
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $saveData                           = [];
                    $saveData['code']                   = isset($request->code) ? trim($request->code, ' ') : null;
                    $saveData['is_one_time_use']        = isset($request->is_one_time_use) ? $request->is_one_time_use : 'Y';
                    $saveData['maximum_number_of_use']  = $saveData['is_one_time_use'] == 'N' ? $request->maximum_number_of_use : null;
                    $saveData['discount_type']          = $request->discount_type ?? 'F';
                    $saveData['amount']                 = $request->amount ?? 0;
                    $startTime                          = date('Y-m-d H:i', strtotime($request->start_time));
                    $endTime                            = isset($request->end_time) ? date('Y-m-d H:i', strtotime($request->end_time)) : null;
                    $saveData['start_date_time']        = $startTime;
                    $saveData['end_date_time']          = $endTime;
                    $saveData['start_time']             = strtotime($startTime);
                    $saveData['end_time']               = isset($request->end_time) ? strtotime(date('Y-m-d H:i', strtotime($request->end_time))) : null;
                    $save = $this->model->create($saveData);
                    
                    if ($save) {
                        $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                        return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                    } else {
                        $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_adding'), false);
                        return redirect()->back()->withInput();
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
        * Purpose       : This function is to update form
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Returns coupon data
    */
    public function edit(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_edit_promo_code'),
            'panelTitle'    => trans('custom_admin.label_edit_promo_code'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']         = $id;
            $data['couponId']   = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']    = $details = $this->model->where(['id' => $id])->first();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'code'                  => 'required|regex:'.config('global.VALID_ALPHA_NUMERIC').'|unique:'.($this->model)->getTable().',code,'.$id.',id,deleted_at,NULL',
                    'maximum_number_of_use' => 'regex:'.config('global.VALID_POSITIVE_NUMBER'),
                    'discount_type'         => 'required',
                    'amount'                => 'required|regex:'.config('global.VALID_AMOUNT_REGEX_EXCEPT_ZERO'),
                    'start_time'            => 'required',
                );
                $validationMessages = array(
                    'code.required'                 => trans('custom_admin.error_promo_code_code'),
                    'code.regex'                    => trans('custom_admin.error_promo_code_code_valid'),
                    'code.unique'                   => trans('custom_admin.error_promo_code_code_unique'),
                    'maximum_number_of_use.regex'   => trans('custom_admin.error_maximum_number_of_use'),
                    'discount_type.required'        => trans('custom_admin.error_discount_type'),
                    'amount.required'               => trans('custom_admin.error_amount'),
                    'amount.regex'                  => trans('custom_admin.error_valid_amount'),
                    'start_time.required'           => trans('custom_admin.error_promo_code_duration')
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $process = true;
                    if ($request->end_time) {
                        if (strtotime($request->end_time) < strtotime($request->start_time)) {
                            $process = false;
                        }
                    }

                    if (!$process) {
                        $this->generateToastMessage('error', trans('custom_admin.error_start_end_date_time'), false);
                        return redirect()->back()->withInput();
                    } else {
                        $startTime  = date('Y-m-d H:i', strtotime($request->start_time));
                        
                        $updateData                             = [];

                        $updateData['code']                     = isset($request->code) ? trim($request->code, ' ') : null;
                        $updateData['is_one_time_use']          = isset($request->is_one_time_use) ? $request->is_one_time_use : 'Y';
                        $updateData['maximum_number_of_use']    = $updateData['is_one_time_use'] == 'N' ? $request->maximum_number_of_use : null;
                        $updateData['discount_type']            = $request->discount_type ?? 'F';
                        $updateData['amount']                   = $request->amount ?? 0;
                        $startTime                              = date('Y-m-d H:i', strtotime($request->start_time));
                        $endTime                                = isset($request->end_time) ? date('Y-m-d H:i', strtotime($request->end_time)) : null;
                        $updateData['start_date_time']          = $startTime;
                        $updateData['end_date_time']            = $endTime;
                        $updateData['start_time']               = strtotime($startTime);
                        $updateData['end_time']                 = isset($request->end_time) ? strtotime(date('Y-m-d H:i', strtotime($request->end_time))) : null;
                        $update = $details->update($updateData);

                        if ($update) {
                            $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                        } else {
                            $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_updating'), false);
                            return redirect()->back()->withInput();
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
                        $this->model->where('id', $selectedIds)->update(['status' => '0']);
                        $message    = trans('custom_admin.success_status_updated_successfully');
                    } else if ($actionType ==  'delete') {
                        $this->model->where('id', $selectedIds)->delete();
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
