<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\Mailer\Email;

class ContactController extends AppController
{
    public function index()
    {
        session_start();
        if(isset($_SESSION['username'])){
        $contact = new ContactForm();
        $this->set('contact', $contact);
        if ($this->request->is('post')) {
            foreach($this->request->getData() as $key => $value){
                if($value === ''){
                    $contact->setErrors(["name" => ["_required" => "Veuiller indiquer un nom"],
                    "email" => ['_required' => "Veuiller indiquer votre email de contact"],
                    "body" => ['_required' => "Veuiller indiquer votre message"]]);
                    $this->Flash->error('Il y a eu un problème lors de la soumission de votre formulaire.
                    Pensez à remplir tous les champs.');
                    return null;
                }
            }
            if ($contact->execute($this->request->getData())) {
                $nom = $this->request->getData('name');
                $mail = $this->request->getData('email');
                $body = $this->request->getData('body');
                $this->Contact->newEntity();
                $this->Contact->email($nom, $mail, $body);
                $this->Flash->success('Nous reviendrons vers vous rapidement.');
            } else {
                $this->Flash->error('Il y a eu un problème lors de la soumission de votre formulaire.');
            }
        }
        
    }else{
        $this->redirect('/');
    }
    }
}
?>