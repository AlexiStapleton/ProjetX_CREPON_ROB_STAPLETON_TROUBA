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
                        <p>{{ $element->compte->pseudocompte }}</p>
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
                    <p>Citation !!</p>
                </div>
            @endif
            @if($element instanceof App\Models\RT)
                <div class="rtdiv">
                    <p>RT !</p>
                </div>
            @endif

        </div>
    @endforeach

</body>
</html>





