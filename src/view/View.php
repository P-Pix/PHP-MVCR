<?php

include_once "model/Association.php";
include_once "Router.php";

class View {
    private string $title;
    private string $content;
    private int $created_at;
    private array $menu;
    private Router $router;

    private string $file;

    public function __construct(Router $router) {
        $this->router = $router;
        // Attribution en dur des pages importantes
        $this->menu["Accueil"] = Router::HOME;
        $this->menu["Liste"] = Router::LISTE;
        $this->menu["Creation"] = Router::CREATION;
        $this->menu["Modifier"] = Router::MODIFIER;
    }

    public function render(): void {
        include($this->file);
    }

    public function makeTestPage(): void {
        $this->title = "Test\n";
        $this->content = "Hello World\n";
        $this->created_at = 2021;
        $this->file = "skeleton.php";
    }

    public function makeAssociationPage(Association $association): void {
        $this->title = $association->getName();
        $this->content = $association->getContent();
        $this->created_at = $association->getCreatedAt();
        $this->file = "skeleton.php";
    }

    public function makeUnknownAssociationPage(): void {
        $this->title = "Erreur 404";
        $this->content = "Il n'éxiste pas d'association avec cette clef";
        $this->created_at = 0;
        $this->file = "unknow.php";
    }

    public function makeListePage(array $associationTab): void {
        $this->title = "Liste";
        $this->content = "<ul>";
        foreach ($associationTab as $key => $value) {
            $this->content .= "<li><a href=\"association.php?id=" . $key . "\">" . $value->getName() . "</a></li>";
        }
        $this->content .= "</ul>";
        $this->created_at = 0;
        $this->file = "liste.php";
    }

    public function makeDeletePage(string $id): void {
        $this->title = "Suppression";
        $this->content = "L'association a bien été supprimée";
        $this->created_at = 0;
        $this->file = "delete.php";
    }

    public function makeAskDeletePage(string $id): void {
        $this->title = "Suppression";
        $this->content = "Voulez-vous vraiment supprimer l'association ?";
        $this->created_at = 0;
        $this->file = "deleteAsk.php";
    }

    public function makeDebugPage(Association $variable): void {
        $this->title = 'Debug';
        $this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
        $this->create_at = 0;
        $this->file = 'liste.php';
    }

    public function makeAssociationModificationPage(string $id): void {
        $this->title = "Modification";
        $this->content = "Modification de l'association";
        $this->created_at = 0;
        $this->file = "creator.php";
    }

    public function makeAssociationCreationPage() {
        $this->title = "Création";
        $this->content = "Création d'une association";
        $this->created_at = 0;
        $this->file = "creator.php";
    }

    public function makeIndexPage() {
        $this->file = "index.php";
    }

    public function displayAssociationModificationSuccess(string $id): void {
        Router::POSTredirect(Router::getAssociationUrl($id), "Modification réussie");
    }

    public function displayAssociationModificationFailure(string $id): void {
        Router::POSTredirect(Router::getAssociationUrl($id), "Modification échouée");
    }

    public function displayAssociationCreationSuccess(string $id): void {
        Router::POSTredirect(Router::getAssociationURL($id), "Création Réussite");
    }

    public function makeNav(): string {
        $retour = "<nav>";
        foreach ($this->menu as $key => $value) {
            if ($key == "Modifier") {
                $retour .= "<a href=$value" . $_GET['id'] . ">$key</a>";
            } else {
                $retour .= "<a href=$value>$key</a>\n";
            }
        }
        return $retour . "</nav>";
    }

    public function displayAssociationCreationFailure(): void {
        Router::POSTredirect(Router::CREATION, "Création Echouée");
    }
};