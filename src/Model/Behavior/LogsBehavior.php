<?php
namespace Log\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\Network\Request;

class LogsBehavior extends Behavior
{
    protected $_defaultConfig = [
      'implementedMethods' => [
        'beforeSave' => 'beforeSave',
      ]
    ];

    public function __construct() {
      $this->request = new Request();
    }

    public function beforeSave(Event $event, Entity $entity, $options) {

      $session = $this->request->session()->read("Auth")['User'];
      if(!isset($session)){
        $event->stopPropagation();
        throw new \UnexpectedValueException('É necessário estar logado no sistema para realizar operações!');
      }
      $data=[];
      $logs=TableRegistry::get("Logs");
      $session= $this->request->session()->read("Auth")['User'];
      $tabela = $event->subject->table();
      $modulo = $event->subject->alias();
      $url = $this->request->referer();
      if($entity->isNew()){
        $registros =  $this->array_post($entity->toArray());
        $dados="Foi cadastrado pelo usuário ".$session['nome']." os seguintes dados: $registros ";
        $data=['url'=>$url,'acao'=>'create','user_id'=>$session['id'],'dados'=>$dados,
              'tabela'=>$tabela,'modulo'=>$modulo];
      }else{
        $registros_changes= $this->array_change($entity->toArray(),$entity);
        $dados="Foi alterado pelo usuário ".$session['nome']." os seguintes campos com o ID $entity->id - $registros_changes ";
        $data=['url'=>$url,'acao'=>'update','user_id'=>$session['id'],'dados'=>$dados,
              'tabela'=>$tabela,'modulo'=>$modulo];
      }
      $log=$logs->newEntity($data);
      $logs->save($log);

    }

    protected function array_post($array){
      $new_array=[];
      foreach ($array as $key => $value){
        if(!is_array($value))
         $new_array[] = "$key => $value";
      }
      return join(", ",$new_array);
    }

    protected function array_change($array,Entity $entity){
      $new_array=[];
      foreach ($array as $key => $value){
        if(!is_array($value)){
          if($entity->dirty($key)){
            $new_array[] = $key." - ". "Antes:" . $entity->getOriginal($key) . "=>". "Depois:" . $value;
          }
        }
      }
      return join(", ",$new_array);
    }

    public function array_to_string($array){
      return implode($array);
    }

}
