<?php

include_once "AssociationStorage.php";

class AssociationStorageStub implements AssociationStorage {
    private array $associationTab;

    public function __construct() {
        $this->associationTab = array(
            "Corpo Sciences Caen" => new Association("Corpo Sciences Caen", "étudiant en science de Caen", 1993),
            "Fédération Campus Basse Normandie" => new Association("Fédération Campus Basse Normandie", "association de Basse Normandie", 2012),
            "Association Fédérative Nationale des Etudiants Universitaire en Sciences" => new Association("Association Fédérative Nationale des Etudiants Universitaire en Sciences", "association d'étudiant en science France", 1992),
        );
    }

    public function read(string $id): ?Association {
        return $this->associationTab[$id];
    }

    public function readAll(): array {
        return $this->associationTab;
    }
}

?>