<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanent extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name'
    ];
}
