<?php 

include_once "view/View.php";
include_once "model/AssociationStorageStub.php";
include_once "model/AssociationStorageFile.php";

class Controller {
    private View $view;
    private AssociationStorage $associationStorage;

    public function __construct(View $view, AssociationStorage $associationStorage) {
        $this->view = $view;
        $this->associationStorage = $associationStorage;
    }

    public function showInformation(string $association): void {
        if ($this->associationStorage->read($association) === null) {
            $this->view->makeUnknownAssociationPage();
        } else {
            $this->view->makeAssociationPage($this->associationStorage->read($association));
        }
        $this->view->render();
    }

    public function showListe(): void {
        $this->view->makeListePage($this->associationStorage->readAll($association));
        $this->view->render();
    }

    public function showCreation(): void {
        $this->view->makeAnimalCreationPage();
        $this->view->render();
    }

    public function showIndex(): void {
        $this->view->makeIndexPage();
        $this->view->render();
    }
};
?>