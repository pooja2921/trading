<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;
    protected $fillable = [
         'client_id', 'UnqRngCode', 'client_quotation_number','email_received_from','email_received_date','sales_procurement_specialist	','enquiry_no','user_id','client_code','contact_person','company_name','city','corporate_name','address','cityName','created_by_id','enquiry_status','client_country_id','client_state_id','client_city_id','client_address_line1','client_address_line2','corporate_id','corporate_company_name','corporate_country_id','corporate_state_id','corporate_city_id','corporate_address_line1','corporate_address_line2','client_name','corp_contact_person','created_by_id','email','mobile','landline','corporate_email','corporate_mobile','corporate_landline','city_code','corp_city_code','corporate_code','pincode','corporate_pincode','user_code'
    ];

    public function enquirydetail(){
        return $this->hasmany('App\Models\EnquiryItem','enquiry_id')->with('products');
    }

    
    public function citydetail(){
        return $this->belongsTo('App\Models\City','client_city_id');
    }
}
