<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/connexion.css')}}">
    <title>X</title>
  </head>
  <body>
    <div class="container">
      <div class="container" id="img_container">
        <img src="{{asset('img/x_logo.svg')}}" alt="">
      </div>
      <div class="container" id="login_container">
        <div id="left_content_container">
          <h1 class="text" id="title_1">Ça se passe maintenant</h1>
          <div id="div_inscription">
            <h2 class="text" id="title_2">Inscrivez-vous.</h2>

            <button class="button b_connexion" style="font-weight: 400;">
              <img class="button_logo" src="{{asset('img/google_logo.png')}}" alt="">
              S'inscrire avec Google (bientôt)
            </button>
            <button class="button b_connexion">
              <img class="button_logo" src="{{asset('img/apple_logo.svg')}}" alt="">
              S'inscrire avec Apple (bientôt)
            </button>

            <div class="separator">
              <span>ou</span>
            </div>

            <button class="button" id="b_creer_compte">Créer un compte</button>
          </div>
          <div id="div_connexion">
            <h3 class="text" id="text_connexion">Vous avez déjà un compte ?</h3>
            <button class="button" id="b_connexion">Se connecter</button>
          </div>
        </div>
      </div>

      <div id="background_popup">
        <form id="popup_connexion" action="{{ route('connexion.traitement') }}" method="post">
            @csrf
            <button id="button_close">X</button>
            <img id="logo_info_connexion" src="{{asset('img/x_logo.svg')}}" alt="">
            <div id="info_connexion">
                <h2 id="title_info_connexion">Connectez-vous à X</h2>
                <input name="login" class="input_connexion" type="text" placeholder="Nom d'utilisateur">
                @if($errors->has('login'))
                    <p class="help is-danger">{{ $errors->first('login') }}</p>
                @endif
                <input name="password" class="input_connexion" type="password" placeholder="Mot de passe">
                @if($errors->has('password'))
                    <p class="help is-danger">{{ $errors->first('password') }}</p>
                @endif
                <button type="submit" class="button" id="b_suivant">Suivant</button>
                <button class="button" id="b_mdp">Mot de passe oublié ?</button>
            </div>
        </form>
      </div>

      <div id="background_popup_inscription">
        <form id="popup_inscription" action="{{ route('signup') }}" method="POST">
            @csrf
            <button id="button_close_inscription">X</button>
            <img id="logo_info_connexion" src="{{asset('img/x_logo.svg')}}" alt="">
            <div id="info_connexion">
                <h2 id="title_info_connexion">Inscrivez-vous à X</h2>
                <input name="login" class="input_connexion" type="text" placeholder="Nom d'utilisateur">
                @if($errors->has('login'))
                    <p class="help is-danger">{{ $errors->first('login') }}</p>
                @endif
                <input name="nickname" class="input_connexion" type="text" placeholder="Pseudonyme">
                @if($errors->has('nickname'))
                    <p class="help is-danger">{{ $errors->first('nickname') }}</p>
                @endif
                <input name="password" class="input_connexion" type="password" placeholder="Mot de passe">
                @if($errors->has('password'))
                    <p class="help is-danger">{{ $errors->first('password') }}</p>
                @endif
                <input name="password_confirmation" class="input_connexion" type="password" placeholder="Confimer votre mot de passe">
                @if($errors->has('password_confirmation'))
                    <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                @endif
                <button type="submit" class="button" id="b_suivant">Suivant</button>
                <button class="button" id="b_mdp">Mot de passe oublié ?</button>
            </div>
        </form>
    </div>
  </body>

  <script src="{{asset('js/main.js')}}"></script>
</html>
