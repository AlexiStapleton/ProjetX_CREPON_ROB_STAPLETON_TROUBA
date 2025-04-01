<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vpost extends Model
{
    protected $table = 'vpost';

    public $timestamps = false;

    public function likes(){
        return $this->hasMany(Aime::class, 'idaimepost', 'idpost');
    }
    public function userLiked()
    {
        return $this->likes()->where('idaimecompte', auth()->id())->exists();
    }
    public function aimes()
    {
        return $this->hasMany(Aime::class, 'idaimepost', 'idpost');
    }
}
