@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
@endsection

@section('content')
<div id="main_content">
    <div id="head_compte">
        <svg id="svg_back_compte" viewBox="0 0 24 24" aria-hidden="true" style="color: rgb(239, 243, 244);"><g><path d="M7.414 13l5.043 5.04-1.414 1.42L3.586 12l7.457-7.46 1.414 1.42L7.414 11H21v2H7.414z"></path></g></svg>
        <div>
            <p class="p_head_compte p_name_head">Post</p>
        </div>
    </div>

    @include('partials.post_partials', ['feed' => $post])

    <div id="user_reply">
        <div class="image_pp_reply">
            <img class="img_profile img_post" src="https://pbs.twimg.com/profile_images/1695959673646551040/OJ9rAupv_x96.jpg" alt="">
        </div>
        <form id="form_reply"  method="POST" action="{{ route('commentaire.post') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth::id() }}">
            <input type="hidden" name="post_id" value="{{ $id }}">
            <input id="input_reply" type="text" placeholder="Post your reply" name="reply">
            <button class="button_reply" type="submit">Reply</button>
        </form>
    </div>
    @include('partials.post_partials', ['feed' => $commentaires])
</div>
@endsection

@section("right_side")
    <div class="whotofollow">
        <h1>Who to follow</h1>
        @foreach($whotofollow as $follow)
            <div class="div_follow">
                <div class="left_follow">
                    <img class="img_follow" src="{{ asset('img/pp/' . $follow->logincompte . '.jpg') }}" alt="">
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
