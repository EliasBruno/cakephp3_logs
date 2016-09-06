<?php

namespace Log\Controller;

use App\Controller\AppController;

use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

/**
 * Classe Logs
 */
class LogsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->model=$this->Logs;
        $this->set("title_layout","Logs");
        //$this->desvio = TableRegistry::get("OrigemDesvios");
    }

    public function index(){
      $conditions=[];
      $request = $this->request->query;
      if($this->request->is("get") AND !empty($request)){
          if(!empty($request["acao"])){
            $conditions[] =  array("Logs.acao LIKE "=>"%".$request["acao"]."%");
          }
          if(!empty($request["tabela"])){
            $conditions[] =  array("Logs.tabela LIKE "=>"%".$request["tabela"]."%");
          }
          if(!empty($request["modulo"])){
            $conditions[] =  array("Logs.modulo LIKE "=>"%".$request["modulo"]."%");
          }
          if(!empty($request["registro"])){
            $conditions[] =  array("Logs.dados LIKE "=>"%".$request["registro"]."%");
          }
          if(!empty($request["created_start"]) && !empty($request["created_end"])){
            $created_start=implode("-",array_reverse(explode("/",$request["created_start"])));
            $created_end=implode("-",array_reverse(explode("/",$request["created_end"])));
            $conditions[] =  array("Logs.created >="=>$created_start);
            $conditions[] =  array("Logs.created <="=>$created_end);
          }
          if(!empty($request["updated_start"]) && !empty($request["updated_end"])){
            $updated_start=implode("-",array_reverse(explode("/",$request["updated_start"])));
            $updated_end=implode("-",array_reverse(explode("/",$request["updated_end"])));
            $conditions[] =  array("Logs.updated >="=>$updated_start);
            $conditions[] =  array("Logs.updated <="=>$updated_end);
          }
      }
      $query=$this->model->find("all")
                    ->contain(['Usuarios'])
                    ->order(["Logs.created"=>"DESC"])
                    ->where($conditions);
      $dados = $this->paginate($query);
      $this->set(compact('dados'));
    }

    public function detalhes($id){
        $log=$this->model->get($id,['contain'=>['Usuarios']]);
        $this->set(compact('log'));
    }

}
