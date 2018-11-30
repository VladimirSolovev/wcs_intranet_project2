<?php
/**
 * Category class controller.
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Controller
 * @author   Vladimir SOLOVEV <vladimirsolovyev9@gmail.com>
 */
namespace Controller;
use Model\User\User;
use Model\User\UserManager;
use Model\Article\Article;
use Model\Article\ArticleManager;
/**
 * Staff class controller
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class StaffController extends AbstractController
{
    /**
     * Display staff's index
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function index()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }

        $articleManager = new ArticleManager($this->getPdo());
        $articles = $articleManager->selectAll();
        $userManager = new UserManager($this->getPdo());
        $users = $userManager->selectAll();
        return $this->twig->render('Staff/index.html.twig', ['articles' => $articles, 'users' => $users]);
    }

    /**
     * UserAdd method
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function userAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!($error = $this->_checkUserData($_POST))
                && !($error = $this->__checkUserFiles($_FILES))) {
                $userManager = new UserManager($this->getPdo());
                $user = new User();
                $user->setFirstName(htmlspecialchars(trim($_POST['firstname'])));
                $user->setLastName(htmlspecialchars(trim($_POST['lastname'])));
                $user->setEmail(htmlspecialchars(trim($_POST['email'])));
                $tempPassword = str_shuffle("apzoeirutyqmsldkjfhgwnbxvc1234567890");
                $tempPassword = substr($tempPassword, 0, 8);
                $user->setPassword(password_hash($tempPassword, PASSWORD_BCRYPT));
                $user->setRole((bool)($_POST['role']));
                $user->setIsConfirmed(false);
                $extensionUpload = strtolower(substr(strchr($_FILES['avatar']['name'], '.'), 1));
                $chemin = "./assets/images/avatar/" . strtolower($_POST['firstname']) . "_" .
                    strtolower($_POST['lastname']) . "." . $extensionUpload;
                $reultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                $user->setAvatar(strtolower($_POST['firstname']) . "_" .
                    strtolower($_POST['lastname']) .  "." . $extensionUpload);
                $data = $userManager->searchIdentical($user);
                if ($data == NULL) {
                    $userManager->add($user);
                    $email = $user->getEmail();
                    $firstName = $user->getFirstname();
                    $message = "Salut $firstName ! On est heureux de te compter parmi nous.
                     Voici ton mot de passe temporaire: $tempPassword, n'hésite pas à le modifier,
                      une fois que ton email sera validé. Afin de valider ton email tu n'as qu'à cliquer ici :
                       http://localhost:8000/confirm?email=$email";
                    mail($email, 'Mon Sujet', $message);
                    header('Location: /');
                }
                $error = "Un utilisateur est déjà enregistré avec cet email.";
            }
            return $this->twig->render('Staff/add.html.twig', ['error' => $error]);
        }
        return $this->twig->render('Staff/add.html.twig', ['error' => null]);
    }

    /**
     * __checkUserData method
     *
     * @param array $post $_POST variable
     *
     * @return string|null $error Wrong POST'ed data
     */
    private function _checkUserData(array $post): ?string {
        $error = null;
        if (empty($post['firstname']) || strlen($post['firstname']) > 32
            || strlen($post['firstname']) === 0)
            return ($error = "Le prénom n'est pas compris entre 1 et 32 char.");
        if (empty($post['lastname']) || strlen($post['lastname']) > 32
            || strlen($post['lastname']) === 0)
            return ($error = "Le nom n'est pas compris entre 1 et 32 char.");
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
            return ($error = "L'email n'a pas un format valide.");
        if ($post['role'] != '0' && $post['role'] != '1')
            return ($error = "Le rôle ne respecte pas le format valide.");
        return $error;
    }

    /**
     * CheckUserFiles method
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string
     */
    private function __checkUserFiles(array $files) : ?string {
        $error = null;
        if (!isset($files['avatar']) || empty($files['avatar']['name']))
            return ($error = "Avatar erreur !");
        return $error;
    }

    /**
     * ForgottenPassword method
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function forgottenPassword()
    {
        $error = null;
        $success = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['emailRequest']) && !empty($_POST['emailRequest'])) {
                $userManager = new UserManager($this->getPdo());
                $user = new User();
                $user->setEmail(htmlspecialchars(trim($_POST['emailRequest'])));
                $data = $userManager->searchIdentical($user);
                if ($data != NULL) {
                    $token = str_shuffle("apzoeirutyqmsldkjfhgwnbxvc1234567890");
                    $token = substr($token, 0, 10);
                    $userManager->createToken($token, $user);
                    $email = $user->getEmail();
                    $message = "link : http://localhost:8000/reset?email=$email&token=$token";
                    if (mail($email, 'Mon Sujet', $message)) {
                        $success = "L'email de changement de mot de passe t'a été envoyé.";
                        return $this->twig->render('Staff/forgotten.html.twig',
                            [
                                'error' => null,
                                'success' => $success
                            ]);
                    } else {
                        $error = "Une erreur s'est produite. Veuillez réessayer.";
                        return $this->twig->render('Staff/forgotten.html.twig',
                            [
                                'error' => $error,
                                'success' => null
                            ]);
                    }
                } else {
                    $error = "Il n'y a pas de comptes qui utilisent cette adresse mail.";
                    return $this->twig->render('Staff/forgotten.html.twig',
                        [
                            'error' => $error,
                            'success' => null
                        ]);
                }
            }
            $error = "Le champ email ne doit pas être vide.";
            return $this->twig->render('Staff/forgotten.html.twig',
                [
                    'error' => $error,
                    'success' => null
                ]);
        }
        return $this->twig->render('Staff/forgotten.html.twig',
            [
                'error' => null,
                'success' => null
            ]);
    }

    /**
     * ResetPassword method
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function resetPassword()
    {
        $error = null;
        $success = null;
        if (isset($_GET['email']) && isset($_GET['token'])) {
            $email = htmlspecialchars(htmlentities($_GET['email']));
            $token = htmlspecialchars(htmlentities($_GET['token']));
            $userManager = new UserManager($this->getPdo());
            $data = $userManager->tokenVerify($email, $token);
            if ($data != NULL) {
                if (isset($_POST['passwordReset']) && !empty($_POST['passwordReset'])) {
                    $regex = "/^(?=[^\d]*\d)(?=[A-Z\d ]*[^A-Z\d ]).{8,}$/i";
                    if (preg_match($regex, $_POST['passwordReset'])) {
                        $newPassword = password_hash($_POST['passwordReset'], PASSWORD_BCRYPT);
                        $userManager->passwordUpdate($newPassword, $email);
                        $success = "Votre mot de passe a bien été modifié. Vous pouvez désormais vous connecter.";
                        return $this->twig->render('Staff/reset.html.twig',
                            [
                                'error' => null,
                                'success' => $success
                            ]);
                    } else {
                        $error = "Le mot de passe doit contenir au moins 1 caractère en miniscule, 
                        1 caractère en majuscule, au moins 1 chiffre et avoir au moins 8 caractères.";

                        return $this->twig->render('Staff/reset.html.twig',
                            [
                                'error' => $error,
                                'success' => null
                            ]);
                    }
                } else {
                    $error = "Le champ de changement de mot de passe ne doit pas etre vide.";
                    return $this->twig->render('Staff/reset.html.twig',
                        [
                            'error' => $error,
                            'success' => null
                        ]);
                }
            } else {
                header('Location: /forgotten');
            }
        } else {
            header('Location: /forgotten');
        }
        return $this->twig->render('Staff/reset.html.twig');
    }
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function confirmEmail()
    {
        $error = null;
        $success = null;
        if (isset($_GET['email'])) {
            $email = htmlspecialchars(htmlentities($_GET['email']));
            $userManager = new UserManager($this->getPdo());
            $data = $userManager->profileVerify($email);
            if ($data != NULL) {
                $data2 = $userManager->emailVerify($email);
                if ($data2 != NULL) {
                    $userManager->verificationEmail($email);
                    $success = "Votre adresse mail a bien été confirmée !";
                    return $this->twig->render('Staff/confirm.html.twig',
                        [
                            'error' => null,
                            'success' => $success
                        ]);
                } else {
                    $error = "Cette adresse mail a déjà été confirmée.";
                    return $this->twig->render('Staff/confirm.html.twig',
                        [
                            'error' => $error,
                            'success' => null
                        ]);
                }
            } else {
                $error = "L'utilisateur avec cette adresse mail n'existe pas.";
                return $this->twig->render('Staff/confirm.html.twig',
                    [
                        'error' => $error,
                        'success' => null
                    ]);
            }
        } else {
            header('Location: /');
        }
    }
    /**
     * Staff's form for editing student
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @param int $id Selected user's id
     *
     * @return string The rendered template
     */
    public function userEdit(int $id)
    {
        $userManager = new UserManager($this->getPdo());
        $userArray = $userManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager($this->getPdo());
            $user = new User();
            $user->setId($userArray['id']);
            $user->setFirstName($_POST['firstname']);
            $user->setLastName($_POST['lastname']);
            $user->setEmail($_POST['email']);
            $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
            $user->setDescription($_POST['description']);
            $userManager->edit($user);
            header('Location:/staff');
        }
        return $this->twig->render(
            'Staff/edit.html.twig',
            [
                'user' => $user = $userArray == null ? null : $userArray,
                'status' => 1
            ]
        );
    }
    /**
     * Staff's route for deleting student
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @param int $id Selected user's id
     *
     * @return void None is returned
     */
    public function userDelete(int $id): void
    {
        $userManager = new UserManager($this->getPdo());
        $userManager->delete($id);
        header('Location: /staff');
    }
    /**
     * Staff's route for creating articles
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function articleAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleManager = new ArticleManager($this->getPdo());
            $article = new Article();
            $article->setIdAuthor($_POST['id_author']);
            $article->setTitle($_POST['title']);
            $article->setDateActuality(date("Y-m-d H:i:s"));
            $article->setContent($_POST['content']);
            $articleManager->add($article);
            header('Location:/staff');
        }
        return $this->twig->render(
            'Staff/createArticles.html.twig',
            [
                'status' => 0
            ]
        );
    }
    /**
     * Staff's form for editing articles
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @param int $id Selected article's id
     *
     * @return string The rendered template
     */
    public function articleEdit(int $id)
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }

        $articleManager = new ArticleManager($this->getPdo());
        $articleArray = $articleManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleManager = new ArticleManager($this->getPdo());
            $article = new Article();
            $article->setContent($_POST['content']);
            $article->setDateActuality(date("Y-m-d H:i:s"));
            $article->setId($_POST['id']);
            $article->setTitle($_POST['title']);
            $articleManager->edit($article);
            header('Location:/staff');
        }
        return $this->twig->render(
            'Staff/editArticle.html.twig',
            [
                'article' => $article = $articleArray == null ? null : $articleArray,
                'status' => 1
            ]
        );
    }
    /**
     * Staff's route for deleting article
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @param int $id Selected article's id
     *
     * @return void None is returned
     */
    public function articleDelete(int $id): void
    {
        $articleManager = new ArticleManager($this->getPdo());
        $articleManager->delete($id);
        header('Location: /staff');
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
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }

        $articleManager = new ArticleManager($this->getPdo());
        $articles = $articleManager->selectAll();
        return $this->twig->render('actuality.html.twig', ['articles' => $articles]);
    }

    /**
     * ResendVerificationEmail function
     */
    public function resendEmail()
    {
        header('Location: /');
    }
}