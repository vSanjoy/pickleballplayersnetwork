<?php
/*
    * Class name    : Cms
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cms extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

    /*
        * Function name : parentPage
        * Purpose       : To get parent page details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  :
        * Return Value  :
    */
	public function parentPage() {
		return $this->belongsTo('App\Models\Cms', 'parent_id');
	}

    /*
        * Function name : parentCity
        * Purpose       : To get parent page details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  :
        * Return Value  :
    */
	public function parentCity() {
		return $this->belongsTo('App\Models\City', 'parent_id');
	}

}
