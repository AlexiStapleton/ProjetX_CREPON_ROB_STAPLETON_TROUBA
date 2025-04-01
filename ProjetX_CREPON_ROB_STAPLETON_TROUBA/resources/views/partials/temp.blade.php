<!--  @if($element instanceof App\Models\Vrt)
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
