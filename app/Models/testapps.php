<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testapps extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $dates = ['invited_on'];
    public function user()
    {
        return $this->belongsTo(tests::class);
    }
    public function tests()
    {
        return $this->belongsTo(tests::class,'tests_id');
    }
    public function platform() {
        $middle = $this->belongsTo(tests::class,'tests_id');
        return $middle->getResults()->belongsTo(platform::class, 'platforms_id');
    }
    public function gamecodes()
    {
        return $this->hasOne(gamecodes::class,'testapp_id');
    }
    public function bugs()
    {
        return $this->hasOne(bugreport::class,'testapp_id');
    }
    public function submissions()
    {
        return $this->hasOne(Submission::class,'testapp_id');
    }
}
