<?=$this->Form->create("Logs",["type"=>"GET"]); ?>
    <div class="row">
        <div class="col-xs-2" >
           <?=$this->Form->input("acao",["label"=>"Ação","class"=>"form-control"]);?>
        </div>
        <div class="col-xs-3">
           <?=$this->Form->input("tabela",["label"=>"Tabela","class"=>"form-control"]);?>
        </div>
        <div class="col-xs-2">
           <?=$this->Form->input("modulo",["label"=>"Módulo","class"=>"form-control"]);?>
        </div>
        <div class="col-xs-2" style="width:120px">
           <?=$this->Form->input("created_start",["label"=>"Criado","data-mask"=>"date","class"=>"form-control"]);?>
        </div>
        <div class="col-xs-2" style="width:120px">
           <?=$this->Form->input("created_end",["label"=>"Criado","data-mask"=>"date","class"=>"form-control"]);?>
        </div>
        <div class="col-xs-2" style="width:120px">
           <?=$this->Form->input("updated_start",["label"=>"Atualizado","data-mask"=>"date","class"=>"form-control"]);?>
        </div>
        <div class="col-xs-2" style="width:120px">
           <?=$this->Form->input("updated_end",["label"=>"Atualizado","data-mask"=>"date","class"=>"form-control"]);?>
        </div>
        <div class="col-xs-2">  <br/>
           <label></label>
           <?=$this->Form->button(__('Pesquisar'),["class"=>"btn btn-primary btn-lg","id"=>"buttonSerialize"]);?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6" >
           <?=$this->Form->input("registro",["label"=>"Dados","class"=>"form-control"]);?>
        </div>
    </div>
<?=$this->Form->end(); ?>
<table>
  <thead class="btn-primary">
    <tr>
      <th width="7%"><?=$this->Paginator->sort('Logs.id','Código');?></th>
      <th>Usuário</th>
      <th>Módulo</th>
      <th>Tabela</th>
      <th>Ação</th>
      <th>Criado</th>
      <th>Atualizado</th>
      <th>URL</th>
      <th>Ação</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($dados as $key => $log): ?>
      <tr>
        <td><?=$log->id?></td>
        <td><?=$log->usuario->nome?></td>
        <td><?=$log->modulo?></td>
        <td><?=$log->tabela?></td>
        <td><?=$log->acao?></td>
        <td><?=$log->created->format("d/m/Y H:i:s")?></td>
        <td><?=$log->updated->format("d/m/Y H:i:s")?></td>
        <td><?=$log->url?></td>
        <td><?=$this->Html->link("Detalhes",["action"=>"detalhes",$log->id]);?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?=$this->element("pagination"); ?>
