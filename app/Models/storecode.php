<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Filters\HttpFilter;
use Orchid\Screen\AsSource;

class storecode extends Model
{
    use HasFactory;

    use AsSource, Filterable, Attachable;
    public function storeitem()
    {
        return $this->belongsTo(storeitem::class);
    }
    public function storepurchase()
    {
        return $this->hasOne(storepurchase::class);
    }
    protected $allowedFilters = [
        'storeitem_id'
];
    public function scopeFfilters($querry, array $filters)
    {
        if(isset($filters['storeitem_id']))
        {
$c = storeitem::where('title', $filters['storeitem_id'])->first();

 return $querry->where('storeitem_id', $c->id);
        }
}
}
