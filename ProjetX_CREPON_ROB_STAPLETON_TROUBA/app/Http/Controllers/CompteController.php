<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Post;
use App\Models\RT;
use App\Models\Citation;
use Carbon\Carbon;

class CompteController extends Controller
{
    private function getFeedOfUser($idUser)
    {
        // Récupère les posts
        $posts = Post::where('idcompte', $idUser)
            ->get()
            ->map(function ($post) {
                return $post; // Objet intact
            });

        // Récupère les RTs
        $rts = RT::where('idrtcompte', $idUser)
            ->get()
            ->map(function ($rt) {
                return $rt; // Objet intact
            });

        // Récupère les citations
        $citations = Citation::whereHas('postCitation', function ($query) use ($idUser) {
            $query->where('idcompte', $idUser);
        })->get()
            ->map(function ($citation) {
                return $citation; // Objet intact
            });

        // Fusionner toutes les données en une seule collection et trier par la date
        $feedUser = collect()
            ->merge($posts)
            ->merge($rts)
            ->merge($citations)
            ->sortByDesc(function ($item) {
                // Le tri se fait par la date de chaque type d'objet
                if (isset($item->datepost)) {
                    return Carbon::createFromFormat('d/m/Y', trim($item->datepost));
                } elseif (isset($item->datert)) {
                    return Carbon::createFromFormat('d-m-Y', $item->datert);
                }
                return Carbon::now(); // Pour éviter les erreurs si aucune date n'est présente
            })
            ->values(); // Réindexe la collection après le tri

        // Retourner les objets triés sous forme de tableau PHP
        return $feedUser;
    }

    public function compte($id)
    {
        $compte = Compte::where('idcompte', $id)->first();

        // Récupère le feed d'utilisateur sous forme de tableau d'objets
        $feed = $this->getFeedOfUser($id);

        // Affiche le tableau d'objets dans dd()
        dd($feed);
    }
}
