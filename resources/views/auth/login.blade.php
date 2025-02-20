<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="style-flex-column">
    <div class="register-link" style="text-align: center; margin-bottom: 20px;">
        <a class="style-link" href="/inscription">Pas encore de compte ? Inscrivez-vous ici</a>
    </div>

    <div class="form-container">
      <h1>Connexion</h1>
      
      @if ($errors->any())
        <div class="error-messages">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
  
      <form action="{{ route('login.post') }}" method="POST">
        @csrf  
        <div class="form-group">
          <label>Courriel</label>
          <input type="email" name="email" required>
        </div>

        <div class="form-group">
          <label>Mot de passe</label>
          <input type="password" name="password" required>
        </div>
  
        <button type="submit">Se connecter</button>
      </form>
    </div>
  </body>

</html>
