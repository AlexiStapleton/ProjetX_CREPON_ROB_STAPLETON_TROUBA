@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/explore.css') }}">
@endsection

@section('content')
<div id="main_content">
    <div id="contain_input">
        <form id="input_recherche" method="GET" action="{{ route('explore', ['id' => $compte->idcompte]) }}">
            <div id="div_logo_search">
                <svg viewBox="0 0 24 24" aria-hidden="true" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1tjplnt r-1bwzh9t r-10ptun7 r-2dysd3 r-1janqcz"><g><path d="M10.25 3.75c-3.59 0-6.5 2.91-6.5 6.5s2.91 6.5 6.5 6.5c1.795 0 3.419-.726 4.596-1.904 1.178-1.177 1.904-2.801 1.904-4.596 0-3.59-2.91-6.5-6.5-6.5zm-8.5 6.5c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5c0 1.986-.682 3.815-1.824 5.262l4.781 4.781-1.414 1.414-4.781-4.781c-1.447 1.142-3.276 1.824-5.262 1.824-4.694 0-8.5-3.806-8.5-8.5z"></path></g></svg>
                <input type="text" name="query" placeholder="Rechercher un post" value="{{ request('query') }}">
            </div>
            <button id="button_search" type="submit">Search</button>
        </form>
    </div>
        
    <div class="feed">
        @include('partials.post_partials', ['feed' => $feed])
    </div>
</div>
@endsection

@section("right_side")
    @foreach($whotofollow as $follow)
        <div class="div_follow">
            <div class="left_follow">
                <img class="img_follow" src="https://pbs.twimg.com/profile_images/1695959673646551040/OJ9rAupv_x96.jpg" alt="">
                <div class="div_nom_follow">
                    <p class="p_info p_nom_post">{{ $follow->pseudocompte}}</p>
                    <p class="p_info p_pseudo">@ {{ $follow->logincompte}}</p>
                </div>
            </div>
            <button class="but_follow">Follow</button>
        </div>
    @endforeach
@endsection