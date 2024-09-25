<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'reward_points',
        'image',
    ];
    public function solutions()
{
    return $this->hasMany(Solution::class);
}
}
