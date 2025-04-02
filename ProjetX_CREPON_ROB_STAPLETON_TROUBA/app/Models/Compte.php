<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compte extends Authenticatable
{

    protected $table = 'compte';
    protected $primaryKey = 'idcompte';
    public $timestamps = false;

    protected $fillable = [
        'logincompte',
        'pseudocompte',
        'mdpcompte',
        'descriptioncompte',
        'idbanierecompte',
        'idppcompte'
    ];
    public function photo(){
        return $this->belongsTo(Photo::class, 'idppcompte');
    }
    public function likedPosts()
    {
        return $this->hasManyThrough(Post::class, Aime::class, 'idcompte', 'idpost', 'idcompte', 'idpost');
    }
    public function followers(){
        return $this->hasMany(Follow::class, 'idcomptefollow', 'idcompte');
    }
    public function followedaccounts(){
        return $this->hasMany(Follow::class, 'idcomptequifollow', 'idcompte');
    }

    public function posts(){
        return $this->hasMany(Post::class, 'idcompte', 'idcompte');
    }

    public function getRt(){
        return $this->hasMany(Rt::class, 'idrtcompte', 'idcompte');
    }
}
