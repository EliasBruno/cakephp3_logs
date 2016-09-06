Plugin para Cakephp 3.
Funcionalidade:
-Registra todos os logs de crud do sistema.
-Possibilita Gerênciar os logs através da tela pesquisas.

Itens que são registrado:
-Ação Realizada;
-Informações de dados que foram inseridos;
-Id do usuário;
-Url que o usuário acessou;
-Tabela em que foi realizada a operação;
-Módulo utilizado;
-Data de insersão.

Forma de Utilização:
-Adicionar Behavior no model "$this->addBehavior('Log.Logs');".

