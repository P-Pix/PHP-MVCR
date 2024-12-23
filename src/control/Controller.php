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

    public function create(Association $asso): void {
        $id = $this->associationStorage->create($asso);
        if ($id == null) {
            $this->displayAssociationCreationFailure();
        } else {
            $this->view->displayAssociationCreationSuccess($id);
        }
    }

    public function delete(string $id): void {
        $this->associationStorage->delete($id);
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
        $this->view->makeListePage($this->associationStorage->readAll());
        $this->view->render();
    }

    public function showCreation(): void {
        $this->view->makeAssociationCreationPage();
        $this->view->render();
    }

    public function showIndex(): void {
        $this->view->makeIndexPage();
        $this->view->render();
    }

    public function showDelete(string $id): void {
        $this->view->makeDeletePage($id);
        $this->view->render();
    }

    public function showAskDelete(string $id): void {
        $this->view->makeAskDeletePage($id);
        $this->view->render();
    }

    public function showModifier(string $id): void {
        $this->view->makeAssociationModificationPage($id);
        $this->view->render();
    }

    public function makeModification(string $id, array $data): void {
        $asso = new AssociationBuilder($data);
        $asso = $asso->createAssociation();
        if ($asso !== null) {
            $this->associationStorage->update($id, $asso);
            $this->view->displayAssociationModificationSuccess($id);
            return;
        }
        $this->view->displayAssociationModificationFailure($id);
    }

    public function newAssociation(): void {
        if (isset($_SESSION["currentNewAssociation"])) {
            $asso = $_SESSION["currentNewAssociation"]->createAssociation();
            if ($asso != null) {
                $this->create($asso);
            } else {
                $this->displayAssociationCreationFailure();
            }
        } else {
            $this->showCreation();
        }
    }
    
    public function saveNewAssociation(array $data): void {
        $_SESSION["currentNewAssociation"] = new AssociationBuilder($data);
    }

    public function getAssociation(string $id): Association {
        return $this->associationStorage->read($id);
    }

    public function getAllAssociations(): array {
        return $this->associationStorage->readAll();
    }
};