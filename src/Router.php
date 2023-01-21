<?php

include_once("control/Controller.php");

class Router {
    private View $view;
    private Controller $controller;

    public function __construct() {
        $this->view = new View($this);
        $this->controller = new Controller($this->view, new AssociationStorageFile());
    }

    public function main() {
        if (isset($_GET["id"])) {
            $this->controller->showInformation($_GET["id"]);
        } else if (isset($_GET["liste"])) {
            $this->controller->showListe();
        } else if (isset($_GET["action"])) {
            if ($_GET["action"] == "nouveau") {
                $this->controller->showCreation();
            }
        } else {
            $this->controller->showIndex();
        }
    }

    public static function getAssociationURL(string $id): string {
        return "association.php?id=" . $id;
    }

    public static function getAnimalCreationURL(): string {
        return "association.php?action=nouveau";
    }

    public static function getAnimalSaveURL(): string {
        return "association.php?action?saveNew";
    }
};
?>