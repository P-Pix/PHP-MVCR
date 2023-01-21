<?php

include_once "AssociationStorage.php";
include_once "lib/ObjectFileDB.php";

class AssociationStorageFile implements AssociationStorage {
    private ObjectFileDB $db;
    private array $associationTab;

    private function loadData(): void {
        $this->associationTab = $this->db->fetchAll();
    }

    public function __construct() {
        $this->db = new ObjectFileDB("/users/22007629/tmp/db");
        $this->loadData();
    }

    public function read(string $id): ?Association {
        if (isset($this->associationTab[$id])) {
            return $this->associationTab[$id];
        }
        return null;
    }

    public function readAll(): array {
        return $this->db->fetchAll();
    }

    public function reinit(): void {
        $this->associationTab = array(
            "CSC" => new Association("Corpo Sciences Caen", "étudiant en science de Caen", 1993),
            "FCBN" => new Association("Fédération Campus Basse Normandie", "association de Basse Normandie", 2012),
            "AFNEUS" => new Association("Association Fédérative Nationale des Etudiants Universitaire en Sciences", "association d'étudiant en science France", 1992),
        );
    }

    public function create(Association $association): ?string {
        foreach ($this->associationTab as $asso) {
            if ($asso->getName() === $association->getName()) {
                if ($asso->getContent() === $association->getContent()) {
                    if ($asso->getCreatedAt() === $association->getCreatedAt()) {
                        return null;
                    }
                }
            }
        }
        $id = $this->db->insert($association);
        $this->associationTab[] = $id;
        return $id;
    }

    public function update(string $id, Association $data): void {
        $this->db->update($id, $data);
    }

    public function delete(string $id): void {
        $this->db->delete($id);
    }
};