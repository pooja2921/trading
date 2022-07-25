<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'client_code', 'salutation','first_name','middle_name','last_name','email','mobile','company_name','gst_number','address_1','address_2','city_id','state_id','pincode','latitude','longitude','status','secondary_city_id','secondary_state_id','secondary_pincode','secondary_latitude','secondary_longitude','landline','company_id','city_code','designation','department','website','mobilealt','emailalt','address','altaddress','country_id','secondary_country_id','birthday','anniversary','facebook_id','facebook_bussiness_page','linkedin_id','linkedin_bussiness_page','youtube','clientType'
    ];

    public function citydetail(){
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function statedetail(){
        return $this->belongsTo('App\Models\State','state_id');
    }

    public function countrydetail(){
        return $this->belongsTo('App\Models\Country','country_id');
    }
}
