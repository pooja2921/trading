<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','product_group_id','product_category_id','sub_category_id'
    ];
    
    public function parentgroup(){
        return $this->belongsTo('App\Models\Category','product_group_id');
    }

    public function parentcategory(){
        return $this->belongsTo('App\Models\Category','product_category_id');
    }

    public function subcategory(){
        return $this->belongsTo('App\Models\Category','sub_category_id');
    }
}
