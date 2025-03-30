<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compte</title>
    <link rel="stylesheet" href="{{ asset('css/compte.css') }}">
</head>
<body>

    <h2>Compte de : {{ $compte->pseudocompte }} </h2>


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
                    </div>
                </div>
            @endif
            @if($element instanceof App\Models\Citation)
                <div class="citationdiv">
                    <p>CITATION DE : {{ $element->post->compte->pseudocompte }} </p>
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
                    </div>
                </div>
            @endif
            @if($element instanceof App\Models\RT)
                <div class="rtdiv">
                    <p>{{ $compte->pseudocompte }} a retweeté.</p>
                    <div class="postdiv">
                        <div>
                            <p>POST DE : {{ $element->compte->pseudocompte }}</p>
                        </div>
                        <div>
                            <p>{{ $element->post->textpost }}</p>
                            @foreach($element->post->photos as $photos)
                                <p>{{ $photos->urlphoto }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    @endforeach

</body>
</html>





