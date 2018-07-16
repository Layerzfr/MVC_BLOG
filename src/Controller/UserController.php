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
use Cake\ORM\TableRegistry;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class UserController extends AppController {

    private $article;
    public function index()
    {
        
    }
    public function inscription(){
        $this->render('register');
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['birthday'])&& isset($_POST['email'])){
            $user = $this->User->newUser();
        }
    }
    public function accueil(){
        session_start();
        $this->User->newEntity();
        $session = $this->request->session();
        
        if(isset($_POST['logoff'])){
            $session->delete("username");
            $session->delete("id");
            $session->delete("rank");
            $session->delete("block");
            $this->redirect(['action' =>'accueil' ]);
        }
        if(isset($_POST['username']) && isset($_POST['password'])){
            $username = $_POST['username'];
            $password = hash('md5', $_POST['password']);
            $articles = TableRegistry::get('User');
            if(
                $query = $articles
                ->find()
                ->where(['Username' => $username])
                ->where(['Password' => $password])
                ->first()){
            $session->write("username", $query->Username);
            $session->write("id", $query->id);
            $session->write("rank", $query->Rank);
            $session->write("block", $query->Block);
            }
        }
        if($session->read('username')){
            $this->render('logoff');
        }else{
            $this->render('accueil');
        }
    }
}
?>