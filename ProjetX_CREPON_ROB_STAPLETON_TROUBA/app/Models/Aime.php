<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aime extends Model
{
    use HasFactory;

    protected $table = 'aime';
    protected $primaryKey = 'idaime';
    public $timestamps = false;

    protected $fillable = [
        'idaimecompte',
        'idaimepost'
    ];


}
