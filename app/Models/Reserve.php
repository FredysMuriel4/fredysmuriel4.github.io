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
        'quantity'
    ];

    public function getLesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
