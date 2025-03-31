<!-- @if($element instanceof App\Models\Vcitation)
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
        @if($element instanceof App\Models\Vrt)
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
