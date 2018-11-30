<?php
/**
 * TopicController file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Controller
 * @author   Thomas SY <thomas.sy.pro@gmail.com>
 */
namespace Controller;
use Model\Topic\Topic;
use Model\Topic\TopicManager;
use Model\Reply\Reply;
use Model\Reply\ReplyManager;

/**
 * Category class controller.
 *
 * @category Controller
 * @package  Controller
 * @author   Thomas SY <thomas.sy.pro@gmail.com>
 */

class TopicController extends AbstractController
{
    /**
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function topicShow(int $id)
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }
        $topicManager = new TopicManager($this->pdo);
        $topic = $topicManager->selectOneById($id);

        $replyManager = new ReplyManager($this->pdo);
        $replys = $replyManager->selectAllReply($id);

        return $this->twig->render(
            'Forum/showTopic.html.twig',
            [
                'topic' => $topic,
                'replys' => $replys,
            ]
        );
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function topicAdd()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $topicManager = new TopicManager($this->getPdo());
            $topic = new Topic();
            $topic->setSubject($_POST['subject']);
            $topic->setDate(date("Y-m-d H:i:s"));
            $topic->setUserId(/* $_SESSION['user']['id'] */ 1);
            $topic->setCategoryId($_POST['category_id']);
            $topicManager->addTopic($topic);
            header('Location: /forum/category/{id}');
        }
        return $this->twig->render(
            'Forum/createTopic.html.twig',
            [
                'status' => 0
            ]
        );
    }

    /**
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function topicEdit(int $id)
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }
        $topicManager = new TopicManager($this->getPdo());
        $topicArray = $topicManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $topicManager = new TopicManager($this->getPdo());
            $topic = new Topic();
            $topic->setId($topicArray['id']);
            $topic->setSubject($_POST['subject']);
            $topic->setDate(date("Y-m-d H:i:s"));
            $topic->setUserId($_POST['user_id']);
            $topic->setCategoryId($_POST['category_id']);
            $topicManager->editTopic($topic);
            header('Location: /forum/topic/{id}');
        }
        return $this->twig->render(
            'Forum/editTopic.html.twig',
            [
                'topic' => $topic = $topicArray == null ? null : $topicArray,
                'status' => 1
            ]
        );
    }

    /**
     * @param int $id
     */
    public function topicDelete(int $id): void
    {
        $topicManager = new TopicManager($this->getPdo());
        $topicManager->deleteTopic($id);
        header('Location: /forum');
    }
}
