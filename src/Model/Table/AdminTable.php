<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class AdminTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    public function deleteUser($id){
        $queryDelete = TableRegistry::get('user');
        $user = $queryDelete->get($id);
        $queryDelete->delete($user);
    }
    public function disableUser($id){
        $queryDisable = TableRegistry::get('user');
        $user = $queryDisable->get($id);
        if($user->Block === 1){
        $user->Block = 0;
        }else{
            $user->Block = 1;
        }
        $queryDisable->save($user);
    }
    public function deleteBillet($id){
        $queryDelete = TableRegistry::get('billet');
        $billet = $queryDelete->get($id);
        $queryDelete->delete($billet);
    }

    public function deleteComment($id){
        $queryDelete = TableRegistry::get('commentaire');
        $comment = $queryDelete->get($id);
        $queryDelete->delete($comment);
    }
}
?>