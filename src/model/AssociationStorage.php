<?php

include_once "Association.php";

interface AssociationStorage {
    public function read(string $id): ?Association;
    public function readAll(): array;
    public function create(Association $association): ?string;
    public function delete(string $id): void;
    public function update(string $id, Association $data): void;
    public function reinit(): void;
};