<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorRfq extends Model
{
    use HasFactory;
    protected $fillable = [
        'enquiry_id','vendor_id','rfq_id','enquiry_supplier_no'
    ];

   
}
