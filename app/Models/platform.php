<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class platform extends Model
{
    use HasFactory;

    use AsSource, Filterable, Attachable;
    protected $allowedSorts = [
        'name',
        'class',
        'created_at',
        'updated_at'
    ];
}
