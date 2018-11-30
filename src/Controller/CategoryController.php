<?php
/**
 * CategoryController file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Controller
 * @author   Thomas SY <thomas.sy.pro@gmail.com>
 */

namespace Controller;

use Model\Category\Category;
use Model\Category\CategoryManager;
use Model\Topic\Topic;
use Model\Topic\TopicManager;

/**
 * Category class controller.
 *
 * @category Controller
 * @package  Controller
 * @author   Thomas SY <thomas.sy.pro@gmail.com>
 */

class CategoryController extends AbstractController
{
    /**
     * Display category's Index
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

        $categoryManager = new CategoryManager($this->getPdo());
        $categories = $categoryManager->selectAllCategory();

        return $this->twig->render('Forum/category.html.twig', ['categories' => $categories]);
    }

    /**
     * Display category's Show
     *
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function categoryShow(int $id)
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }

        $topicManager = new TopicManager($this->getPdo());
        $topics = $topicManager->selectAllTopic($id);

        return $this->twig->render('Forum/topic.html.twig', ['topics' => $topics]);

    }

    /**
     * Staff's form for Creating category
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function categoryAdd()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryManager = new CategoryManager($this->getPdo());
            $category = new Category();
            $category->setName($_POST['name']);
            $category->setDescription($_POST['description']);
            $categoryManager->addCategory($category);
            header('Location:/staff');
        }

        return $this->twig->render(
            'Staff/add.html.twig',
            [
                'status' => 0
            ]
        );
    }

    /**
     * Staff's form for Editing category
     *
     * @param int $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function categoryEdit(int $id)
    {
        if (empty($_SESSION['user'])) {
            header('Location: /');
            return null;
        }

        $categoryManager = new CategoryManager($this->getPdo());
        $categoryArray = $categoryManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryManager = new CategoryManager($this->getPdo());
            $category = new Category();
            $category->setId($categoryArray['id']);
            $category->setName($_POST['name']);
            $category->setDescription($_POST['description']);
            $categoryManager->editCategory($category);
            header('Location:/staff');
        }

        return $this->twig->render(
            'Staff/edit.html.twig',
            [
                'category' => $category = $categoryArray == null ? null : $categoryArray,
                'status' => 1
            ]
        );
    }

    /**
     * Staff's form for Deleting category
     *
     * @param int $id
     */
    public function categoryDelete(int $id): void
    {
        $categoryManager = new CategoryManager($this->getPdo());
        $categoryManager->deleteCategory($id);

        header('Location: /staff');
    }

}