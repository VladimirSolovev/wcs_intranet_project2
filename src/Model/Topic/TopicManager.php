<?php
/**
 * Created by PhpStorm.
 * User: tomy
 * Date: 10/10/18
 * Time: 17:58
 */

namespace Model\Topic;

use Model\AbstractManager;
use Model\Category\Category;
use Model\Topic\Topic;
/**
 * Topic manager class
 *
 * @category Model
 * @package  Manager
 * @author   Thomas SY <thomas.sy.pro@gmail.com>
 */
class TopicManager extends AbstractManager
{
    /**
     * Targeted table const
     */
    const TABLE = 'topic';

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
     * Select all Topic method
     *
     * @param $category_id
     * @return array
     */
    public function selectAllTopic($category_id): ?array
    {
        if ($this->table === "topic") {
            $this->className .= "\Topic";
        }
        $statement = $this->pdo
            ->query("SELECT *,topic.id as topicid, topic.date as topicdate FROM $this->table 
              JOIN category ON category.id = topic.category_id
              JOIN user ON user.id = topic.user_id WHERE category_id = $category_id", \PDO::FETCH_OBJ);

        return $statement->fetchALL();

    }

    /**
     * Add method
     *
     * @param Topic $topic Given user to insert
     *
     * @return int|null
     */
    public function addTopic(Topic $topic): ?int
    {
        $statement = $this->pdo
            ->prepare("INSERT INTO $this->table VALUES (null, :subject, :date, :user_id, :category_id )");
        $statement->bindValue('content', $topic->getContent(), \PDO::PARAM_STR);
        $statement->bindValue('date', $topic->getDate(), \PDO::PARAM_STR);
        $statement->bindValue('user_id', $topic->getUserId(), \PDO::PARAM_INT);
        $statement->bindValue('category_id', $topic->getCategoryId(), \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }

        return null;
    }

    /**
     * Edit method
     *
     * @param Topic $topic Given user to update
     *
     * @return int|null
     */
    public function editTopic(Topic $topic): ?int
    {
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `subject` = :subject, `date` = :date, `user_id` = :user_id, 
        `category_id` = :category_id  WHERE id=:id");
        $statement->bindValue('id', $topic->getId(), \PDO::PARAM_INT);
        $statement->bindValue('date', $topic->getDate(), \PDO::PARAM_STR);
        $statement->bindValue('user_id', $topic->getUserId(), \PDO::PARAM_INT);
        $statement->bindValue('category_id', $topic->getCategoryId(), \PDO::PARAM_INT);

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
    public function deleteTopic(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
