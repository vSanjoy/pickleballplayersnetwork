<?php
/*
    * Class name    : League
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class League extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

    /*
        * Function name : stateDetails
        * Purpose       : To get state details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function stateDetails() {
		return $this->belongsTo('App\Models\State', 'state_id');
	}

    /*
        * Function name : ratingDetails
        * Purpose       : To get rating details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function ratingDetails() {
		return $this->belongsTo('App\Models\Rating', 'rating_id');
	}

}
