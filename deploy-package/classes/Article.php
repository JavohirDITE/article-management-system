<?php
/**
 * Article Model Class
 * Класс модели статьи
 * Maqola model klassi
 */

class Article
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Create a new article
     * Protected from SQL Injection using prepared statements
     */
    public function create(string $title, string $author): bool
    {
        $sql = "INSERT INTO articles (title, author) VALUES (:title, :author)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':title' => $this->sanitizeInput($title),
            ':author' => $this->sanitizeInput($author)
        ]);
    }

    /**
     * Get all articles or search by title
     * Protected from SQL Injection using prepared statements
     */
    public function getAll(?string $search = null): array
    {
        if ($search) {
            $sql = "SELECT * FROM articles WHERE title LIKE :search ORDER BY created_at DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':search' => '%' . $this->sanitizeInput($search) . '%']);
        } else {
            $sql = "SELECT * FROM articles ORDER BY created_at DESC";
            $stmt = $this->db->query($sql);
        }
        
        return $stmt->fetchAll();
    }

    /**
     * Delete an article by ID
     * Protected from SQL Injection using prepared statements
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM articles WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Get article count
     */
    public function getCount(): int
    {
        $sql = "SELECT COUNT(*) as count FROM articles";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        
        return (int)$result['count'];
    }

    /**
     * Sanitize input to prevent XSS attacks
     */
    private function sanitizeInput(string $input): string
    {
        // Remove HTML tags and encode special characters
        $input = strip_tags($input);
        $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        return trim($input);
    }

    /**
     * Escape output for safe display (additional XSS protection)
     */
    public static function escapeOutput(string $output): string
    {
        return htmlspecialchars($output, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}
