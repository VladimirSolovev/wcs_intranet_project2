<?php
/**
 * Abstract Controller file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Abstract
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
namespace Controller;
use Twig_Loader_Filesystem;
use Twig_Environment;
use App\Connection;
/**
 * Abstract class controller.
 *
 * @category Controller
 * @package  Abstract
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
abstract class AbstractController
{
    /**
     * Twig environment
     *
     * @var Twig_Environment
     */
    protected $twig;
    /**
     * PDO object allowing to request on DB
     *
     * @var \PDO
     */
    protected $pdo;
    /**
     *  Initializes this class
     */
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(APP_VIEW_PATH);
        $this->twig = new Twig_Environment(
            $loader,
            [
                'cache' => !APP_DEV,
                'debug' => APP_DEV,
            ]
        );
        // SESSION START
        session_start();
        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addExtension(new \Twig_Extension_Debug());
        $connection = new Connection();
        $this->pdo = $connection->getPdoConnection();
    }
    /**
     * Allowing to get PDO outside abstractController
     *
     * @return \PDO
     */
    public function getPdo(): \PDO
    {
        return $this->pdo;
    }
}