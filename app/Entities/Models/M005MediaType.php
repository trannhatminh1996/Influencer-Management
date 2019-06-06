<?php 
namespace App\Entities\Models;

use Illuminate\Database\Eloquent\Model;

class M001Influencer extends BaseModel
{
    public 	$table = 'm005media_type';
    public 	$primaryKey = 'f005id';
    public 	$prefixField = 'f005';
    public	$timestamps = false;

}