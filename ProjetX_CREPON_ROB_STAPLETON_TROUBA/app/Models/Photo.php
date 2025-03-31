<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Photo extends Model
{
    protected $table = 'photo';
    protected $primaryKey = 'idphoto';
    protected $timestamp = false;

    protected $fillable = ['urlphoto'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            Post::class,
            'a_pour_photo',
            'idphoto',
            'idpost'
        );
    }
}
