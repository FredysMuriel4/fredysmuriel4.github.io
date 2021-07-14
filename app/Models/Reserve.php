<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;
    protected $table = 'reserves';
    protected $fillable = [
        'user_id',
        'lesson_id',
        'reserve_date',
        'quantity',
        'end_reserve_hour'
    ];

    public function getLesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
