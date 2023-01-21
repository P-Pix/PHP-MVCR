<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $this->title ?></title>
</head>
<body>
    <h1><?php echo $this->title ?></h1>
    <a href="association.php?">Accueil</a>
    <h2><?php echo $this->content ?></h2>
    <?php 
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "modifier") {
            echo "<form action=\"association.php?action=modif&id=" . $_GET["id"] . "\" method=\"post\">";
        } else {
            echo "<form action=\"association.php\" method=\"post\">";
        }
    } else {
        echo "<form action=\"association.php\" method=\"post\">";
    } 
    ?>
        <label for="name">Acronnyme de l'association</label>
        <input type="text" name="name" id="name" value="<?php if (isset($_POST["name"])){echo $_POST["name"];}?>">
        <?php
        if (empty($_POST["name"])) {
            echo "<p style=\"color: red;\">Le nom de l'association ne peut pas être vide</p>";
        }
        ?>
        <hr>
        <label for="content">Nom entier de l'association</label>
        <input type="text" name="content" id="content" value="<?php if (isset($_POST['content'])){echo $_POST['content'];}?>">
        <?php
        if (empty($_POST["content"])) {
            echo "<p style=\"color: red;\">Le contenu de l'association ne peut pas être vide</p>";
        }
        ?>
        <hr>
        <label for="created_at">Date de création</label>
        <input type="number" name="created_at" id="created_at" value="<?php if (isset($_POST['created_at'])){echo $_POST['created_at'];}?>">
        <?php
        if (empty($_POST["created_at"])) {
            echo "<p style=\"color: red;\">La date de création de l'association ne peut pas être vide</p>";
        }
        ?>
        <input type="submit" value="Créer">
    </form>
</body>
</html>