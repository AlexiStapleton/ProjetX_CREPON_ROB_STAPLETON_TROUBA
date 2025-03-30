<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feed de {{ $compte->pseudocompte }}</title>
    <link rel="stylesheet" href="{{ asset('css/compte.css') }}">
</head>
<body>

@foreach($feed as $element)
    <div class="elementdiv">
        @if($element instanceof App\Models\Post)
            <div class="postdiv">
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
                </div>
            </div>
        @endif
        @if($element instanceof App\Models\Citation)
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
                </div>
                <p>{{ count( $element->post->likes) }} likes !</p>
                <p>{{ count( $element->post->rt) }} RT !</p>
            </div>
        @endif
        @if($element instanceof App\Models\RT)
            <div class="rtdiv">
                <p>{{ $compte->pseudocompte }} a retweeté.</p>
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
                    </div>
                </div>
            </div>
        @endif

    </div>
@endforeach
</body>
</html>
