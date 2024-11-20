<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'other_columns'];
    protected $table = 'categories';


    use HasFactory;

    public function tickets(){
        return $this->hasMany(Ticket::class, 'category_id');
    }

    public function operator_category()
    {
        return $this->belongsToMany(Operator::class, 'operator_category');
    }

}
