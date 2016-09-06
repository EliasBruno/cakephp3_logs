<table>
  <thead class="btn-primary">
    <tr>
      <th>Usuário</th>
      <th>Módulo</th>
      <th>Tabela</th>
      <th>Ação</th>
      <th>Data</th>
      <th>URL</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?=$log->usuario->nome?></td>
      <td><?=$log->modulo?></td>
      <td><?=$log->tabela?></td>
      <td><?=$log->acao?></td>
      <td><?=$log->created->format("d/m/Y H:i")?></td>
      <td><?=$log->url?></td>
    </tr>
  </tbody>
</table>
<table>
  <thead class="btn-primary">
    <tr>
      <th>URL</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="5"><?=$log->url?></td>
    </tr>
  </tbody>
</table>
<table>
  <thead class="btn-primary">
    <tr>
      <th>Descrição</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="5"><?=$log->dados?></td>
    </tr>
  </tbody>
</table>
