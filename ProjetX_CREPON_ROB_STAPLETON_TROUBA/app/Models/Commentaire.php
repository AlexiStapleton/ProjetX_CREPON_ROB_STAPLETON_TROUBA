<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $table = 'commentaire';
    protected $primaryKey = 'idcommentaire';
    public $timestamps = false;
    protected $fillable = ['idpostcommentaire', 'idpostoriginalcommentaire'];
}
