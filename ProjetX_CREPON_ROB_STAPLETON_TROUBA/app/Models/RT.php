<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    protected $table = 'rt';
    protected $primaryKey = 'idrt';
    public $timestamps = false;

    protected $fillable = [
        'datert',
        'idrtcompte',
        'idrtpost'
    ];

    public function compte(){
        return $this->belongsTo(Compte::class, 'idrtcompte');
    }
    public function post(){
        return $this->belongsTo(Post::class, 'idrtpost');
    }
    public function rt(){
        return $this->belongsTo(RT::class, 'idrt');
    }
    public function checkRetweet($idcompte, $idpost)
    {
        $rt = Rt::where('idrtcompte', $idcompte)
            ->where('idrtpost', $idpost)
            ->first();

        if($rt) {
            // Le retweet existe
            return $rt; // Retourne l'objet RT complet
        } else {
            // Aucun retweet trouvé
            return null;
        }
    }
}
