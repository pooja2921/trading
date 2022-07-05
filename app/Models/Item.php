<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Item extends Model
{
    use HasFactory;

    protected $fillable = ["name","category_id","description","user_id","subcategory_id", "childcategory_id","image","available","price","variant_option"];

    public function itemdetail(){
        return $this->belongsTo('App\Models\ItemDetail','id','item_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function subcategory(){
        return $this->belongsTo('App\Models\Category','subcategory_id','id');
    }

    public function childcategory(){
        return $this->belongsTo('App\Models\Category','childcategory_id','id');
    }

    public function imagedetail(){
        return $this->hasmany('App\Models\ItemImage','item_id','id');
    }

    public function itemdetailvariant(){
        return $this->hasMany('App\Models\ItemDetail','item_id');
    }
    
}
