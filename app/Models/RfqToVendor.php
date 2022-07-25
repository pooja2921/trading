<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfqToVendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'enquiry_id','product_id','rfq_number','created_by_id','vendor_id', 'status', 'enquiry_item_id'
    ];

   
}
