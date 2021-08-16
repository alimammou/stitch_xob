<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class featuredStoreitems extends Model
{
    protected $guarded=[];
    use AsSource, Filterable, Attachable;
    use HasFactory;
    public function storeitems()
    {
        return $this->belongsTo(storeitem::class);
    }
}
