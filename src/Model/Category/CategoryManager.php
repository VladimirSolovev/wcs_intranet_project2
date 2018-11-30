<?php
/**
 * User manager file
 *
 * PHP Version 7.2
 *
 * @category Model
 * @package  Manager
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
namespace Model\Category;

use Model\AbstractManager;
use Model\Category\Category;

/**
 * Category manager class
 *
 * @category Model
 * @package  Manager
 * @author   Thomas SY <thomas.sy.pro@gmail.com>
 */
class CategoryManager extends AbstractManager
{
    /**
     * Targeted table const
     */
    const TABLE = 'category';

    /**
     *  Initializes this class.
     *
     * @param \PDO $pdo To use pdo into manager
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    /**
     * Select all Category method
     *
     * @return array
     */
    public function selectAllCategory(): ?array
    {
        if ($this->table === "category") {
            $this->className .= "\Category";
        }

        return $this->pdo->query('SELECT * FROM ' . $this->table, \PDO::FETCH_OBJ)->fetchALL();

    }

    /**
     * Add method
     *
     * @param Category $category Given user to insert
     *
     * @return int|null
     */
    public function addCategory(Category $category): ?int
    {
        $statement = $this->pdo
            ->prepare("INSERT INTO $this->table VALUES (null, :name, :description)");
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        $statement->bindValue('description', $category->getDescription(), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }

        return null;
    }

    /**
     * Edit method
     *
     * @param Category  $category Given user to update
     *
     * @return int|null
     */
    public function editCategory(Category $category): ?int
    {
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `name` = :name, `description` = :description WHERE id=:id");
        $statement->bindValue('id', $category->getId(), \PDO::PARAM_INT);
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        $statement->bindValue('description', $category->getDescription(), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }

        return null;
    }

    /**
     * Delete method
     *
     * @param int $id
     */
    public function deleteCategory(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}