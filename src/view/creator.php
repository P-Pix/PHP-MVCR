<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Creation Association</title>
</head>
<body>
    <h1>Creation Association</h1>
    <a href="association.php?">Accueil</a>
    <form action="association.php" method="post">
        <label for="name">Nom de l'association</label>
        <input type="text" name="name" id="name"label="bite">
        <label for="content">Contenu de l'association</label>
        <input type="text" name="content" id="content" value="">
        <label for="created_at">Date de création</label>
        <input type="number" name="created_at" id="created_at" value="">
        <input type="submit" value="Créer">
    </form>
</body>
</html>