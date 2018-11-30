<?php

/**
 * Article entity file
 *
 * PHP Version 7.2
 *
 * @category Model
 * @package  Model
 * @author   Fleur Castel <fleurcastel.pro@gmail.com>
 */

namespace Model\Article;

/**
 * Article entity
 *
 * @category Model
 * @package  Model
 * @author   Fleur Castel <fleurcastel.pro@gmail.com>
 */
class Article
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $id_author;


    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $date_actuality;

    /**
     * @var string
     */
    private $content;

    /**
     * Getting Article's id
     *
     * @return int Id Article's id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Setting Id
     *
     * @param mixed $id Article's id
     *
     * @return Article Current Article
     */
    public function setId($id): Article
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdAuthor(): int
    {
        return $this->id_author;
    }

    /**
     * @param int $id_author
     */
    public function setIdAuthor(int $id_author)
    {
        $this->id_author = $id_author;
    }

    /**
     * Getting Article's title
     *
     * @return string Article's title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setting Article's title
     *
     * @param mixed $title Article's title
     *
     * @return Article Current Article
     */
    public function setTitle($title): Article
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDateActuality(): string
    {
        return $this->date_actuality;
    }

    /**
     * @param string $date_actuality
     */
    public function setDateActuality(string $date_actuality)
    {
        $this->date_actuality = $date_actuality;
    }



    /**
     * Getting Article's content
     *
     * @return string Article's content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Setting Article's content
     *
     * @param mixed $content Article's content
     *
     * @return Article Current Article
     */
    public function setContent($content): Article
    {
        $this->content = $content;

        return $this;
    }
}
