<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Post;
use App\Models\RT;
use App\Models\Citation;
use App\Models\Photo;
use App\Models\Aime;
use App\Models\Commentaire;
use App\Models\Vpost;
use App\Models\Vcitation;
use App\Models\Vrt;
use Carbon\Carbon;
use App\Models\Follow;

class CompteController extends Controller
{

    public function getFeedOfUser($id){

        $posts = Vpost::where('idcompte', $id)
            ->whereNotIn('idpost', Commentaire::pluck('idpostcommentaire')->toArray())
            ->whereNotIn('idpost', Citation::pluck('idpostcitation')->toArray())
            ->get();

        $citations = Vcitation::where('idcompteposter', $id)->get();
        $rts = Vrt::where('idrtcompte', $id)->get();

        $feed = collect()
            ->merge($posts)
            ->merge($citations)
            ->merge($rts);

        $sortedFeed = $this->sortFeed($feed);


        return $sortedFeed;
    }
    public function whoToFollow($id){
        $followedAccound = Follow::where('idcomptequifollow', $id)->pluck('idcomptefollow');
        $followedAccound = $followedAccound->push(intval($id));

        $accountToFollow = Compte::whereNotIn('idcompte', $followedAccound)->get();


        return $accountToFollow;
    }

    public function getLikesOfUser($id){
        $lesLikes = Aime::where('idaimecompte', $id)->get();
        $likedPosts = collect();
        foreach ($lesLikes as $like) {
            $post = Post::where('idpost', $like->idaimepost)->get();
            $likedPosts->push($post);
        }
        return $likedPosts;
    }
    public function sortFeed($feed){
        $sortedFeed = $feed->sortByDesc(function ($item) {
            if (isset($item->datert)) {
                return Carbon::createFromFormat('d-m-Y', trim($item->datert));
            }

            if (isset($item->datepost)) {
                return Carbon::createFromFormat('d/m/Y', trim($item->datepost));
            }

            return Carbon::now();
        })
            ->values();

        return $sortedFeed;
    }




    public function compte($id)
    {
        $likes = $this->getLikesOfUser($id);
        $compte = Compte::where('idcompte', $id)->with(['photo', 'followers','followedaccounts'])->first();


        $photoProfil = Photo::where('idphoto', $compte->idppcompte)->first();

        $feed = $this->getFeedOfUser($id);

        $whoToFollow = $this->whoToFollow($id);

        $whoToFollow = $this->whoToFollow($id);

        view()->share('whoToFollow', $whoToFollow);

        return view('compte')->with('compte', $compte)->with('feed', $feed)->with('likes', $likes)->with('photoProfil', $photoProfil)->with('whotofollow', $whoToFollow);
    }
    public function feed($id){
        $compteUser = Compte::where('idcompte', $id)->with('photo')->first();


        $idfollowedAccounts = Follow::where('idcomptequifollow', $compteUser->idcompte)->get();
        $followedAccounts = collect();
        foreach ($idfollowedAccounts as $followedAccount) {
            $compte = Compte::where('idcompte', $followedAccount->idcomptefollow)->first();
            $followedAccounts->push($compte);
        }

        $feed = collect();
        foreach ($followedAccounts as $followedAccount) {
            $feedOfUser = $this->getFeedOfUser($followedAccount->idcompte);

            $feed = $feed->merge($feedOfUser);
        }
        $sortedfeed = $this->sortFeed($feed);

        $whoToFollow = $this->whoToFollow($id);

        return view('feed')->with('compte', $compteUser)->with('feed', $sortedfeed)->with('whotofollow', $whoToFollow);
    }
}
