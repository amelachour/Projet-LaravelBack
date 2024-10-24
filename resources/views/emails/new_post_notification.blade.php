<!DOCTYPE html>
<html>
<head>
  <title>Un nouveau post a été publié</title>
</head>
<body>
<h1>Nouveau post publié par l'admin</h1>

<p>Un nouveau post intitulé <strong>{{ $post->title }}</strong> a été publié.</p>
<p>Vous pouvez consulter le contenu complet du post sur la page du profil.</p>

<p><strong>Titre:</strong> {{ $post->title }}</p>
<p><strong>Contenu:</strong> {{ $post->body }}</p>
<p><strong>Location:</strong> {{ $post->location ?? 'Non spécifié' }}</p>

<p>Merci,</p>
<p>L'équipe d'administration</p>
</body>
</html>
