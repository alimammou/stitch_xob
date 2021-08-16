<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class aidrequest extends Model
{
    use HasFactory;
    protected $guarded=[];
    use AsSource, Filterable, Attachable;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
