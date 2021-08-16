<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Filters\HttpFilter;
use Orchid\Screen\AsSource;


class tests extends Model
{
    use HasFactory;
    protected $guarded=[];
    use AsSource, Filterable, Attachable;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function setgenresAttribute($value)
    {
        $this->attributes['genres'] = json_encode($value);
    }
    use SoftDeletes;
    protected $fillable = [
        'title' ,
        'user_id' ,
        'description' ,
        'platform',
        'genres',
        'trailer',
        'page_status',
        'tester_registration',
        'version',
        'test_status',
        'rewardpool',
        'remaining_points',
        'platforms_id',
        'pathtothumbnail',
        'pathtosc1',
        'pathtosc2',
        'pathtosc3',
        'pathtosc4',
        'pathtosc5',
        'created_at',
        'updated_at'
];
    public function scopeFfilters($querry, array $filters)
    {
        if(isset($filters['order'])){
            if(request(['order'])==3)
            {
                $querry->withCount('testapps')->orderBy('testapps_count');
            }
        }
        else{
            $querry->latest();
        }
        if(isset($filters['genre']))
        {
            $querry->where('genres','like','%'.request('genre').'%');
        }
        if(isset($filters['reward']))
        {
            if($filters['reward']==1){
            $querry->where('rewardpool', '>', '0');
        }
            elseif ($filters['reward']==2)
            {
                $querry->where('rewardpool', '0');
            }
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

    protected $allowedSorts = [
        'title',
        'created_at',
        'updated_at'
    ];
    public function testapps()
    {
        return $this->hasMany(testapps::class);
    }
    public function gamecodes()
    {
        return $this->hasMany(gamecodes::class);
    }
    public function platform()
    {
        return $this->belongsTo(platform::class, 'platforms_id');
    }
    public function nda()
    {
        return $this->hasOne(nda::class );
    }
    public function knownbugs()
    {
        return $this->hasOne(knownbugs::class );
    }
    public function forms()
    {
        return $this->hasMany(Form::class );
    }

}
