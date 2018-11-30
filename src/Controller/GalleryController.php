<?php
/**
 * This is the controller of the gallery of students.
 *
 * Marc-Antoine Castelain <ma.castelain@gmail.com>
 *
 * There is no copyright or license
 */

namespace Controller;

use Controller\AbstractController;
use Model\User;
use Model\User\UserManager;

/**
 * Controller used to manage students'gallery
 *
 * @Route("/gallery")
 * @Method('GET","POST")
 */
class GalleryController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function gallery()
    {
        $language = null;
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }

        $userManager = new UserManager($this->getPdo());
        $gallery = $userManager->selectAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $language = $_POST['language'];
            if ((int) $language === 0) {
                header("Location: /gallery");
            }

            $userManager = new UserManager($this->getPdo());
            $gallery = $userManager->selectOneByLanguage($language);
        }

        return $this->twig->render(
            '/gallery.html.twig',
            [
                'gallery' => $gallery,
                'language' => $language
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
    public function profileId(int $id)
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }

        $userManager = new UserManager($this->getPdo());
        $user = $userManager->selectOneById($id);
        return $this->twig->render('User/profilelink.html.twig', ['user' => $user]);
    }
}