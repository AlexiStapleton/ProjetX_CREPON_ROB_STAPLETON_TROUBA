<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    protected $table = 'citation';
        protected $primaryKey = 'idcitation';
        public $timestamps = false;

    public function postCitation()
    {
        return $this->belongsTo(Post::class, 'idpostcitation', 'idpost');
    }

    // Relation avec le post original (IDPOSTCITATIONORIGINAL)
    public function postOriginal()
    {
        return $this->belongsTo(Post::class, 'idpostcitationoriginal', 'idpost');
    }
    public function post(){
        return $this->belongsTo(Post::class, 'idpostcitation');
    }

}
