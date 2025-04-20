<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_category_id',
        'entry_date',
        'amount',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(IncomeCategory::class, 'income_category_id');
    }
}
