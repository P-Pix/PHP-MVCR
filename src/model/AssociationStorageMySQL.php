<?php

class AssociationStorageMySQL implements AssociationStorage {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function read(string $id): ?Association {
        $stmt = $this->pdo->prepare("SELECT * FROM Association WHERE ID = :id");
        $stmt->execute(array(":id" => $id));
        $row = $stmt->fetch();
        if ($row === false) {
            return null;
        } 
        return new Association($row["ACRONYME"], $row["NOM"], $row["CREATION"]);
    }

    public function readAll(): array {
        $request = "SELECT * FROM Association;";
        $query = $this->pdo->query($request);
        $data = $query->fetchAll();
        $associationTab = array();
        foreach ($data as $row) {
            $associationTab[$row["ID"]] = new Association($row["ACRONYME"], $row["NOM"], $row["CREATION"]);
        }
        return $associationTab;
    }

    public function create(Association $association): ?string {
        $liste = $this->readAll();
        $id = count($liste) + 1;
        $request = "INSERT INTO Association (ID, ACRONYME, NOM, CREATION) VALUES (:id, :acronyme, :nom, :creation);";
        $query = $this->pdo->prepare($request);
        $query->execute(array(
            ':id' => $id,
            ':acronyme' => $association->getName(),
            ':nom' => $association->getContent(),
            ':creation' => $association->getCreatedAt()
        ));
        return $id;
    }

    public function delete(string $id): void {
        $request = "DELETE FROM Association WHERE ID = :id;";
        $query = $this->pdo->prepare($request);
        $query->execute(array(":id" => $id));
    }

    public function update(string $id, Association $data): void {
        $request = "UPDATE Association SET ACRONYME = :acronyme, NOM = :nom, CREATION = :creation WHERE ID = :id;";
        $query = $this->pdo->prepare($request);
        $query->execute(array(
            ':id' => $id,
            ':acronyme' => $data->getName(),
            ':nom' => $data->getContent(),
            ':creation' => $data->getCreatedAt()
        ));
    }

    public function reinit(): void {
        $request = "DELETE FROM Association;";
        $query = $this->pdo->prepare($request);
        $query->execute();
        $request = "INSERT INTO Association (ID, ACRONYME, NOM, CREATION) VALUES (1, 'CSC', 'Corpo Sciences Caen', 1993);";
        $query = $this->pdo->prepare($request);
        $query->execute();
        $request = "INSERT INTO Association (ID, ACRONYME, NOM, CREATION) VALUES (2, 'FCBN', 'Fédération Campus Basse Normandie', 2012);";
        $query = $this->pdo->prepare($request);
        $query->execute();
        $request = "INSERT INTO Association (ID, ACRONYME, NOM, CREATION) VALUES (3, 'AFNEUS', 'Association Fédérative Nationale des Etudiants Universitaire en Sciences', 1992);";
        $query = $this->pdo->prepare($request);
        $query->execute();
    }
}