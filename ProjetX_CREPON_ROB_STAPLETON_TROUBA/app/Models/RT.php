<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    protected $table = 'rt';
    protected $primaryKey = 'idrt';
    public $timestamps = false;

    public function compte(){
        return $this->belongsTo(Compte::class, 'idrtcompte');
    }
    public function post(){
        return $this->belongsTo(Post::class, 'idrtpost');
    }
}
