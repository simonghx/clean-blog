<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Update Post</title>
</head>
<body>
  <h1>Modification du post</h1>
  <h2>Nouveau titre: {{$post->titre}} </h2>
  <h2>Nouveau contenu: </h2>
  <p>
    {{$post->contenu}}
  </p>
</body>
</html>