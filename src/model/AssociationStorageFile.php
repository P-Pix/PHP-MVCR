<?php

include_once "AssociationStorage.php";
include_once "lib/ObjectFileDB.php";

class AssociationStorageFile implements AssociationStorage {
    private ObjectFileDB $db;
    private array $associationTab;

    private function loadData(): void {
        $this->associationTab = array(
            "CSC" => new Association("Corpo Sciences Caen", "étudiant en science de Caen", 1993),
            "FCBN" => new Association("Fédération Campus Basse Normandie", "association de Basse Normandie", 2012),
            "AFNEUS" => new Association("Association Fédérative Nationale des Etudiants Universitaire en Sciences", "association d'étudiant en science France", 1992),
        );
    }

    public function __construct() {
        //$this->db = new ObjectFileDB("/users/22007629/tmp");
        $this->db = new ObjectFileDB("./base.json");
        $this->loadData();
    }

    public function read(string $id): ?Association {
        return $this->associationTab[$id];
    }

    public function readAll(): array {
        return $this->associationTab;
    }

    public function reinit(): void {
        $this->loadData();
    }
}

?>