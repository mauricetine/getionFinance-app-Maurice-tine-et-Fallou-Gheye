<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenue {{ $user->nom }} {{ $user->prenom }}</h1>
    <p>Votre compte a bien été créé.</p>
    <p>Voici vos informations de compte :</p>
    <ul>
        
        <li>Nom : {{ $user->name }}</li>
        
        <li>CNI : {{ $user->cni }}</li>
        <li>Téléphone : {{ $user->telephone }}</li>
        <li>Email : {{ $user->email }}</li>
        <li>Type de compte : {{ $user->type_compte }}</li>
        <li>Pack : {{ $user->pack }}</li>
        <li>Solde : {{ $user->solde }}</li>
    </ul>

</body>
</html>

