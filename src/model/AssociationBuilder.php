<?php

include_once("model/Association.php");

class AssociationBuilder {
    private array $data;
    private string $error;

    public function __construct(array $data) {
        $this->data = $data;
        $this->isValid();
    }
    
    public function createAssociation(): ?Association {
        if ($this->isValid()) {
            return new Association(htmlspecialchars($this->data['name']), htmlspecialchars($this->data['content']), htmlspecialchars($this->data['created_at']));
        }
        return null;
    }
    
    public function getData(): array {
        return $this->data;
    }
    
    public function getError(): string {
        return $this->error;
    }
    
    public function isValid(): bool {
        $this->error = "";
        $retour = true;
        if (!isset($this->data["name"]) || !isset($this->data["content"]) || !isset($this->data["created_at"])) {
            $this->error .= "<p>Missing data</p>";
            $retour = false;
        }

        if (empty($this->data["name"]) || empty($this->data["content"]) || empty($this->data["created_at"])) {
            $this->error .= "<p>Empty data</p>";
            $retour = false;
        }

        if (!is_string($this->data["name"]) || !is_string($this->data["content"]) || !is_numeric($this->data["created_at"])) {
            $this->error .= "<p>Invalid data</p>";
            $retour = false;
        }

        return $retour;
    }
};