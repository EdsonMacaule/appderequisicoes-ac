<?php
//Definindo os Paramentros da Base de Dados

$DB_HOST ="51.38.121.199";
$DB_USER ="lifelife_balango";
$DB_PASS ="Balango@dev1";
$DB_NAME ="lifelife_sgpi";

$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

//Receber a requisição da pesquisa

$requestData=$_REQUEST;

//Indice da coluna na vizualizar resultado => nome da coluna no banco de dados

$columns = array(
    array ('0' => 'descricao_pedido');
    array ('1' => 'id_utilizador');
    array ('2' => 'id_departamento');
    array ('3' => 'id_estado');
    array ('4' => 'id_prioridade');
    array ('5' => 'data_prioridade');
    array ('6' => 'update_data');
);

$result_req = "SELECT pd.id_pedido, pd.descricao_pedido, u.nome_utilizador, d.nome_departamento, e.nome_estado, pr.nome_prioridade,pd.data_pedido,pd.update_data  FROM tb_pedido pd INNER JOIN tb_utilizadores u ON pd.id_utilizador=u.id_utilizador INNER JOIN tb_departamento d ON pd.id_departamento=d.id_departamento INNER JOIN tb_estado e ON pd.id_estado=e.id_estado INNER JOIN tb_prioridade pr ON pd.id_prioridade=pr.id_prioridade ORDER BY pd.data_pedido DESC";
$resultado_req = mysqli_query ($conn, $result_req);
$qnt_linhas = mysqli_num_rows ($resultado_req);

//Obter os dados a serem apresentados

$result_req.="ORDEY BY ". $columns[$requestData['order'][0] ['column']]." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_req=mysqli_query($conn, $result_req);

// ler e criar o array de dados

$dados = array();

while ( $row_reques = mysqli_fetch_array($resultado_req){
    $dados = array();
    $dados[] = $row_reques["descricao_pedido"];
    $dados[] = $row_reques["id_utilizador"];
    $dados[] = $row_reques["id_departamento"];
    $dados[] = $row_reques["id_estado"];
    $dados[] = $row_reques["id_prioridade"];
    $dados[] = $row_reques["data_prioridade"];
    $dados[] = $row_reques["update_pedido"];

    $dados[] = $dado;
    
})

// Criar o array de informações a seren retornados para o Javascript

$json_data = array(
    "draw" => intval($requestData['draw']), // para cada requisição é enviado um número com parâmetro
    "recordsTotal": => intval($qnt_linhas), // Quantidade de registros que há no banco de dados
    "recordsFiltered": => intval($totalFiltered), // Total de registros quando houver pesquisa
    "data" => $dados // Array de dados completo dos dados retornados da tabela 
);

echo json_encode($json_data); // enviar dados como formato json

?>