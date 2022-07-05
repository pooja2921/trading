<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_code','category_id','subcategory_id','bussiness_nature','company_name', 'salutation', 'first_name','middle_name','last_name','designation','mobile','mobilealt','email','emailalt','secondary_salutation','secondary_first_name','secondary_middlename','secondary_lastname','secondary_designation','secondary_mobile','secondary_email','landline','address_1','address_2','city','state_id','pincode','user_id','country_id','city_id','state_id','city_code','company_id','second_city_code','second_landline','clientType','department','secondary_department','gst_number','secondary_emailalt','second_mobilealt','birthday','anniversary','secondary_birthday','secondary_anniversary','latitude','longitude'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function subcategory(){
        return $this->belongsTo('App\Models\Category','subcategory_id','id');
    }
    
    public function vendorcategory()
    {
        return $this->hasMany('App\Models\VendorCategory', 'vendor_id','id');
    }
}
