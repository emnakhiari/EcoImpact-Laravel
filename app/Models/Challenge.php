<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

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
public function isClosed() {
    return now()->isAfter($this->end_date);
}

public function winningSolution() {
    return $this->solutions()->withCount('votes')
        ->orderBy('votes_count', 'desc')
        ->first();
}

}
