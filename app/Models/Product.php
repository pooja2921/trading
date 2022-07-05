<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'company_id', 'product_code', 'name','brand','image','reference_link','video_link','image_link','warranty','lifecycle','country_id','product_nature','category_id','sub_category_id','model_details','size','product_image_link','packing_volume','measurement_id','childcategory_id','description','volume_unit','size_unit','warranty_month','lifecycle_month','warranty_days','warranty_week','warranty_year','lifecycle_days','lifecycle_week','lifecycle_year'
    ];
    
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function productcategory()
    {
        return $this->hasMany('App\Models\ProductCategory', 'product_id','id');
    }
}
