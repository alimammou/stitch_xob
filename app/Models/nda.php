<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nda extends Model
{
    use HasFactory;
    protected $fillable = [
        'tests_id',
        'nda',
        'required',
        'timelimit'
    ];
}
