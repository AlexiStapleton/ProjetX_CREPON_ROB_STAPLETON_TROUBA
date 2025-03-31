<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Post;
use App\Models\RT;
use App\Models\Citation;
use App\Models\Photo;
use App\Models\Aime;
use Carbon\Carbon;
use App\Models\Follow;

class CompteController extends Controller
{

    public function getFeedOfUser($id){
        $posts = Post::where('idcompte', $id)
            ->with(['compte.photo','photos', 'likes', 'rt', 'commentaires'])
            ->get()
            ->map(function ($post) {
                return $post;
            });

        $rts = RT::where('idrtcompte', $id)
            ->with(['compte', 'post.photos', 'post.likes', 'post.rt', 'post.commentaires'])
            ->get()
            ->map(function ($rt) {
                return $rt;
            });
        $citations = Citation::whereHas('postCitation', function ($query) use ($id) {
            $query->where('idcompte', $id);
        })
            ->with(['post.compte.photo', 'post.photos', 'post.likes', 'post.rt', 'post.commentaires'])
            ->with(['postOriginal.compte.photo', 'postOriginal.photos', 'postOriginal.likes','postOriginal.commentaires'])
            ->get()
            ->map(function ($citation) {
                return $citation;
            });

        $feed = collect()
            ->merge($posts)
            ->merge($rts)
            ->merge($citations);

        $sortedFeed = $this->sortFeed($feed);

        return $sortedFeed;
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

                if (isset($item->datepost)) {
                    return Carbon::createFromFormat('d/m/Y', trim($item->datepost));
                } elseif (isset($item->datert)) {
                    return Carbon::createFromFormat('d-m-Y', $item->datert);
                }
                return Carbon::now();
            })
            ->values();
        return $sortedFeed;
    }

    public function compte($id)
    {
        $likes = $this->getLikesOfUser($id);
        $compte = Compte::where('idcompte', $id)->with('photo')->first();
        $photoProfil = Photo::where('idphoto', $compte->idppcompte)->first();

        $feed = $this->getFeedOfUser($id);


        return view('compte')->with('compte', $compte)->with('feed', $feed)->with('likes', $likes)->with('photoProfil', $photoProfil);
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



        return view('feed')->with('compte', $compteUser)->with('feed', $sortedfeed);
    }
}
