<?php
/*
    * Class name    : PickleballCourt
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PickleballCourt extends Model
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
        * Function name : pickleballCourtNetAvailabilityDetails
        * Purpose       : To get pickleball court net availability details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function pickleballCourtNetAvailabilityDetails() {
		return $this->hasMany('App\Models\PickleballCourtNetAvailability', 'pickleball_court_id');
	}

    /*
        * Function name : enteredByDetails
        * Purpose       : To get state details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function enteredByDetails() {
		return $this->belongsTo('App\Models\User', 'entered_by_user_id');
	}

}
