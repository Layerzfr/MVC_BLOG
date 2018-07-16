<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

class ContactTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    public function email($nom, $mail, $body){
        $query = TableRegistry::get('user')
        ->find()
        ->where(['rank' => 2]);
        foreach($query as $user){
            $email = new Email('default');
            $email->from(['me@example.com' => 'Blog - CakePHP'])
            ->to($user->Email)
            ->subject('Contact - Mail de '.$nom.' - '.$mail)
            ->send($body);
        }
                
    }
}
?>