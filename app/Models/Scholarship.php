<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    /** @use HasFactory<\Database\Factories\ScholarshipFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'provider',
        'deadline',
        'status',
    ];
}
