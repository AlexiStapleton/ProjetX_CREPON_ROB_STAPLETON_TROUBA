<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Compte extends Model
{

    protected $table = 'compte';
    protected $primaryKey = 'idcompte';
    public $timestamps = false;
}
