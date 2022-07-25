<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryItem extends Model
{
    use HasFactory;
    protected $fillable = [
         'enquiry_id', 'customer_product_description', 'customer_UOM','quantity','product_name','product_id','product_group_id','product_category_id','product_subcategory_id','product_specification','UOM','image_link','image','created_by_id','status','name','product_code'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'id','product_id')->with('productcategory');
    }
    public function productcategory()
    {
        return $this->hasMany('App\Models\ProductCategory', 'id','product_id')->with('parentgroup','parentcategory','subcategory');
    }
}
