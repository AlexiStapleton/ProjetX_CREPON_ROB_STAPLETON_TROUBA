@foreach($feed as $element)
    <div class="elementdiv">
        @if($element instanceof App\Models\Vpost)
            <div class="content_post">
                <div class="div_image">
                    <img class="img_profile img_post" src="{{ asset('img/pp/' . $element->logincompte . '.jpg') }}" alt="">
                </div>
                <div class="div_feed_post click_post" idpost="{{$element->idpost}}">
                    <div class="header_feed_post">
                        <p class="p_info p_nom_post"><a href="{{route('compte.show', ['id'=>$element->idcompte])}}">{{ $element->pseudocompte }}</a></p>
                        <p class="p_info p_pseudo">@ {{ $element->logincompte }} • {{$element->datepost}}</p>
                    </div>
                    <div id="text_marge">
                        <p class="p_text_post">{{ $element->textpost }}</p>
                        <div class="div_img_post">
                        @foreach(explode(',', str_replace(['{', '}'], '', $element->photo_urls)) as $photos)
                            @if(!empty($photos) && stripos($photos, 'NULL') === false)
                                <img src="{{ asset($photos) }}" alt="{{ $photos }}">
                            @endif
                        @endforeach
                        </div>
                    </div>
                    <div class="button_post">
                        @include('partials.button_partials')
                    </div>
                </div>
                <div id="background_popup">
                    <div id="div_citation">
                        <div class="head_post_reply">
                            <img class="img_profile img_post" src="https://pbs.twimg.com/profile_images/1695959673646551040/OJ9rAupv_x96.jpg" alt="">
                            <textarea id="input_post" name="textpost" maxlength="280" placeholder="Add a comment" required></textarea>
                        </div>
                        <form action="{{ route('posts.store')}}" id="div_input" method="POST">
                            @csrf
                            <div class="post_reply_citation">
                                <div class="header_feed_post">
                                    <p class="p_info p_nom_post">{{ $element->pseudocompte }}</p>
                                    <p class="p_info p_pseudo">@ {{ $element->logincompte }}</p>
                                </div>
                                <div id="text_marge">
                                    <p class="p_text_post">{{ $element->textpost }}</p>
                                </div>
                            </div>
                            <input id="imageInput" type="file" name="images[]" accept="image/*">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->idcompte }}">
                            <div id="div_button">
                                <ul id="ul_but_post">
                                    <li>
                                        <svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true" onclick="document.getElementById('imageInput').click();">
                                            <g>
                                                <path d="M3 5.5C3 4.119 4.119 3 5.5 3h13C19.881 3 21 4.119 21 5.5v13c0 1.381-1.119 2.5-2.5 2.5h-13C4.119 21 3 19.881 3 18.5v-13zM5.5 5c-.276 0-.5.224-.5.5v9.086l3-3 3 3 5-5 3 3V5.5c0-.276-.224-.5-.5-.5h-13zM19 15.414l-3-3-5 5-3-3-3 3V18.5c0 .276.224.5.5.5h13c.276 0 .5-.224.5-.5v-3.086zM9.75 7C8.784 7 8 7.784 8 8.75s.784 1.75 1.75 1.75 1.75-.784 1.75-1.75S10.716 7 9.75 7z"></path>
                                            </g>
                                        </svg>
                                        <input type="file" accept="image/*" id="imageInput" style="display:none;">
                                    </li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M3 5.5C3 4.119 4.12 3 5.5 3h13C19.88 3 21 4.119 21 5.5v13c0 1.381-1.12 2.5-2.5 2.5h-13C4.12 21 3 19.881 3 18.5v-13zM5.5 5c-.28 0-.5.224-.5.5v13c0 .276.22.5.5.5h13c.28 0 .5-.224.5-.5v-13c0-.276-.22-.5-.5-.5h-13zM18 10.711V9.25h-3.74v5.5h1.44v-1.719h1.7V11.57h-1.7v-.859H18zM11.79 9.25h1.44v5.5h-1.44v-5.5zm-3.07 1.375c.34 0 .77.172 1.02.43l1.03-.86c-.51-.601-1.28-.945-2.05-.945C7.19 9.25 6 10.453 6 12s1.19 2.75 2.72 2.75c.85 0 1.54-.344 2.05-.945v-2.149H8.38v1.032H9.4v.515c-.17.086-.42.172-.68.172-.76 0-1.36-.602-1.36-1.375 0-.688.6-1.375 1.36-1.375z"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 33 32" aria-hidden="true"><g><path d="M12.745 20.54l10.97-8.19c.539-.4 1.307-.244 1.564.38 1.349 3.288.746 7.241-1.938 9.955-2.683 2.714-6.417 3.31-9.83 1.954l-3.728 1.745c5.347 3.697 11.84 2.782 15.898-1.324 3.219-3.255 4.216-7.692 3.284-11.693l.008.009c-1.351-5.878.332-8.227 3.782-13.031L33 0l-4.54 4.59v-.014L12.743 20.544m-2.263 1.987c-3.837-3.707-3.175-9.446.1-12.755 2.42-2.449 6.388-3.448 9.852-1.979l3.72-1.737c-.67-.49-1.53-1.017-2.515-1.387-4.455-1.854-9.789-.931-13.41 2.728-3.483 3.523-4.579 8.94-2.697 13.561 1.405 3.454-.899 5.898-3.22 8.364C1.49 30.2.666 31.074 0 32l10.478-9.466"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M6 5c-1.1 0-2 .895-2 2s.9 2 2 2 2-.895 2-2-.9-2-2-2zM2 7c0-2.209 1.79-4 4-4s4 1.791 4 4-1.79 4-4 4-4-1.791-4-4zm20 1H12V6h10v2zM6 15c-1.1 0-2 .895-2 2s.9 2 2 2 2-.895 2-2-.9-2-2-2zm-4 2c0-2.209 1.79-4 4-4s4 1.791 4 4-1.79 4-4 4-4-1.791-4-4zm20 1H12v-2h10v2zM7 7c0 .552-.45 1-1 1s-1-.448-1-1 .45-1 1-1 1 .448 1 1z"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M8 9.5C8 8.119 8.672 7 9.5 7S11 8.119 11 9.5 10.328 12 9.5 12 8 10.881 8 9.5zm6.5 2.5c.828 0 1.5-1.119 1.5-2.5S15.328 7 14.5 7 13 8.119 13 9.5s.672 2.5 1.5 2.5zM12 16c-2.224 0-3.021-2.227-3.051-2.316l-1.897.633c.05.15 1.271 3.684 4.949 3.684s4.898-3.533 4.949-3.684l-1.896-.638c-.033.095-.83 2.322-3.053 2.322zm10.25-4.001c0 5.652-4.598 10.25-10.25 10.25S1.75 17.652 1.75 12 6.348 1.75 12 1.75 22.25 6.348 22.25 12zm-2 0c0-4.549-3.701-8.25-8.25-8.25S3.75 7.451 3.75 12s3.701 8.25 8.25 8.25 8.25-3.701 8.25-8.25z"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M6 3V2h2v1h6V2h2v1h1.5C18.88 3 20 4.119 20 5.5v2h-2v-2c0-.276-.22-.5-.5-.5H16v1h-2V5H8v1H6V5H4.5c-.28 0-.5.224-.5.5v12c0 .276.22.5.5.5h3v2h-3C3.12 20 2 18.881 2 17.5v-12C2 4.119 3.12 3 4.5 3H6zm9.5 8c-2.49 0-4.5 2.015-4.5 4.5s2.01 4.5 4.5 4.5 4.5-2.015 4.5-4.5-2.01-4.5-4.5-4.5zM9 15.5C9 11.91 11.91 9 15.5 9s6.5 2.91 6.5 6.5-2.91 6.5-6.5 6.5S9 19.09 9 15.5zm5.5-2.5h2v2.086l1.71 1.707-1.42 1.414-2.29-2.293V13z"></path></g></svg></li>
                                </ul>
                                <button id="but_post_main" type="submit">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if($element instanceof App\Models\Vcitation)
            <div class="content_post">
                <div class="div_image">
                    <img class="img_profile img_post" src="{{ asset('img/pp/' . $element->loginposter . '.jpg') }}" alt="">
                </div>
                <div class="div_feed_post click_post" idpost="{{$element->idpostcitation}}">
                    <div class="header_feed_post">
                        <p class="p_info p_nom_post">{{ $element->pseudoposter }}</p>
                        <p class="p_info p_pseudo">@ {{ $element->loginposter }} • {{ $element->datepost }}</p>
                    </div>
                    <div id="text_marge">
                        <p class="p_text_post">{{ $element->textpost }}</p>
                    </div>
                    <div class="post_citation click_post" idpost="{{$element->idpostcitationoriginal}}">
                        <div class="header_feed_post">
                            <p class="p_info p_nom_post">{{ $element->pseudocompteoriginal }}</p>
                            <p class="p_info p_pseudo">@ {{ $element->logincompteoriginal }}</p>
                        </div>
                        <div id="text_marge">
                            <p class="p_text_post">{{ $element->textpostoriginal }}</p>
                            <div class="div_img_post">
                                <img src="https://pbs.twimg.com/media/GnMbKvxWsAA0zTM?format=jpg&name=small" alt="">
                                <img src="https://pbs.twimg.com/media/GnMbKvxWsAA0zTM?format=jpg&name=small" alt="">
                                <img src="https://pbs.twimg.com/media/GnMbKvxWsAA0zTM?format=jpg&name=small" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="button_post">
                        @include('partials.button_partials')
                    </div>
                </div>
                <div id="background_popup">
                    <div id="div_citation">
                        <div class="head_post_reply">
                            <img class="img_profile img_post" src="https://pbs.twimg.com/profile_images/1695959673646551040/OJ9rAupv_x96.jpg" alt="">
                            <textarea id="input_post" name="textpost" maxlength="280" placeholder="Add a comment" required></textarea>
                        </div>
                        <form action="{{ route('posts.store')}}" id="div_input" method="POST">
                            @csrf
                            <div class="post_reply_citation">
                                <div class="header_feed_post">
                                    <p class="p_info p_nom_post">{{ $element->pseudocompte }}</p>
                                    <p class="p_info p_pseudo">@ {{ $element->logincompte }}</p>
                                </div>
                                <div id="text_marge">
                                    <p class="p_text_post">{{ $element->textpost }}</p>
                                </div>
                            </div>
                            <input id="imageInput" type="file" name="images[]" accept="image/*">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->idcompte }}">
                            <div id="div_button">
                                <ul id="ul_but_post">
                                    <li>
                                        <svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true" onclick="document.getElementById('imageInput').click();">
                                            <g>
                                                <path d="M3 5.5C3 4.119 4.119 3 5.5 3h13C19.881 3 21 4.119 21 5.5v13c0 1.381-1.119 2.5-2.5 2.5h-13C4.119 21 3 19.881 3 18.5v-13zM5.5 5c-.276 0-.5.224-.5.5v9.086l3-3 3 3 5-5 3 3V5.5c0-.276-.224-.5-.5-.5h-13zM19 15.414l-3-3-5 5-3-3-3 3V18.5c0 .276.224.5.5.5h13c.276 0 .5-.224.5-.5v-3.086zM9.75 7C8.784 7 8 7.784 8 8.75s.784 1.75 1.75 1.75 1.75-.784 1.75-1.75S10.716 7 9.75 7z"></path>
                                            </g>
                                        </svg>
                                        <input type="file" accept="image/*" id="imageInput" style="display:none;">
                                    </li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M3 5.5C3 4.119 4.12 3 5.5 3h13C19.88 3 21 4.119 21 5.5v13c0 1.381-1.12 2.5-2.5 2.5h-13C4.12 21 3 19.881 3 18.5v-13zM5.5 5c-.28 0-.5.224-.5.5v13c0 .276.22.5.5.5h13c.28 0 .5-.224.5-.5v-13c0-.276-.22-.5-.5-.5h-13zM18 10.711V9.25h-3.74v5.5h1.44v-1.719h1.7V11.57h-1.7v-.859H18zM11.79 9.25h1.44v5.5h-1.44v-5.5zm-3.07 1.375c.34 0 .77.172 1.02.43l1.03-.86c-.51-.601-1.28-.945-2.05-.945C7.19 9.25 6 10.453 6 12s1.19 2.75 2.72 2.75c.85 0 1.54-.344 2.05-.945v-2.149H8.38v1.032H9.4v.515c-.17.086-.42.172-.68.172-.76 0-1.36-.602-1.36-1.375 0-.688.6-1.375 1.36-1.375z"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 33 32" aria-hidden="true"><g><path d="M12.745 20.54l10.97-8.19c.539-.4 1.307-.244 1.564.38 1.349 3.288.746 7.241-1.938 9.955-2.683 2.714-6.417 3.31-9.83 1.954l-3.728 1.745c5.347 3.697 11.84 2.782 15.898-1.324 3.219-3.255 4.216-7.692 3.284-11.693l.008.009c-1.351-5.878.332-8.227 3.782-13.031L33 0l-4.54 4.59v-.014L12.743 20.544m-2.263 1.987c-3.837-3.707-3.175-9.446.1-12.755 2.42-2.449 6.388-3.448 9.852-1.979l3.72-1.737c-.67-.49-1.53-1.017-2.515-1.387-4.455-1.854-9.789-.931-13.41 2.728-3.483 3.523-4.579 8.94-2.697 13.561 1.405 3.454-.899 5.898-3.22 8.364C1.49 30.2.666 31.074 0 32l10.478-9.466"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M6 5c-1.1 0-2 .895-2 2s.9 2 2 2 2-.895 2-2-.9-2-2-2zM2 7c0-2.209 1.79-4 4-4s4 1.791 4 4-1.79 4-4 4-4-1.791-4-4zm20 1H12V6h10v2zM6 15c-1.1 0-2 .895-2 2s.9 2 2 2 2-.895 2-2-.9-2-2-2zm-4 2c0-2.209 1.79-4 4-4s4 1.791 4 4-1.79 4-4 4-4-1.791-4-4zm20 1H12v-2h10v2zM7 7c0 .552-.45 1-1 1s-1-.448-1-1 .45-1 1-1 1 .448 1 1z"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M8 9.5C8 8.119 8.672 7 9.5 7S11 8.119 11 9.5 10.328 12 9.5 12 8 10.881 8 9.5zm6.5 2.5c.828 0 1.5-1.119 1.5-2.5S15.328 7 14.5 7 13 8.119 13 9.5s.672 2.5 1.5 2.5zM12 16c-2.224 0-3.021-2.227-3.051-2.316l-1.897.633c.05.15 1.271 3.684 4.949 3.684s4.898-3.533 4.949-3.684l-1.896-.638c-.033.095-.83 2.322-3.053 2.322zm10.25-4.001c0 5.652-4.598 10.25-10.25 10.25S1.75 17.652 1.75 12 6.348 1.75 12 1.75 22.25 6.348 22.25 12zm-2 0c0-4.549-3.701-8.25-8.25-8.25S3.75 7.451 3.75 12s3.701 8.25 8.25 8.25 8.25-3.701 8.25-8.25z"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M6 3V2h2v1h6V2h2v1h1.5C18.88 3 20 4.119 20 5.5v2h-2v-2c0-.276-.22-.5-.5-.5H16v1h-2V5H8v1H6V5H4.5c-.28 0-.5.224-.5.5v12c0 .276.22.5.5.5h3v2h-3C3.12 20 2 18.881 2 17.5v-12C2 4.119 3.12 3 4.5 3H6zm9.5 8c-2.49 0-4.5 2.015-4.5 4.5s2.01 4.5 4.5 4.5 4.5-2.015 4.5-4.5-2.01-4.5-4.5-4.5zM9 15.5C9 11.91 11.91 9 15.5 9s6.5 2.91 6.5 6.5-2.91 6.5-6.5 6.5S9 19.09 9 15.5zm5.5-2.5h2v2.086l1.71 1.707-1.42 1.414-2.29-2.293V13z"></path></g></svg></li>
                                </ul>
                                <button id="but_post_main" type="submit">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if($element instanceof App\Models\Vrt)
            <div class="div_retweet">
                <svg viewBox="0 0 24 24" aria-hidden="true"><g><path d="M4.75 3.79l4.603 4.3-1.706 1.82L6 8.38v7.37c0 .97.784 1.75 1.75 1.75H13V20H7.75c-2.347 0-4.25-1.9-4.25-4.25V8.38L1.853 9.91.147 8.09l4.603-4.3zm11.5 2.71H11V4h5.25c2.347 0 4.25 1.9 4.25 4.25v7.37l1.647-1.53 1.706 1.82-4.603 4.3-4.603-4.3 1.706-1.82L18 15.62V8.25c0-.97-.784-1.75-1.75-1.75z"></path></g></svg>
                <p>{{$element->pseudocomptert}} reposted</p>
            </div>
            <div class="content_post content_post_rt">
                <div class="div_image">
                    <img class="img_profile img_post" src="{{ asset('img/pp/' . $element->logincompte . '.jpg') }}" alt="">
                </div>
                <div class="div_feed_post click_post" idpost="{{$element->idrtpost}}">
                    <div class="header_feed_post">
                        <p class="p_info p_nom_post"><a href="{{route('compte.show', ['id'=>$element->idrtcompte])}}">{{ $element->pseudocompte }}</a></p>
                        <p class="p_info p_pseudo">@ {{ $element->logincompte }} • {{ $element->datepost }}</p>
                    </div>
                    <div id="text_marge">
                        <p class="p_text_post">{{ $element->textpost }}</p>
                        <div class="div_img_post">
                            @foreach(explode(',', str_replace(['{', '}'], '', $element->photo_urls)) as $photos)
                                @if(!empty($photos) && stripos($photos, 'NULL') === false)
                                    <img src="{{ asset($photos) }}" alt="{{ $photos }}">
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="button_post">
                        @include('partials.button_partials')
                    </div>
                </div>
                <div id="background_popup">
                    <div id="div_citation">
                        <div class="head_post_reply">
                            <img class="img_profile img_post" src="https://pbs.twimg.com/profile_images/1695959673646551040/OJ9rAupv_x96.jpg" alt="">
                            <textarea id="input_post" name="textpost" maxlength="280" placeholder="Add a comment" required></textarea>
                        </div>
                        <form action="{{ route('posts.store')}}" id="div_input" method="POST">
                            @csrf
                            <div class="post_reply_citation">
                                <div class="header_feed_post">
                                    <p class="p_info p_nom_post">{{ $element->pseudocompte }}</p>
                                    <p class="p_info p_pseudo">@ {{ $element->logincompte }}</p>
                                </div>
                                <div id="text_marge">
                                    <p class="p_text_post">{{ $element->textpost }}</p>
                                </div>
                            </div>
                            <input id="imageInput" type="file" name="images[]" accept="image/*">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->idcompte }}">
                            <div id="div_button">
                                <ul id="ul_but_post">
                                    <li>
                                        <svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true" onclick="document.getElementById('imageInput').click();">
                                            <g>
                                                <path d="M3 5.5C3 4.119 4.119 3 5.5 3h13C19.881 3 21 4.119 21 5.5v13c0 1.381-1.119 2.5-2.5 2.5h-13C4.119 21 3 19.881 3 18.5v-13zM5.5 5c-.276 0-.5.224-.5.5v9.086l3-3 3 3 5-5 3 3V5.5c0-.276-.224-.5-.5-.5h-13zM19 15.414l-3-3-5 5-3-3-3 3V18.5c0 .276.224.5.5.5h13c.276 0 .5-.224.5-.5v-3.086zM9.75 7C8.784 7 8 7.784 8 8.75s.784 1.75 1.75 1.75 1.75-.784 1.75-1.75S10.716 7 9.75 7z"></path>
                                            </g>
                                        </svg>
                                        <input type="file" accept="image/*" id="imageInput" style="display:none;">
                                    </li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M3 5.5C3 4.119 4.12 3 5.5 3h13C19.88 3 21 4.119 21 5.5v13c0 1.381-1.12 2.5-2.5 2.5h-13C4.12 21 3 19.881 3 18.5v-13zM5.5 5c-.28 0-.5.224-.5.5v13c0 .276.22.5.5.5h13c.28 0 .5-.224.5-.5v-13c0-.276-.22-.5-.5-.5h-13zM18 10.711V9.25h-3.74v5.5h1.44v-1.719h1.7V11.57h-1.7v-.859H18zM11.79 9.25h1.44v5.5h-1.44v-5.5zm-3.07 1.375c.34 0 .77.172 1.02.43l1.03-.86c-.51-.601-1.28-.945-2.05-.945C7.19 9.25 6 10.453 6 12s1.19 2.75 2.72 2.75c.85 0 1.54-.344 2.05-.945v-2.149H8.38v1.032H9.4v.515c-.17.086-.42.172-.68.172-.76 0-1.36-.602-1.36-1.375 0-.688.6-1.375 1.36-1.375z"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 33 32" aria-hidden="true"><g><path d="M12.745 20.54l10.97-8.19c.539-.4 1.307-.244 1.564.38 1.349 3.288.746 7.241-1.938 9.955-2.683 2.714-6.417 3.31-9.83 1.954l-3.728 1.745c5.347 3.697 11.84 2.782 15.898-1.324 3.219-3.255 4.216-7.692 3.284-11.693l.008.009c-1.351-5.878.332-8.227 3.782-13.031L33 0l-4.54 4.59v-.014L12.743 20.544m-2.263 1.987c-3.837-3.707-3.175-9.446.1-12.755 2.42-2.449 6.388-3.448 9.852-1.979l3.72-1.737c-.67-.49-1.53-1.017-2.515-1.387-4.455-1.854-9.789-.931-13.41 2.728-3.483 3.523-4.579 8.94-2.697 13.561 1.405 3.454-.899 5.898-3.22 8.364C1.49 30.2.666 31.074 0 32l10.478-9.466"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M6 5c-1.1 0-2 .895-2 2s.9 2 2 2 2-.895 2-2-.9-2-2-2zM2 7c0-2.209 1.79-4 4-4s4 1.791 4 4-1.79 4-4 4-4-1.791-4-4zm20 1H12V6h10v2zM6 15c-1.1 0-2 .895-2 2s.9 2 2 2 2-.895 2-2-.9-2-2-2zm-4 2c0-2.209 1.79-4 4-4s4 1.791 4 4-1.79 4-4 4-4-1.791-4-4zm20 1H12v-2h10v2zM7 7c0 .552-.45 1-1 1s-1-.448-1-1 .45-1 1-1 1 .448 1 1z"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M8 9.5C8 8.119 8.672 7 9.5 7S11 8.119 11 9.5 10.328 12 9.5 12 8 10.881 8 9.5zm6.5 2.5c.828 0 1.5-1.119 1.5-2.5S15.328 7 14.5 7 13 8.119 13 9.5s.672 2.5 1.5 2.5zM12 16c-2.224 0-3.021-2.227-3.051-2.316l-1.897.633c.05.15 1.271 3.684 4.949 3.684s4.898-3.533 4.949-3.684l-1.896-.638c-.033.095-.83 2.322-3.053 2.322zm10.25-4.001c0 5.652-4.598 10.25-10.25 10.25S1.75 17.652 1.75 12 6.348 1.75 12 1.75 22.25 6.348 22.25 12zm-2 0c0-4.549-3.701-8.25-8.25-8.25S3.75 7.451 3.75 12s3.701 8.25 8.25 8.25 8.25-3.701 8.25-8.25z"></path></g></svg></li>
                                    <li><svg class="svg_post" viewBox="0 0 24 24" aria-hidden="true"><g><path d="M6 3V2h2v1h6V2h2v1h1.5C18.88 3 20 4.119 20 5.5v2h-2v-2c0-.276-.22-.5-.5-.5H16v1h-2V5H8v1H6V5H4.5c-.28 0-.5.224-.5.5v12c0 .276.22.5.5.5h3v2h-3C3.12 20 2 18.881 2 17.5v-12C2 4.119 3.12 3 4.5 3H6zm9.5 8c-2.49 0-4.5 2.015-4.5 4.5s2.01 4.5 4.5 4.5 4.5-2.015 4.5-4.5-2.01-4.5-4.5-4.5zM9 15.5C9 11.91 11.91 9 15.5 9s6.5 2.91 6.5 6.5-2.91 6.5-6.5 6.5S9 19.09 9 15.5zm5.5-2.5h2v2.086l1.71 1.707-1.42 1.414-2.29-2.293V13z"></path></g></svg></li>
                                </ul>
                                <button id="but_post_main" type="submit">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endforeach
