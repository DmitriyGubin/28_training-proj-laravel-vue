<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\per;

class Cats extends Model
{
    use HasFactory;

    protected $with = ['posts'];///для быстрой связи таблиц

    public function posts()
    {
    	return $this->hasMany(per::class);
    }
}
