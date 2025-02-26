<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cats;

class per extends Model
{
    use HasFactory;

    public function category()
    {
    	return $this->belongsTo(Cats::class,'cats_id');
    }
}
