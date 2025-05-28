<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PodiumPresentation extends Model
{
    //
    // protected $primaryKey = 'code';
    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = ['code', 'date', 'time_start', 'time_end', 'room'];

    public function poster()
    {
        return $this->belongsTo(Poster::class, 'code', 'code');
    }

}
