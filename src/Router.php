<?php

session_start();

include_once("control/Controller.php");
include_once("model/AssociationBuilder.php");
include_once("model/AssociationStorageFile.php");
include_once("view/View.php");

class Router {
    private View $view;
    private Controller $controller;

    public const HOME = "association.php";
    public const LISTE = "association.php?liste=";
    public const CREATION = "association.php?action=nouveau";
    public const PAGE = "association.php?id=";
    public const MODIFIER = "association.php?action=modifier&id=";

    public function __construct(AssociationStorage $associationStorage) {
        $this->view = new View($this);
        $this->controller = new Controller($this->view, $associationStorage);
    }
    
    public function main(): void {        
        // On commence par les tests de POST pour créer une instance d'Association
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                if (empty($value)) {
                    $this->controller->showCreation();
                    return;
                }
            }
            if (isset($_GET["action"]) && $_GET["action"] === "modif") {
                $this->controller->makeModification($_GET["id"], $_POST);
            } else {
                $this->controller->saveNewAssociation($_POST);
                $this->controller->newAssociation();
            }
        } else if (isset($_GET["action"])) {
            if ($_GET["action"] == "nouveau") {
                $this->controller->showCreation();
            } else if ($_GET["action"] == "askdel") {
                $this->controller->showAskDelete($_GET["id"]);
            } else if ($_GET["action"] == "del") {
                $this->controller->showDelete($_GET["id"]);
                $this->controller->delete($_GET["id"]);
            } else if ($_GET["action"] == "modifier") {
                $this->controller->showModifier($_GET["id"]);
            } else {
                $this->controller->showIndex();
            }
        } else if (isset($_GET["id"])) {
            $this->controller->showInformation($_GET["id"]);
            if (isset($_SESSION["feedback"])) {
                if ($_SESSION["feedback"] !== "") {
                    echo "<script type=\"text/javascript\">alert(\"" . $_SESSION["feedback"] . "\");</script>";
                    $_SESSION["feedback"] = "";
                }
            }
        } else if (isset($_GET["liste"])) {
            $this->controller->showListe();
        } else {
            $this->controller->showIndex();
        }
    }
    
    public static function getAssociationURL(string $id): string {
        return Router::PAGE . $id;
    }

    public static function getAssociationListeURL(): string {
        return Router::LISTE;
    }

    public static function getAssociationCreationURL(): string {
        return Router::CREATION;
    }

    public static function getAssociationModificationURL(string $id): string {
        return Router::MODIFIER . $id;
    }

    public static function getAssociationSaveURL(): string {
        return "association.php?action?saveNew";
    }

    public static function getAssociationAskDeletionURL(string $id): string {
        return "association.php?action=askdel&id=" . $id;
    }

    public static function getAssociationDeletionURL(string $id): string {
        return "association.php?action=del&id=" . $id;
    }

    public static function POSTredirect(string $url, string $feedback): void {
        $_SESSION['feedback'] = $feedback;
        header("Location: $url");
        exit;
    }

    public function getAssociationName(string $id): string {
        return $this->getAssociation($id)->getName();
    }

    public function getAssociation(string $id): Association {
        return $this->controller->getAssociation($id);
    }
};