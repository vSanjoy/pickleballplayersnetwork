<?php
/*
    * Class name    : Net
    * Purpose       : Table declaration
    * Author        : 
    * Created Date  : 
    * Modified date : 
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Net extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];    // The field name inside the array is not mass-assignable
    
}