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
namespace Model\User;
use Model\AbstractManager;
use Model\User\User;
use PDO;
/**
 * User manager class
 *
 * @category Model
 * @package  Manager
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class UserManager extends AbstractManager
{
    /**
     * Targeted table const
     */
    const TABLE = 'user';

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
     * @param User $user Given user to insert
     *
     * @return int|null
     */
    public function add(User $user): ?int
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->table VALUES (null, :firstname, :lastname, :email, :password, :role, null, null, null, null, null, null, NOW(), :avatar, null, null, :is_confirmed, null, null)");
        $statement->bindValue('firstname', $user->getFirstName(), \PDO::PARAM_STR);
        $statement->bindValue('lastname', $user->getLastName(), \PDO::PARAM_STR);
        $statement->bindValue('email', $user->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue('password', $user->getPassword(), \PDO::PARAM_STR);
        $statement->bindValue('role', $user->getRole(), \PDO::PARAM_BOOL);
        $statement->bindValue('is_confirmed', $user->getIsConfirmed(), \PDO::PARAM_BOOL);
        $statement->bindValue('avatar', $user->getAvatar(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    /**
     * Add method
     *
     * @param User $user Given user to insert
     *
     * @return int|null
     */
    public function edit(User $user): ?int
    {
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email, `password` = :password, `description` = :description WHERE id=:id");
        $statement->bindValue('id', $user->getId(), \PDO::PARAM_INT);
        $statement->bindValue('firstname', $user->getFirstName(), \PDO::PARAM_STR);
        $statement->bindValue('lastname', $user->getLastName(), \PDO::PARAM_STR);
        $statement->bindValue('email', $user->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue('password', $user->getPassword(), \PDO::PARAM_STR);
        $statement->bindValue('description', $user->getDescription(), \PDO::PARAM_STR);
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
    public function selectOneByLanguage(int $language)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id_language=:id ORDER by firstname");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('id', $language, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * searchIdentical method searches for users with the same email
     *
     * @param \Model\User\User $user
     * @return mixed|null
     */
    public function searchIdentical(User $user)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE email = :email");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('email', $user->getEmail(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $statement->fetch();
        }
        return null;
    }

    /**
     * @param string $email
     *
     * @return User|null User's data
     *
     */
    public function profileVerify(string $email): ?User
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE email = :email");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetchObject("Model\User\User");
        return !$user ? null : $user;
    }

    /**
     * @param string $token
     * @param \Model\User\User $user
     * @return null|string
     */
    public function createToken(string $token, User $user)
    {
        $statement = $this->pdo->prepare("UPDATE $this->table SET `token` = :token, token_expire = DATE_ADD(NOW(), INTERVAL 30 MINUTE) WHERE email=:email");
        $statement->bindValue('token', $token, \PDO::PARAM_STR);
        $statement->bindValue('email', $user->getEmail(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    /**
     * @param string $email
     * @param string $token
     * @return mixed|null
     */
    public function tokenVerify(string $email, string $token)
    {
        $statement = $this->pdo->prepare("SELECT id FROM $this->table WHERE email = :email AND token = :token AND token<>'' AND token_expire > NOW()");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        $statement->bindValue('token', $token, \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $statement->fetch();
        }
        return null;
    }

    /**
     * @param string $email
     * @param string $token
     * @return mixed|null
     */
    public function emailVerify(string $email)
    {
        $statement = $this->pdo->prepare("SELECT id FROM $this->table WHERE email = :email AND is_confirmed = false ");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $statement->fetch();
        }
        return null;
    }
    public function verificationEmail(string $email) {
        $statement = $this->pdo->prepare("UPDATE $this->table SET `is_confirmed` = true WHERE email=:email");
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    /**
     * @param string $password
     * @param string $email
     * @return null|string
     */
    public function passwordUpdate(string $password, string $email)
    {
        $statement = $this->pdo->prepare("UPDATE $this->table SET `password` = :password, `token` = '' WHERE email=:email");
        $statement->bindValue('password', $password, \PDO::PARAM_STR);
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }
}