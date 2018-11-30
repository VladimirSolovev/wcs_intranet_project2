<?php
/**
 * UserController file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
namespace Controller;
use Model\User\User;
use Model\User\UserManager;
use Model\Article\Article;
use Model\Article\ArticleManager;
/**
 * User class controller.
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class UserController extends AbstractController
{
    /**
     * User's profile page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function profile()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }
        /* After user's login, check if a session exists
        and send user's information to profile's view.
        Write your code here ! */
        return $this->twig->render('User/profile.html.twig');
    }

    /**
     * User's route for opening articles on actuality page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @param int $id Selected article's id
     *
     * @return string None is returned
     */
    public function readActuality($id)
    {
        $articleManager = new ArticleManager($this->getPdo());
        $article = $articleManager->readArticle($id);
        return $this->twig->render('readActuality.html.twig', ['article' => $article]);
    }

    /**
     * Staff's route for adding articles on actuality page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string None is returned
     */
    public function actuality()
    {
        $articleManager = new ArticleManager($this->getPdo());
        $articles = $articleManager->selectAll();

        $comment = 0;
        if (strlen($comment)>50) {
            $comment = substr($comment, 0, 50);
            $dernierMot = strrpos($comment, " ");
            $comment = substr($comment, 0, $dernierMot);
            $comment .= "<a href='/actuality/{id}'>Lire l'article</a>";
        }

        return $this->twig->render('actuality.html.twig', ['articles' => $articles]);
    }
}