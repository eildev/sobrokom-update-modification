<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubcategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    function subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategoryId', 'id');
    }
}