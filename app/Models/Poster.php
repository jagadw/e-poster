<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['code', 'name', 'title', 'email', 'type', 'affiliate', 'file'];

    public function podiumPresentations()
    {
        return $this->hasMany(PodiumPresentation::class, 'code', 'code');
    }

}
