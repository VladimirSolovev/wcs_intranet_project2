<?php
/**
 * Database connection
 *
 * PHP Version 7.2
 *
 * @category Config
 * @package  Config
 * @author   WCS <contact@wildcodeschool.fr>
 * @link     http://fr3.php.net/manual/fr/book.pdo.php classe PDO
 */

namespace App;

use \PDO;

/**
 * This class only make a PDO object instanciation. Use it as below :
 *
 * <pre>
 *  $db = new Connection();
 *  $conn = $db->getPdoConnection();
 * </pre>
 *
 * @category Config
 * @package  Connexion
 * @author   WCS <contact@wildcodeschool.fr>
 * @link     http://fr3.php.net/manual/fr/book.pdo.php classe PDO
 */
class Connection
{
    /**
     * $_pdoConnection useFull to get PDO
     *
     * @var PDO $_pdoConnection useFull to get PDO
     *
     * @access private
     */
    private $_pdoConnection;

    /**
     * Initialize connection
     *
     * @access public
     */
    public function __construct()
    {
        try {
            $this->_pdoConnection = new PDO(
                'mysql:host='.APP_DB_HOST.'; dbname='.APP_DB_NAME.'; charset=utf8',
                APP_DB_USER,
                APP_DB_PWD
            );

            $this->_pdoConnection
                ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_CLASS);

            // show errors in DEV environment
            if (APP_DEV) {
                $this->_pdoConnection
                    ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (\PDOException $e) {
            die('<div class="error">Error !: '.$e->getMessage().'</div>');
        }
    }


    /**
     * Get PDO object
     *
     * @return PDO $pdo PDO Object
     */
    public function getPdoConnection(): PDO
    {
        return $this->_pdoConnection;
    }
}
