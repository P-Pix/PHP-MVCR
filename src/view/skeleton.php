<?php
include_once ("src/Router.php");
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $this->title?></title>
</head>
<body>
<h1><?php echo $this->title ?></h1>
    <?php echo $this->makeNav();?>
    <a href="<?php echo Router::getAssociationAskDeletionURL($_GET['id']) ?>">Supprimer</a>
    <p>La <?php echo $this->title?> est connue sous le nom de : <?php echo $this->content?> elle a été créée en <?php echo $this->created_at ?></p>
</body>
</html>