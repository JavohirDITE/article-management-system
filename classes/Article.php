<?php

class Article
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Yangi maqola qo'shish
     */
    public function create(string $title, string $author): bool
    {
        $stmt = $this->db->prepare("INSERT INTO articles (title, author) VALUES (:title, :author)");
        return $stmt->execute([
            ':title'  => trim($title),
            ':author' => trim($author),
        ]);
    }

    /**
     * Barcha maqolalarni olish, qidiruv bilan
     */
    public function getAll(?string $search = null): array
    {
        if ($search !== null && $search !== '') {
            $stmt = $this->db->prepare("SELECT * FROM articles WHERE title LIKE :search ORDER BY created_at DESC");
            $stmt->execute([':search' => '%' . $search . '%']);
        } else {
            $stmt = $this->db->query("SELECT * FROM articles ORDER BY created_at DESC");
        }

        return $stmt->fetchAll();
    }

    /**
     * Maqolani o'chirish
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM articles WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
