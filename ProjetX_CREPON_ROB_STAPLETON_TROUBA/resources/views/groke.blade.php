<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT avec Laravel</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; text-align: center; }
        textarea { width: 50%; height: 100px; }
        button { padding: 10px; margin-top: 10px; }
        .response { margin-top: 20px; font-size: 1.2em; color: #333; }
    </style>
</head>
<body>

    <h2>ChatGPT avec Laravel</h2>
    
    <form action="/grok" method="POST">
        @csrf
        <textarea name="message" placeholder="Pose ta question...">{{ old('message') }}</textarea><br>
        <button type="submit">Envoyer</button>
    </form>

    @if(isset($response))
        <div class="response">
            <strong>Réponse :</strong> {{ $response }}
        </div>
    @endif

</body>
</html>