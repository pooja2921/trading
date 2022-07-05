<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;
    protected $fillable = [
         'client_id', 'UnqRngCode', 'client_quotation_number','email_received_from','email_received_date','sales_procurement_specialist	','enquiry_no','user_id','client_code','contact_person','company_name','city','corporate_name','address','cityName','created_by_id','enquiry_status'
    ];
}
