<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Post;
use App\Models\RT;
use App\Models\Citation;

class CompteController extends Controller
{
    private function getFeedOfUser($idUser){

            $posts = Post::where('idcompte', $idUser)
                ->get();
            $rts = RT::where('idrtcompte', $idUser)
                ->get();
            $citations = Citation::whereHas('postCitation', function($query) use ($idUser) {
                $query->where('idcompte', $idUser);
            })->get();
            $feedUser = (object)array_merge_recursive( (array)$posts, (array)$rts, (array)$citations);
            return $feedUser;
        }
    private feedSorter($feed){
        return 0;
    }
    public function compte($id){
        $compte = Compte::where('idcompte', $id)->first();



        $feed = $this->getFeedOfUser($id);

        dd($feed);
        return view('compte')->with("compte", $compte);
    }


}
