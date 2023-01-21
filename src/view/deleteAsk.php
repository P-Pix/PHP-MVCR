<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Ask Delete</title>
</head>
<body>
    <h1>Ask Delete <?php echo $this->router->getAssociationName($_GET['id']) ?></h1>
    <a href="association.php?">Accueil</a>
    <p> Voulez-vous vraiment supprimer l'association <?php echo $this->router->getAssociationName($_GET['id']) ?> ?</p>
    <a href=<?php echo $this->router->getAssociationDeletionURL($_GET['id']) ?>>Oui</a>
    <a href="association.php?">Non</a>
</body>
</html>