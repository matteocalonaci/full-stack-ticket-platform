<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{

    protected $fillable = [
        'email',
        'password',
        'state',
        'name',
        'surname',
        'specialization',
        'other_columns'
    ];
    protected $table = 'operators';

    use HasFactory;

    public function tickets(){
        return $this->hasMany(Ticket::class, 'operator_id');
    }

    public function operator_category()
    {
        return $this->belongsToMany(Category::class, 'operator_category');
    }
}


