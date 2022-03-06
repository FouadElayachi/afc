<!DOCTYPE html>
<html>
<head>
    <title>Bienvenue au site officiel de l'académie des futurs leaders</title>
</head>
 
<body>
<h2>{{$user['first_name_fr']}} {{$user['last_name_fr']}}</h2>
<h3>Bienvenue au site officiel de l'académie des futures leaders</h3>
<br/>
Votre e-mail est: {{$user['email']}} 
<br/>
Veuillez confirmer votre adresse en cliquant sur le lien ci-dessous :
<br/>
<a href="{{url('user/verify', $user->verifyUser->token)}}">Confirmation</a>
</body>
 
</html>