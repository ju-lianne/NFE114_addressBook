<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
</head>

<body>
    <h1>Inscription</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div>
            <label>Nom :</label>
            <input type="text" name="nom" required>
        </div>

        <div>
            <label>Prénom :</label>
            <input type="text" name="prenom" required>
        </div>

        <div>
            <label>Courriel :</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Confirmer le mot de passe :</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <div>
            <label>Date de naissance :</label>
            <input type="date" name="birthdate" required>
        </div>

        <button type="submit">S'inscrire</button>
    </form>

</body>

</html>
