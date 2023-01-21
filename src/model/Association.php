<?php 
class Association {
    private string $name;
    private string $content;
    private int $created_at;

    public function __construct(string $name, string $content, int $created_at) {
        $this->name = $name;
        $this->content = $content;
        $this->created_at = $created_at;
    }

    public function getName() {
        return $this->name;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }
};