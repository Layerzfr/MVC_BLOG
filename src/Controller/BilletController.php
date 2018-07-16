<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;


use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class BilletController extends AppController {
    public $helpers = array('Froala.Froala');

    public function index()
    {
        
    }
    
    public function newBillet(){
        session_start();
        if(!isset($_SESSION['username']) || $_SESSION['block'] === 1){
            header('Location: cakephp/');
            $this->redirect(['controller' => 'user', 'action' => 'accueil']);
        }
        $session = $this->request->session();
        if($_SESSION['rank'] < 1){
            $this->redirect(['controller' => 'billet', 'action' => 'readBillet']);
        }
        $this->Billet->newEntity();
        if(isset($_POST['submit'])){
            $this->Billet->newBillet($session->read("id"));
            $this->redirect(['action' => 'readBillet']);
        }
        $this->render("billet");
    }

    public function readBillet(){
        session_start();
        if(!$_SESSION['username'] || $_SESSION['block'] === 1){
            $this->redirect(['controller' => 'user', 'action' => 'accueil']);
        }
        $session = $this->request->session();
        $this->Billet->newEntity();        
    }

    public function editBillet(){
        session_start();
        $id = explode("/", $_SERVER['REQUEST_URI']);
        $idArticle = $id[2];
        if(!$_SESSION['username'] || $_SESSION['block'] === 1){
            echo "Vous devez être connecté";
            $this->redirect(['controller' => 'user', 'action' => 'accueil']);
        }
        $session = $this->request->session();
        $this->Billet->newEntity();
        if(isset($_POST['submit'])){
            $this->Billet->editBillet($session->read("id"), $idArticle);
            $this->redirect(['action' => 'readBillet']);
        }
    }

    public function deleteBillet(){
        session_start();
        if(!$_SESSION['username'] || $_SESSION['block'] === 1){
            $this->redirect(['controller' => 'user', 'action' => 'accueil']);
        }
        $id = explode("/", $_SERVER['REQUEST_URI']);
        $idArticle = $id[2];
        $session = $this->request->session();
        $this->Billet->newEntity();
        if(isset($_POST['submit'])){
            $this->Billet->deleteBillet($session->read("id"), $idArticle);
            $this->redirect(['action' => 'readBillet']);
        }
    }

    public function readOneBillet(){
        session_start();
        $id = explode("/", $_SERVER['REQUEST_URI']);
        $idArticle = $id[2];
        if(!$_SESSION['username'] || $_SESSION['block'] === 1){
            echo "Vous devez être connecté";
            $this->redirect(['controller' => 'user', 'action' => 'accueil']);
        }
        $session = $this->request->session();
        $this->Billet->newEntity();
        if(isset($_POST['submit'])){
            $this->Billet->commentaireBillet($idArticle);       
        }
    }

    public function search(){
        
    }
}
?>