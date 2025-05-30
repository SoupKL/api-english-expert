<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStatus extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'a1', 'a2', 'b1', 'b2', 'c1', 'c2'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
