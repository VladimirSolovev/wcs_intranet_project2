<?php
/**
 * DefaultController file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
namespace Controller;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Model\User\UserManager;
/**
 * Class default controller.
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class DefaultController extends AbstractController
{
    /**
     * Displaying home page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = null;
            // Check form's data integrity
            $givenLogin = htmlentities($_POST['email']);
            $givenPassword = htmlentities($_POST['password']);
            $userManager = new UserManager($this->getPdo());
            if (!($user = $userManager->profileVerify($givenLogin)))
                $error = "Mauvais email ou mot de passe.";
            elseif (!(password_verify($givenPassword, $user->getPassword())))
                $error = "Mauvais email ou mot de passe.";
            elseif ($user->getIsConfirmed() == 0)
                $error = "Email n'a pas été confirmé.";
            if ($error)
                return $this->twig->render('index.html.twig', ['error' => $error]);
            $_SESSION['user'] = $user;
            header('Location: /profile');
        }
        return $this->twig->render('index.html.twig', ['error' => null]);
    }

    /**
     * Disconnect function destroys user sessions
     */
    public function disconnect()
    {
        session_destroy();
        header('Location: /');
    }

}