<?php

include_once "model/Association.php";
include_once "Router.php";

class View {
    private string $title;
    private string $content;
    private int $created_at;
    private Router $router;

    private string $file;

    public function __construct(Router $router) {
        $this->router = $router;
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
        $this->title = null;
        $this->content = null;
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

    public function makeDebugPage(Association $variable): void {
        $this->title = 'Debug';
        $this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
        $this->create_at = 0;
        $this->file = 'liste.php';
    }

    public function makeAnimalCreationPage() {
        $this->file = "creator.php";
    }

    public function makeIndexPage() {
        $this->file = "index.php";
    }
}
?>