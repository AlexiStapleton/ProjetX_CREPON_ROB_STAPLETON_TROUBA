@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/compte.css') }}">
@endsection

@section('content')
<div id="main_content">
    <div id="head_compte">
        <svg id="svg_back_compte" viewBox="0 0 24 24" aria-hidden="true" style="color: rgb(239, 243, 244);"><g><path d="M7.414 13l5.043 5.04-1.414 1.42L3.586 12l7.457-7.46 1.414 1.42L7.414 11H21v2H7.414z"></path></g></svg>
        <div>
            <p class="p_head_compte p_name_head">ROCKETTE BAGUETTE</p>
            <p class="p_head_compte" id="p_post_head">12.1K posts</p>
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
        <div id="but_follow">Follow</div>
    </div>

    <div id="margin">
        <div id="info_name">
            <p class="p_head_compte p_name_head">{{$compte->pseudocompte}}</p>
            <p class="p_head_compte p_pseudo">@{{$compte->logincompte}}</p>
        </div>
        <div id="bio">
            <p>{{$compte->descriptioncompte}}</p>
        </div>
        <div id="info_follow">
            <p class="p_info_follow"><span class="nb_follow">10</span> Following</p>
            <p class="p_info_follow"><span class="nb_follow">100</span> Followers</p>
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

    @foreach($feed as $element)
        <div class="elementdiv">
            @if($element instanceof App\Models\Post)
            <div class="content_post">
                <div class="div_image">
                    <img class="img_profile img_post" src="https://pbs.twimg.com/profile_images/1695959673646551040/OJ9rAupv_x96.jpg" alt="">
                </div>
                <div class="div_feed_post">
                    <div class="header_feed_post">
                        <p class="p_info" id="p_nom_post">{{ $element->compte->pseudocompte }}</p>
                        <p class="p_info p_pseudo">@PtitLoupBlanc • Mar 29</p>
                    </div>
                    <p class="p_text_post">{{ $element->textpost }}</p>
                    <div class="button_post">
                        <ul class="ul_feed_but_post">
                            <li class="li_but_post hov_blue">
                                <form class="form_but_post" action="">
                                    <svg class="svg_but_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z"></path></g></svg>
                                    <p class="p_info_but">21</p>
                                </form>
                            </li>
                            <li class="li_but_post hov_green">
                                <form class="form_but_post" action="">
                                    <svg class="svg_but_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path></g></svg>
                                    <p class="p_info_but">{{ count($element->rt) }}</p>
                                </form>
                            </li>
                            <li class="li_but_post hov_red">
                                <form class="form_but_post" action="">
                                    <svg class="svg_but_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M16.697 5.5c-1.222-.06-2.679.51-3.89 2.16l-.805 1.09-.806-1.09C9.984 6.01 8.526 5.44 7.304 5.5c-1.243.07-2.349.78-2.91 1.91-.552 1.12-.633 2.78.479 4.82 1.074 1.97 3.257 4.27 7.129 6.61 3.87-2.34 6.052-4.64 7.126-6.61 1.111-2.04 1.03-3.7.477-4.82-.561-1.13-1.666-1.84-2.908-1.91zm4.187 7.69c-1.351 2.48-4.001 5.12-8.379 7.67l-.503.3-.504-.3c-4.379-2.55-7.029-5.19-8.382-7.67-1.36-2.5-1.41-4.86-.514-6.67.887-1.79 2.647-2.91 4.601-3.01 1.651-.09 3.368.56 4.798 2.01 1.429-1.45 3.146-2.1 4.796-2.01 1.954.1 3.714 1.22 4.601 3.01.896 1.81.846 4.17-.514 6.67z"></path></g></svg>
                                    <p class="p_info_but">{{ count($element->likes) }}</p>
                                </form>
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
                <!-- <div class="postdiv">
                    <div>
                        <p>POST DE : {{ $element->compte->pseudocompte }}</p>
                    </div>
                    <div>
                        <p>{{ $element->textpost }}</p>
                        @foreach($element->photos as $photos)
                            <p>{{ $photos->urlphoto }}</p>
                        @endforeach
                        <p>{{ count($element->likes) }} likes !</p>
                        <p>{{ count($element->rt) }} RT !</p>
                        <p>{{ count($element->commentaires) }} commentaires !</p>
                        <p>{{ $element->datepost }}</p>

                    </div>
                </div> -->
            @endif
            <!-- @if($element instanceof App\Models\Citation)
                <div class="citationdiv">
                    <p>CITATION DE : {{ $element->post->compte->pseudocompte }} </p>
                    <p>{{ $element->post->textpost }}</p>
                    <div class="citationdivoriginal">
                        <div>
                            <p>POST DE : {{ $element->postOriginal->compte->pseudocompte }}</p>
                        </div>
                        <div>
                            <p>{{ $element->postOriginal->textpost }}</p>
                            @foreach($element->postOriginal->photos as $photos)
                                <p>{{ $photos->urlphoto }}</p>
                            @endforeach
                        </div>
                        <p>{{ count($element->postOriginal->likes) }} likes !</p>
                        <p>{{ count($element->postOriginal->rt) }} RT !</p>
                        <p>{{ $element->postOriginal->datepost }}</p>
                    </div>
                    <p>{{ count( $element->post->likes) }} likes !</p>
                    <p>{{ count( $element->post->rt) }} RT !</p>
                    <p>{{ $element->post->datepost }}</p>
                </div>
            @endif
            @if($element instanceof App\Models\RT)
                <div class="rtdiv">
                    <p>{{ $compte->pseudocompte }} a retweeté.</p>
                    <p>rt le {{ $element->datert }}</p>
                    <div class="postdiv">
                        <div>
                            <p>POST DE : {{ $element->post->compte->pseudocompte }}</p>

                        </div>
                        <div>
                            <p>{{ $element->post->textpost }}</p>
                            @foreach($element->post->photos as $photos)
                                <p>{{ $photos->urlphoto }}</p>
                            @endforeach
                            <p>{{ count($element->post->likes) }} likes !</p>
                            <p>{{ count($element->post->rt) }} rt !</p>
                            <p>{{ $element->post->datepost }}</p>
                        </div>
                    </div>
                </div>
            @endif -->

        </div>
    @endforeach
</div>
@endsection





