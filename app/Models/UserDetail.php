<?php
/*
    * Class name    : UserDetail
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserDetail extends Authenticatable
{
    use HasFactory, Notifiable;    

    public $timestamps = false;

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
		return $this->belongsTo('App\Models\State', 'state');
	}

    /*
        * Function name : pickleballCourtDetails
        * Purpose       : To get preferred pickleball court details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function pickleballCourtDetails() {
		return $this->belongsTo('App\Models\PickleballCourt', 'home_court');
	}
    
}
