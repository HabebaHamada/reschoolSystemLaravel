<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'date_of_birth',
        'school_class_id',
        'photo'
    ];

    public function schoolClass()
    {
        return $this->belongsTo(schoolClass::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(related: subject::class);
    }
}
