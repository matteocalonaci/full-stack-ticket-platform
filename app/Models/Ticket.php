<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'state',
        'date',
        'description',
        'operator_id',
        'category_id',
    ];
    use HasFactory;

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function operators()
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }
}
