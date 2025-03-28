<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Compte extends Model
{
    use HasFactory;

    protected $table = 'compte';
    protected $primaryKey = 'idcompte';
    public $timestamps = false;
}
