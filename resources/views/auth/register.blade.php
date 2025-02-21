<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="form-container">
      <h1>Inscription</h1>
      
      @if ($errors->any())
        <div class="error-messages">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
  
      <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Prénom</label>
          <input type="text" name="prenom" required>
        </div>

        <div class="form-group">
          <label>Nom</label>
          <input type="text" name="nom" required>
        </div>
  
        <div class="form-group">
          <label>Courriel</label>
          <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Téléphone</label>
            <input type="text" name="phone" required>
          </div>
  
        <div class="form-group">
          <label>Mot de passe</label>
          <input type="password" name="password" required>
        </div>
  
        <div class="form-group">
          <label>Confirmer le mot de passe :</label>
          <input type="password" name="password_confirmation" required>
        </div>
  
        <div class="form-group">
          <label>Date de naissance</label>
          <input type="date" name="birthdate" required>
        </div>
  
        <button type="submit">S'inscrire</button>
      </form>
    </div>
  </body>

</html>
