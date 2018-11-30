<?php
/**
 * User manager file
 *
 * PHP Version 7.2
 *
 * @reply Model
 * @package  Manager
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
namespace Model\Reply;

use Model\AbstractManager;

/**
 * Reply manager class
 *
 * @reply Model
 * @package  Manager
 * @author   Thomas SY <thomas.sy.pro@gmail.com>
 */
class ReplyManager extends AbstractManager
{
    /**
     * Targeted table const
     */
    const TABLE = 'reply';

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
     * Select all Reply method
     *
     * @param $topic_id
     * @return array
     */
    public function selectAllReply($topic_id): ?array
    {
        if ($this->table === "reply") {
            $this->className .= "\Reply";
        }
        $statement = $this->pdo
            ->query("SELECT *, reply.date as replydate FROM $this->table 
              JOIN topic ON topic.id = reply.topic_id
              JOIN user ON user.id = reply.user_id WHERE topic_id = $topic_id", \PDO::FETCH_OBJ);
        return $statement ->fetchALL();
    }

    /**
     * Add method
     *
     * @param Reply $reply Given user to insert
     *
     * @return int|null
     */
    public function addReply(Reply $reply): ?int
    {
        $statement = $this->pdo
            ->prepare("INSERT INTO $this->table VALUES (null, :content, :date, :user_id, :topic_id )");
        $statement->bindValue('content', $reply->getContent(), \PDO::PARAM_STR);
        $statement->bindValue('date', $reply->getDate(), \PDO::PARAM_STR);
        $statement->bindValue('user_id', $reply->getUserId(), \PDO::PARAM_INT);
        $statement->bindValue('topic_id', $reply->getTopicId(), \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }

        return null;
    }

    /**
     * Edit method
     *
     * @param Reply  $reply Given user to update
     *
     * @return int|null
     */
    public function editReply(Reply $reply): ?int
    {
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `content` = :content, `date` = :date, `user_id` = :user_id, 
        `topic_id` = :topic_id  WHERE id=:id");
        $statement->bindValue('id', $reply->getId(), \PDO::PARAM_INT);
        $statement->bindValue('content', $reply->getContent(), \PDO::PARAM_STR);
        $statement->bindValue('date', $reply->getDate(), \PDO::PARAM_STR);
        $statement->bindValue('user_id', $reply->getUserId(), \PDO::PARAM_INT);
        $statement->bindValue('topic_id', $reply->getTopicId(), \PDO::PARAM_INT);

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
    public function deleteReply(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}