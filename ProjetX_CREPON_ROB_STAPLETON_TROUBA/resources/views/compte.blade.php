@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/compte.css') }}">
@endsection

@section('content')
<div id="main_content">
    <div id="head_compte">
        <svg id="svg_back_compte" viewBox="0 0 24 24" aria-hidden="true" style="color: rgb(239, 243, 244);"><g><path d="M7.414 13l5.043 5.04-1.414 1.42L3.586 12l7.457-7.46 1.414 1.42L7.414 11H21v2H7.414z"></path></g></svg>
        <div>
            <p class="p_head_compte p_name_head">{{$compte->pseudocompte}}</p>
            <p class="p_head_compte" id="p_post_head">{{ $compte->posts->count() }} posts</p>
        </div>
    </div>
    <div id="banniere_container">
        <img id="img_banniere" src="https://pbs.twimg.com/profile_banners/795728933429841920/1700485447/1500x500" alt="">
        <div id="div_pp">
            <img id="pp" src="https://pbs.twimg.com/profile_images/1695959673646551040/OJ9rAupv_x96.jpg" alt="">
        </div>
    </div>
    <div id="button_compte">
        <div class="but_compte">
            <svg class="svg_but_compte" viewBox="0 0 24 24" aria-hidden="true" style="color: rgb(239, 243, 244);"><g><path d="M3 12c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm9 2c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm7 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"></path></g></svg>
        </div>
        <div class="but_compte">
            <svg class="svg_but_compte" viewBox="0 0 33 32" aria-hidden="true" style="color: rgb(239, 243, 244);"><g><path d="M12.745 20.54l10.97-8.19c.539-.4 1.307-.244 1.564.38 1.349 3.288.746 7.241-1.938 9.955-2.683 2.714-6.417 3.31-9.83 1.954l-3.728 1.745c5.347 3.697 11.84 2.782 15.898-1.324 3.219-3.255 4.216-7.692 3.284-11.693l.008.009c-1.351-5.878.332-8.227 3.782-13.031L33 0l-4.54 4.59v-.014L12.743 20.544m-2.263 1.987c-3.837-3.707-3.175-9.446.1-12.755 2.42-2.449 6.388-3.448 9.852-1.979l3.72-1.737c-.67-.49-1.53-1.017-2.515-1.387-4.455-1.854-9.789-.931-13.41 2.728-3.483 3.523-4.579 8.94-2.697 13.561 1.405 3.454-.899 5.898-3.22 8.364C1.49 30.2.666 31.074 0 32l10.478-9.466"></path></g></svg>
        </div>
        <div class="but_compte">
            <svg class="svg_but_compte" viewBox="0 0 24 24" aria-hidden="true" style="color: rgb(239, 243, 244);"><g><path d="M10.25 3.75c-3.59 0-6.5 2.91-6.5 6.5s2.91 6.5 6.5 6.5c1.795 0 3.419-.726 4.596-1.904 1.178-1.177 1.904-2.801 1.904-4.596 0-3.59-2.91-6.5-6.5-6.5zm-8.5 6.5c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5c0 1.986-.682 3.815-1.824 5.262l4.781 4.781-1.414 1.414-4.781-4.781c-1.447 1.142-3.276 1.824-5.262 1.824-4.694 0-8.5-3.806-8.5-8.5z"></path></g></svg>
        </div>
        <div class="but_compte">
            <svg class="svg_but_compte" viewBox="0 0 24 24" aria-hidden="true" style="color: rgb(239, 243, 244);"><g><path d="M1.998 5.5c0-1.381 1.119-2.5 2.5-2.5h15c1.381 0 2.5 1.119 2.5 2.5v13c0 1.381-1.119 2.5-2.5 2.5h-15c-1.381 0-2.5-1.119-2.5-2.5v-13zm2.5-.5c-.276 0-.5.224-.5.5v2.764l8 3.638 8-3.636V5.5c0-.276-.224-.5-.5-.5h-15zm15.5 5.463l-8 3.636-8-3.638V18.5c0 .276.224.5.5.5h15c.276 0 .5-.224.5-.5v-8.037z"></path></g></svg>
        </div>
        @if(Auth::user()->idcompte != $compte->idcompte)
            @if(true)

            @endif
        @else
            <button class="but_follow">Edit my profile</button>
        @endif
    </div>

    <div id="margin">
        <div id="info_name">
            <p class="p_head_compte p_name_head">{{$compte->pseudocompte}}</p>
            <p class="p_head_compte p_pseudo">{{'@'.$compte->logincompte}}</p>
        </div>
        <div id="bio">
            <p>{{$compte->descriptioncompte}}</p>
        </div>
        <div id="info_follow">
            <p class="p_info_follow"><span class="nb_follow">{{ $compte->followers->count() }}</span> Following</p>
            <p class="p_info_follow"><span class="nb_follow">{{ $compte->followedaccounts->count() }}</span> Followers</p>
        </div>
    </div>

    <div id="cat_compte">
        <div class="div_select_scroll">
            <p>Posts</p>
            <div id="div_visu_select"></div>
        </div>
        <div class="div_select_scroll" id="unselect">
            <p>Replies</p>
            <div id=""></div>
        </div>
        <div class="div_select_scroll" id="unselect">
            <p>Highlights</p>
            <div id=""></div>
        </div>
        <div class="div_select_scroll" id="unselect">
            <p>Media</p>
            <div id=""></div>
        </div>
    </div>
    @include('partials.post_partials', ['feed' => $feed])
</div>
@endsection

@section("right_side")
    <div class="whotofollow">
        <h1>Who to follow</h1>
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
    </div>
@endsection
