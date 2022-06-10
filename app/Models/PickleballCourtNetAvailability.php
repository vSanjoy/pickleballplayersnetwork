<?php
/*
    * Class name    : PickleballCourtNetAvailability
    * Purpose       : Table declaration
    * Author        :
    * Created Date  :
    * Modified date :
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PickleballCourtNetAvailability extends Authenticatable
{
    use HasFactory, Notifiable;    

    public $timestamps = false;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable    
}
