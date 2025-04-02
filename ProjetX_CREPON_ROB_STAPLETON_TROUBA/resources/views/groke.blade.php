@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/grok.css') }}">
@endsection

@section('content')
    <div id="main_content" class="grok_content">
        <p id="title_grok">Grok 3 <span>Beta</span></p>

        <svg id="grok_logo" viewBox="0 0 88 32" aria-hidden="true"><g><path d="M76.717 24.208V7.916h2.596v10.752l5.493-6.257h3.148l-4.94 5.362L88 24.208h-3.102l-4.04-5.53-1.545-.01v5.54h-2.596zm-7.876.274c-3.86 0-5.951-2.716-5.951-6.184 0-3.491 2.09-6.184 5.951-6.184 3.884 0 5.952 2.693 5.952 6.184 0 3.468-2.068 6.184-5.952 6.184zm-3.24-6.184c0 2.692 1.471 4.039 3.24 4.039 1.793 0 3.24-1.347 3.24-4.04 0-2.692-1.447-4.06-3.24-4.06-1.769 0-3.24 1.368-3.24 4.06zm-9.939 5.91v-9.926l2.184-1.871h4.642v2.19h-4.229v9.607h-2.597zm-9.929.301c-4.95 0-7.9-3.564-7.9-8.424 0-4.906 3.056-8.557 7.997-8.557 3.86 0 6.687 1.962 7.353 5.613H50.22c-.437-2.076-2.183-3.24-4.39-3.24-3.561 0-5.124 3.058-5.124 6.184 0 3.126 1.563 6.16 5.125 6.16 3.4 0 4.895-2.441 5.01-4.472h-5.125v-2.362h7.744l-.013 1.235c0 4.59-1.886 7.863-7.713 7.863zM12.98 20.54l11.175-8.19c.547-.4 1.33-.244 1.591.38 1.374 3.288.76 7.241-1.973 9.955-2.733 2.714-6.536 3.31-10.012 1.954l-3.797 1.745c5.446 3.697 12.06 2.782 16.193-1.324 3.278-3.255 4.293-7.692 3.344-11.693l.008.009c-1.376-5.878.339-8.227 3.852-13.031l.25-.345-4.624 4.59v-.014l-16.01 15.968m-2.302 1.987c-3.91-3.707-3.235-9.446.1-12.755 2.467-2.449 6.508-3.448 10.036-1.979l3.788-1.737c-.682-.49-1.557-1.017-2.561-1.387-4.537-1.854-9.97-.931-13.658 2.728-3.547 3.523-4.663 8.94-2.747 13.561 1.431 3.454-.915 5.898-3.278 8.364C1.517 30.2.677 31.074 0 32l10.672-9.466"></path></g></svg>
        
        <form id="form_grok" action="/grok" method="POST">
            @csrf
            <div class="input-container">
                <textarea id="chatInput" name="message" placeholder="Pose ta question..." oninput="autoResize(this)"></textarea>
                <button type="submit" class="send-button"><svg viewBox="0 0 32 32" aria-hidden="true" class="r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-eu3ka r-1aockid"><g><defs><mask id="0-a"><path d="M0 0h32v32H0z" fill="#fff"></path><path d="M15.25 12.562l-3.78 3.783-1.065-1.06L16 9.69l5.595 5.593-1.065 1.06-3.78-3.782v10.19h-1.5v-10.19z" fill="#000"></path></mask></defs><rect fill="currentColor" height="30" mask="url(#0-a)" rx="15" width="30" x="1" y="1"></rect></g></svg></button>
            </div>
        </form>

        @if(isset($response))
            <div class="response">
                <pre id="chat-response"></pre>
            </div>
            <script>
                let responseText = @json($response);
                let responseContainer = document.getElementById('chat-response');
                let index = 0;

                function displayNextCharacter() {
                    let currentChar = responseText[index];

                    // Vérifier si on commence un mot en gras (**)
                    if (currentChar === "*" && responseText[index + 1] === "*") {
                        let boldTag = document.createElement("b");
                        index += 2; // Passer les deux étoiles
                        let wordStart = index;

                        // Boucler pour traiter le texte en gras
                        while (index < responseText.length) {
                            currentChar = responseText[index];

                            // Si on atteint la fin du mot en gras (**), on ferme la balise <b>
                            if (currentChar === "*" && responseText[index + 1] === "*") {
                                boldTag.textContent = responseText.slice(wordStart, index); // Ajouter le texte en gras
                                responseContainer.appendChild(boldTag);
                                index += 2; // Passer les deux étoiles
                                break; // On sort de la boucle
                            } else {
                                index++;
                            }
                        }

                        return setTimeout(displayNextCharacter, 30); // Relancer la fonction
                    }

                    // Vérifier si on commence un mot en italique (*)
                    else if (currentChar === "*" && responseText[index + 1] !== "*") {
                        let italicTag = document.createElement("i");
                        index++; // Passer l'étoile
                        let wordStart = index;

                        // Boucler pour traiter le texte en italique
                        while (index < responseText.length) {
                            currentChar = responseText[index];

                            // Si on atteint la fin du mot en italique (*), on ferme la balise <i>
                            if (currentChar === "*" && responseText[index + 1] !== "*") {
                                italicTag.textContent = responseText.slice(wordStart, index); // Ajouter le texte en italique
                                responseContainer.appendChild(italicTag);
                                index++; // Passer l'étoile
                                break; // On sort de la boucle
                            } else {
                                index++;
                            }
                        }

                        return setTimeout(displayNextCharacter, 30); // Relancer la fonction
                    }

                    // Ajouter un texte normal si ce n'est pas un mot spécial
                    responseContainer.appendChild(document.createTextNode(currentChar));
                    index++;

                    if (index < responseText.length) {
                        setTimeout(displayNextCharacter, 30); // Relancer la fonction
                    }
                }

                displayNextCharacter();
            </script>
        @endif
    </div>
    <script>
        function autoResize(textarea) {
            textarea.style.height = "40px";
            textarea.style.height = (textarea.scrollHeight) + "px";
        }
    </script>
@endsection