<?php

namespace Log\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\ORM\Entity;

class LogsTable extends Table{

	public function initialize(array $config)
	{
		$this->table("logs");
		$this->belongsTo("Usuarios",["foreignKey"=>"user_id"]);
		$this->session = (new \Cake\Network\Request())->session()->read("Auth")['User'];
    $this->addBehavior('Timestamp', [
        'events' => [
            'Model.beforeSave' => [
                'created' => 'new',
                'updated' => 'always',
            ]
        ]
    ]);
	}

/*	public function findAll(\Cake\ORM\Query $query, array $options)
	{
		return $query->where([$this->alias().'.projeto_id'=>$this->session['projeto_id']]);
	}*/
}
