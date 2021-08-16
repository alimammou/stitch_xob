<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class storepurchase extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function storeitem()
    {
        return $this->belongsTo(storeitem::class);
    }
    public function storecode()
    {
        return $this->belongsTo(storecode::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
