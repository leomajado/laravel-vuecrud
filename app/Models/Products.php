<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['name','description','stock','created_at','deleted_at','updated_at'];

    protected $dates = ['created_at','deleted_at','updated_at'];

    protected $hidden = ['deleted_at'];
}
