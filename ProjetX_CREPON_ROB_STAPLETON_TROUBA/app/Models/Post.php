<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Post extends Model
{


    protected $table = 'post';
    protected $primaryKey = 'idpost';
    public $timestamps = false;

    public function compte()
    {
        return $this->belongsTo(Compte::class, 'idcompte');
    }
    public function photos(): BelongsToMany
    {
        return $this->belongsToMany(
            Photo::class,
            'a_pour_photo',
            'idpost',
            'idphoto'
        );
    }
    public function likes(){
        return $this->hasMany(Aime::class, 'idaimepost', 'idpost');
    }
    public function rt(){
        return $this->hasMany(RT::class, 'idrtpost', 'idpost');
    }


}
