<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ItemDetail extends Model
{
    use HasFactory;

    protected $fillable = ["item_id","quantity","price","sku","image","sale_price","variant"];
    
}
