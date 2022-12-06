<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'brand_name', 'brand_slug', 'brand_desc','brand_status','brand_image'
    ];
    protected $primaryKey = 'brand_id';
 	protected $table = 'tbl_brand';
}
