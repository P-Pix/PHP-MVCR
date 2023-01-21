<?php

include_once "Association.php";

interface AssociationStorage {
    public function read(string $id): ?Association;
    public function readAll(): array;
}
?>