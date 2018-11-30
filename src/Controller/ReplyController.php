<?php
/**
 * ReplyController file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Controller
 * @author   Thomas SY <thomas.sy.pro@gmail.com>
 */
namespace Controller;
use Model\Reply\Reply;
use Model\Reply\ReplyManager;
/**
 * Category class controller.
 *
 * @category Controller
 * @package  Controller
 * @author   Thomas SY <thomas.sy.pro@gmail.com>
 */
class ReplyController extends AbstractController
{

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function replyAdd()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $replyManager = new ReplyManager($this->getPdo());
            $reply = new Reply();
            $reply->setContent($_POST['content']);
            $reply->setDate(date("Y-m-d H:i:s"));
            $reply->setUserId($_POST['user_id']);
            $reply->setTopicId($_POST['topic_id']);
            $replyManager->addReply($reply);
            header('Location:/forum/topic/'. $_POST['topic_id']);
        }

        return $this->twig->render(
            'Forum/showTopic.html.twig', [
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
    public function replyEdit(int $id)
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }

        $replyManager = new ReplyManager($this->getPdo());
        $replyArray = $replyManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $replyManager = new ReplyManager($this->getPdo());
            $reply = new Reply();
            $reply->setId($replyArray['id']);
            $reply->setContent($_POST['subject']);
            $reply->setDate($_POST['date']);
            $reply->setUserId($_POST['user_id']);
            $reply->setTopicId($_POST['topic_id']);
            $replyManager->editReply($reply);
            header('Location:/staff');
        }
        return $this->twig->render(
            'Staff/edit.html.twig', [
                'Reply' => $reply = $replyArray == null ? null : $replyArray,
                'status' => 1
            ]
        );
    }

    /**
     * @param int $id
     */
    public function replyDelete(int $id): void
    {
        $replyManager = new ReplyManager($this->getPdo());
        $replyManager->deleteReply($id);
        header('Location: /staff');
    }
}