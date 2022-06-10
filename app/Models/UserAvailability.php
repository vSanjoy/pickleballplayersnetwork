<?php
/*
    * Class name    : UserAvailability
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAvailability extends Authenticatable
{
    use HasFactory, Notifiable;    

    public $timestamps = false;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable

    /*
        * Function name : availabilityDetails
        * Purpose       : To get preferred home court details
        * Author        :
        * Created Date  :
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
	public function availabilityDetails() {
		return $this->belongsTo('App\Models\Availability', 'availability_id');
	}
    
}
