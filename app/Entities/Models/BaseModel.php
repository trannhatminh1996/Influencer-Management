<?php 
namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model 
{
    public 	$table = '';
    public 	$primaryKey = '';
    public 	$prefixField = '';
    public	$timestamps = false;
}