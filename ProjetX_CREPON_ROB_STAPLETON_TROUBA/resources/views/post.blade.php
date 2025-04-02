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
    <div class="content_post">
        <div class="div_image">
            <img class="img_profile img_post" src="https://pbs.twimg.com/profile_images/1695959673646551040/OJ9rAupv_x96.jpg" alt="">
        </div>
        <div class="div_feed_post">
            <div class="header_feed_post">
                <p class="p_info p_nom_post"><a href="{{route('compte.show', ['id'=>$post->idcompte])}}">{{ $post->pseudocompte }}</a></p>
                <p class="p_info p_pseudo">@ {{ $post->logincompte }} • {{$post->datepost}}</p>
            </div>
            <div id="text_marge">
                <p class="p_text_post">{{ $post->textpost }}</p>
                <div class="div_img_post">
                    @foreach(explode(',', str_replace(['{', '}'], '', $post->photo_urls)) as $photos)
                        <!-- <img src="{{ $photos }}" alt=""> -->
                        <img src="{{asset('img/img_post.jpeg')}}" alt="">
                    @endforeach
                </div>
            </div>
            <div class="button_post">
                <ul class="ul_feed_but_post">
                    <li class="li_but_post hov_blue">
                        <form class="form_but_post" action="">
                            <svg class="svg_but_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z"></path></g></svg>
                            <p class="p_info_but">{{ $post->nbcommentaires }}</p>
                        </form>
                    </li>
                    <li class="li_but_post hov_green li_rt">
                        <div class="div_rt">
                            <form class="div_rep" action="{{ route('rt.toggle') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->idcompte }}">
                                <input type="hidden" name="post_id" value="{{ $post->idpost }}">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><g><path d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path></g></svg>
                                <button type="submit">Repost</button>
                            </form>

                            <div class="div_rep quote">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><g><path d="M14.23 2.854c.98-.977 2.56-.977 3.54 0l3.38 3.378c.97.977.97 2.559 0 3.536L9.91 21H3v-6.914L14.23 2.854zm2.12 1.414c-.19-.195-.51-.195-.7 0L5 14.914V19h4.09L19.73 8.354c.2-.196.2-.512 0-.708l-3.38-3.378zM14.75 19l-2 2H21v-2h-6.25z"></path></g></svg>
                                <button>Quote</button>
                            </div>
                        </div>

                        <svg class="svg_but_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path></g></svg>
                        <p class="p_info_but">{{ $post->nb_rts }}</p>
                    </li>
                    <li class="li_but_post hov_red li_like">
                        <svg class="svg_but_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M16.697 5.5c-1.222-.06-2.679.51-3.89 2.16l-.805 1.09-.806-1.09C9.984 6.01 8.526 5.44 7.304 5.5c-1.243.07-2.349.78-2.91 1.91-.552 1.12-.633 2.78.479 4.82 1.074 1.97 3.257 4.27 7.129 6.61 3.87-2.34 6.052-4.64 7.126-6.61 1.111-2.04 1.03-3.7.477-4.82-.561-1.13-1.666-1.84-2.908-1.91zm4.187 7.69c-1.351 2.48-4.001 5.12-8.379 7.67l-.503.3-.504-.3c-4.379-2.55-7.029-5.19-8.382-7.67-1.36-2.5-1.41-4.86-.514-6.67.887-1.79 2.647-2.91 4.601-3.01 1.651-.09 3.368.56 4.798 2.01 1.429-1.45 3.146-2.1 4.796-2.01 1.954.1 3.714 1.22 4.601 3.01.896 1.81.846 4.17-.514 6.67z"></path></g></svg>
                        <p class="p_info_but but_like" data-post-id="{{ $post->idpost }}" data-user-id="{{ Auth::user()->idcompte }}">{{ $post->nblikes }}</p>
                    </li>
                    <li class="li_but_post hov_blue">
                        <form class="form_but_post" action="">
                            <svg class="svg_but_post" viewBox="0 0 24 24" aria-hidden="true" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1xvli5t r-1hdv0qi"><g><path d="M8.75 21V3h2v18h-2zM18 21V8.5h2V21h-2zM4 21l.004-10h2L6 21H4zm9.248 0v-7h2v7h-2z"></path></g></svg>
                            <p class="p_info_but">1.2m</p>
                        </form>
                    </li>
                </ul>
                <div>
                    <button class="but_feed_post"><svg class="svg_but_post hov_blue_svg" viewBox="0 0 24 24" aria-hidden="true" ><g><path d="M4 4.5C4 3.12 5.119 2 6.5 2h11C18.881 2 20 3.12 20 4.5v18.44l-8-5.71-8 5.71V4.5zM6.5 4c-.276 0-.5.22-.5.5v14.56l6-4.29 6 4.29V4.5c0-.28-.224-.5-.5-.5h-11z"></path></g></svg></button>
                    <button class="but_feed_post"><svg class="svg_but_post hov_blue_svg" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M12 2.59l5.7 5.7-1.41 1.42L13 6.41V16h-2V6.41l-3.3 3.3-1.41-1.42L12 2.59zM21 15l-.02 3.51c0 1.38-1.12 2.49-2.5 2.49H5.5C4.11 21 3 19.88 3 18.5V15h2v3.5c0 .28.22.5.5.5h12.98c.28 0 .5-.22.5-.5L19 15h2z"></path></g></svg></button>
                </div>
            </div>
        </div>
    </div>

    <div id="user_reply">
        <div class="image_pp_reply">
            <img class="img_profile img_post" src="https://pbs.twimg.com/profile_images/1695959673646551040/OJ9rAupv_x96.jpg" alt="">
        </div>
        <form id="form_reply" action="">
            <input id="input_reply" type="text" placeholder="Post your reply">
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