<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\In;

class Dish extends Model
{
    protected $fillable = ['name', 'cost', 'image', 'category_id', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('value');
    }

    public function welcome()
    {
        return $this->belongsTo(Welcome::class);
    }


}
