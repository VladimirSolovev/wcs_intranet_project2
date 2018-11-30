<?php

/**
 * Article manager file
 *
 * PHP Version 7.2
 *
 * @category Model
 * @package  Manager
 * @author   Fleur Castel <fleurcastel.pro@gmail.com>
 */

namespace Model\Article;

use Model\AbstractManager;
use Model\Article\Article;

/**
 * Article manager class
 *
 * @category Model
 * @package  Manager
 * @author   Fleur Castel <fleurcastel.pro@gmail.com>
 */
class ArticleManager extends AbstractManager
{
    /**
     * Targeted table const
     */
    const TABLE = 'article';

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
     * Add method
     *
     * @param Article $article to insert
     *
     * @return int|null
     */
    public function add(Article $article): ?int
    {
        $statement = $this->pdo
            ->prepare("INSERT INTO $this->table(content, date_actuality, id_author, title) 
                                VALUES (:content, :date_actuality, :id_author, :title)");
        $statement->bindValue('title', $article->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue('date_actuality', $article->getDateActuality(), \PDO::PARAM_STR);
        $statement->bindValue('content', $article->getContent(), \PDO::PARAM_STR);
        $statement->bindValue('id_author', $article->getIdAuthor(), \PDO::PARAM_INT);

        $statement->execute();
        return null;
    }

    /**
     * Edit method
     *
     * @param Article $article Given article to insert
     *
     * @return int|null
     */
    public function edit(Article $article): ?int
    {
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `title` = :title, `date_actuality` = :date_actuality, 
                                `content` = :content WHERE id=:id");
        $statement->bindValue('id', $article->getId(), \PDO::PARAM_INT);
        $statement->bindValue('title', $article->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue('date_actuality', $article->getDateActuality(), \PDO::PARAM_STR);
        $statement->bindValue('content', $article->getContent(), \PDO::PARAM_STR);

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
    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * Opening articles method
     *
     * @param int $id
     *
     * @return array
     */
    public function readArticle($id)
    {
        $statement = $this->pdo
            ->prepare("SELECT * FROM $this->table WHERE id = :id");

        $statement->execute(['id'=> $id]);

        return $statement->fetchObject();
    }
}