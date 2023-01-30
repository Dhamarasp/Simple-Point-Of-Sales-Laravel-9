<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    protected $table = 'categories';
    protected $guarded = ['id'];

    public function item(){

        return $this->hasMany(item::class);

    }
}
