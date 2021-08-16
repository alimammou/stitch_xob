<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates = ['DOB'];
    public function setgenresAttribute($value)
    {
        $this->attributes['genres'] = json_encode($value);
    }
    public function platform()
    {
        return $this->belongsTo(platform::class, 'platform');
    }
    public function secondaryplatform()
    {
        return $this->belongsTo(platform::class, 'secondary_platform');
    }
}
