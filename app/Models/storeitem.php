<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class storeitem extends Model
{
    use AsSource, Filterable, Attachable;
    use HasFactory;
    public function setgenresAttribute($value)
    {
        $this->attributes['genres'] = json_encode($value);
    }
    public function scopeFfilters($querry, array $filters)
    {

        if(isset($filters['genre']))
        {
            $querry->where('genres','like','%'.request('genre').'%');
        }
        if(isset($filters['platform']))
        {
            $querry->where('platforms_id','like','%'.request('platform').'%');
        }
        if(isset($filters['search']))
        {
            $querry->where('title','like','%'.request('search').'%')
                ->orwhere('description','like','%'.request('search').'%');
        }
    }
   // public function getgenresAttribute($value)
   // {
   //      $this->attributes['genres'] = json_decode($value);

   // }

    protected $fillable = [
        'title',
        'created_at',
        'updated_at'
    ];
    protected $allowedSorts = [
        'title',
        'created_at',
        'updated_at',
        'developer',
        'publisher',
        'description',
    ];
    public function platform()
    {
        return $this->belongsTo(platform::class, 'platforms_id');
    }
}
