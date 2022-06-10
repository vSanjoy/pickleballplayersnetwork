<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : BannersController
# Purpose           : Banner Management
/*****************************************************/

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\Traits\GeneralMethods;
use App\Models\Banner;
use DataTables;

class BannersController extends Controller
{
    use GeneralMethods;
    public $controllerName  = 'Banner';
    public $management;
    public $modelName       = 'Banner';
    public $breadcrumb;
    public $routePrefix     = 'admin';
    public $pageRoute       = 'banner';
    public $listUrl         = 'banner.list';
    public $listRequestUrl  = 'banner.ajax-list-request';
    public $addUrl          = 'banner.add';
    public $editUrl         = 'banner.edit';
    public $statusUrl       = 'banner.change-status';
    public $deleteUrl       = 'banner.delete';
    public $viewFolderPath  = 'admin.banner';
    public $model           = 'Banner';

    /*
        * Function Name : __construct
        * Purpose       : It sets some public variables for being accessed throughout this
        *                   controller and its related view pages
        * Input Params  : Void
        * Return Value  : Mixed
    */
    public function __construct($data = null) {
        parent::__construct();

        $this->management   = trans('custom_admin.label_menu_banner');
        $this->model        = new Banner();

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
            'pageTitle'     => trans('custom_admin.label_banner_list'),
            'panelTitle'    => trans('custom_admin.label_banner_list'),
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
        $data['pageTitle'] = trans('custom_admin.label_banner_list');
        $data['panelTitle']= trans('custom_admin.label_banner_list');

        try {
            if ($request->ajax()) {
                $data = $this->model->orderBy('id', 'desc')->get();
                $sessionPrice = 0;
                
                // Start :: Manage restriction
                $isAllow = false;
                $restrictions   = checkingAllowRouteToUser($this->pageRoute.'.');
                if ($restrictions['is_super_admin']) {
                    $isAllow = true;
                }
                $allowedRoutes  = $restrictions['allow_routes'];
                // End :: Manage restriction

                return Datatables::of($data, $isAllow, $allowedRoutes,$sessionPrice)
                        ->addIndexColumn()
                        ->addColumn('image', function ($row) use ($isAllow, $allowedRoutes) {
                            $image = asset('images/'.config('global.NO_IMAGE'));
                            if ($row->image != null && file_exists(public_path('images/uploads/'.$this->pageRoute.'/'.$row->image))) {
                                $image = asset('images/uploads/'.$this->pageRoute.'/'.$row->image);
                                // if (file_exists(public_path('images/uploads/'.$this->pageRoute.'/thumbs/'.$row->image))) {
                                //     $image = asset('images/uploads/'.$this->pageRoute.'/thumbs/'.$row->image);
                                // }
                            }
                            return $image;
                        })
                        ->addColumn('title', function ($row) {
                            return excerpts($row->title, 10);
                        })
                        ->addColumn('updated_at', function ($row) {
                            return changeDateFormat($row->updated_at);
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
                            if ($isAllow || in_array($this->deleteUrl, $allowedRoutes)) {
                                $btn .= ' <a href="javascript: void(0);" data-microtip-position="top" role="tooltip" class="btn btn-danger btn-circle btn-circle-sm delete" aria-label="'.trans('custom_admin.label_delete').'" data-action-type="delete" data-id="'.customEncryptionDecryption($row->id).'"><i class="fa fa-trash"></i></a>';
                            }
                            return $btn;
                        })
                        ->rawColumns(['session_price','status','action'])
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
        * Purpose       : This function is to add testimonial
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : 
    */
    public function add(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_add_banner'),
            'panelTitle'    => trans('custom_admin.label_add_banner'),
            'pageType'      => 'CREATEPAGE'
        ];

        try {
            if ($request->isMethod('POST')) {
                $validationCondition = array(
                    'title'         => 'required',
                    'image'         => 'required|mimes:'.config('global.IMAGE_FILE_TYPES').'|max:'.config('global.IMAGE_MAX_UPLOAD_SIZE'),
                    'image_mobile'  => 'required|mimes:'.config('global.IMAGE_FILE_TYPES').'|max:'.config('global.IMAGE_MAX_UPLOAD_SIZE'),
                );
                $validationMessages = array(
                    'title.required'        => trans('custom_admin.error_title'),
                    'image.required'        => trans('custom_admin.error_image'),
                    'image.mimes'           => trans('custom_admin.error_image_mimes'),
                    'image_mobile.required' => trans('custom_admin.error_image'),
                    'image_mobile.mimes'    => trans('custom_admin.error_image_mimes'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $saveData               = [];
                    $image                  = $request->file('image');
                    $imageMobile            = $request->file('image_mobile');
                    $uploadedImage          = $uploadedMobileImage = '';
                    if ($image != '') {
                        $uploadedImage      = singleImageUpload($this->modelName, $image, 'banner', $this->pageRoute, false); // If thumb true, mention size in global.php
                        $saveData['image']  = $uploadedImage;
                    }
                    if ($imageMobile != '') {
                        $uploadedMobileImage= singleImageUpload($this->modelName, $imageMobile, 'banner_mobile', $this->pageRoute, false); // If thumb true, mention size in global.php
                        $saveData['image_mobile']   = $uploadedMobileImage;
                    }
                    $saveData['title']              = $request->title ?? null;
                    $saveData['short_title']        = $request->short_title ?? null;
                    $saveData['short_description']  = $request->short_description ?? null;
                    $saveData['sort']               = generateSortNumber($this->model);
                    $saveData['image_title']        = $request->image_title ?? null;
                    $saveData['image_alt']          = $request->image_alt ?? null;
                    $saveData['image_title_mobile'] = $request->image_title_mobile ?? null;
                    $saveData['image_alt_mobile']   = $request->image_alt_mobile ?? null;
                    $save = $this->model->create($saveData);

                    if ($save) {
                        $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                        return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                    } else {
                        // If files uploaded then delete those files
                        unlinkFiles($uploadedImage, $this->pageRoute, false);
                        unlinkFiles($uploadedMobileImage, $this->pageRoute, false);

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
        * Return Value  : Returns why choose us data
    */
    public function edit(Request $request, $id = null) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_edit_banner'),
            'panelTitle'    => trans('custom_admin.label_edit_banner'),
            'pageType'      => 'EDITPAGE'
        ];

        try {
            $data['id']         = $id;
            $data['bannerId']   = $id = customEncryptionDecryption($id, 'decrypt');
            $data['details']    = $details = $this->model->where(['id' => $id])->first();
            
            if ($request->isMethod('POST')) {
                if ($id == null) {
                    $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
                    return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                }
                $validationCondition = array(
                    'title'         => 'required',
                    'image'         => 'mimes:'.config('global.IMAGE_FILE_TYPES').'|max:'.config('global.IMAGE_MAX_UPLOAD_SIZE'),
                    'image_mobile'  => 'mimes:'.config('global.IMAGE_FILE_TYPES').'|max:'.config('global.IMAGE_MAX_UPLOAD_SIZE'),
                );
                $validationMessages = array(
                    'title.required'    => trans('custom_admin.error_title'),
                    'image.mimes'       => trans('custom_admin.error_image_mimes'),
                    'image_mobile.mimes'=> trans('custom_admin.error_image_mimes'),
                );
                $validator = \Validator::make($request->all(), $validationCondition, $validationMessages);
                if ($validator->fails()) {
                    $validationFailedMessages = validationMessageBeautifier($validator->messages()->getMessages());
                    $this->generateToastMessage('error', $validationFailedMessages, false);
                    return redirect()->back()->withInput();
                } else {
                    $updateData         = [];
                    $image              = $request->file('image');
                    $imageMobile        = $request->file('image_mobile');
                    $uploadedImage      = '';
                    $uploadedImageMobile= '';
                    $previousFileName   = null;
                    $previousFileNameMobile = null;
                    $unlinkStatus       = false;
                    $unlinkStatusMobile = false;
                    if ($image != '') {
                        if ($details['image'] != null) {
                            $previousFileName   = $details['image'];
                            $unlinkStatus       = true;
                        }
                        $uploadedImage          = singleImageUpload($this->modelName, $image, 'banner', $this->pageRoute, false, $previousFileName, $unlinkStatus);
                        $updateData['image']    = $uploadedImage;
                    }
                    if ($imageMobile != '') {
                        if ($details['image_mobile'] != null) {
                            $previousFileNameMobile   = $details['image_mobile'];
                            $unlinkStatusMobile       = true;
                        }
                        $uploadedImageMobile            = singleImageUpload($this->modelName, $imageMobile, 'banner_mobile', $this->pageRoute, false, $previousFileNameMobile, $unlinkStatusMobile);
                        $updateData['image_mobile']     = $uploadedImageMobile;
                    }
                    $updateData['title']              = $request->title ?? null;
                    $updateData['short_title']        = $request->short_title ?? null;
                    $updateData['short_description']  = $request->short_description ?? null;
                    $updateData['image_title']        = $request->image_title ?? null;
                    $updateData['image_alt']          = $request->image_alt ?? null;
                    $updateData['image_title_mobile'] = $request->image_title_mobile ?? null;
                    $updateData['image_alt_mobile']   = $request->image_alt_mobile ?? null;
                    $update = $details->update($updateData);

                    if ($update) {
                        $this->generateToastMessage('success', trans('custom_admin.success_data_updated_successfully'), false);
                        return redirect()->route($this->routePrefix.'.'.$this->listUrl);
                    } else {
                        // If files uploaded then delete those files
                        unlinkFiles($uploadedImage, $this->pageRoute, false);
                        
                        $this->generateToastMessage('error', trans('custom_admin.error_took_place_while_updating'), false);
                        return redirect()->back()->withInput();
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
        * Function name : sort
        * Purpose       : This function is to display record as per sort order
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Display list of records
    */
    public function sort(Request $request) {
        $data = [
            'pageTitle'     => trans('custom_admin.label_sort'),
            'panelTitle'    => trans('custom_admin.label_sort'),
            'pageType'      => 'SORTPAGE',
            'order_by'      => 'sort',
            'order'         => 'asc'
        ];        

        try {
            $list = $this->model->whereNull('deleted_at')->orderBy($data['order_by'], $data['order'])->get();
            if ($list->count()) {
                $data['list'] = $list;
            } else {
                $data['list'] = [];
            }
            return view($this->viewFolderPath.'.sort', $data);
        } catch (Exception $e) {
            $this->generateToastMessage('error', trans('custom_admin.error_something_went_wrong'), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        } catch (\Throwable $e) {
            $this->generateToastMessage('error', $e->getMessage(), false);
            return redirect()->route($this->routePrefix.'.'.$this->listUrl);
        }
    }

    /*
        * Function name : saveSort
        * Purpose       : This function is to save sort
        * Author        :
        * Created Date  :
        * Modified date :
        * Input Params  : Request $request
        * Return Value  : Display list of records
    */
    public function saveSort(Request $request) {
        $title      = trans('custom_admin.message_error');
        $message    = trans('custom_admin.error_something_went_wrong');
        $type       = 'error';

        try {
            if ($request->isMethod('POST')) {
                foreach ($request->order as $sort => $id) {
                    $this->model->where(['id' => $id])->update(['sort' => $sort]);
                }
                $title      = trans('custom_admin.message_success');
                $message    = trans('custom_admin.success_sorted_successfully');
                $type       = 'success';
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
                    $title  = trans('custom_admin.message_success');
                    $type   = 'success';
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
