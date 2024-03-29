<?php 
	include_once 'funcoes.php';

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$fk_cli = $_POST['inomec'];
		$fk_func = $_POST['inomef'];
    $fk_prod = $_POST['inomep'];


		$link = conectar();  

		if($_GET['tela'] == 'cadastrar') {

      $sql = "SELECT sum(produto.preco) as valor_total from produto where produto.codigo_prod in ($fk_prod)";
      $res = mysqli_query($link, $sql);
      $valor = mysqli_fetch_array($res);

			$sql = "INSERT INTO vendas (fk_func, fk_cli, data, valor_total) ";
			$sql .= "VALUES ($fk_func, $fk_cli,now(), $valor[0])";
			
			mysqli_query($link,$sql);

			if(mysqli_affected_rows($link)==1){
        echo json_encode([
					'status' => 'success', 
					'mensagem' => 'venda cadastrada!'
				]);
        
        $codigo_venda = mysqli_insert_id($link);
        $codigo_produtos = explode(',', $fk_prod);

        foreach($codigo_produtos as $cod) {
          $sql = "INSERT INTO venda_produto (codigo_venda, codigo_prod) VALUES ($codigo_venda, $cod)";
          mysqli_query($link, $sql);
        }
			}
      else{
				echo json_encode([
					'status' => 'error', 
					'mensagem' => 'Erro ao cadastrar venda!'
				]);
			}
		}
	
 else if($_GET['tela'] == 'editar') {
  $id =  base64_decode($_GET['id']);

  $sql = "DELETE FROM venda_produto where codigo_venda = {$id}";
  mysqli_query($link, $sql);

  $codigo_produtos = explode(',', $fk_prod);

  foreach($codigo_produtos as $cod) {
    $sql = "INSERT INTO venda_produto (codigo_venda, codigo_prod) VALUES ($id, $cod)";
    mysqli_query($link, $sql);
  }

  $sql = "SELECT sum(produto.preco) as valor_total from produto where produto.codigo_prod in ($fk_prod)";
  $resValor = mysqli_query($link, $sql);
  $valor = mysqli_fetch_array($resValor);

  $sql = "UPDATE vendas SET fk_cli = {$fk_cli}, fk_func = {$fk_func}, valor_total = {$valor[0]}";
  $sql .= " WHERE codigo_vendas = $id";

  mysqli_query($link,$sql);
  
  if(mysqli_affected_rows($link)==1) {
    //Editado com sucesso
    echo json_encode([
      'status' => 'success', 
      'mensagem' => 'Venda editada!'
    ]);
  }
  else {
    //Erro ao deditar
    echo json_encode([
      'status' => 'error', 
      'mensagem' => 'Ocorreu algum erro ao editar!'
    ]);
  }
}
else if($_GET['tela'] == 'excluir') {
  $id =  base64_decode($_GET['id']);
  
  $sql = "DELETE FROM vendas WHERE codigo_vendas = {$id}";

  mysqli_query($link, $sql);
  if(mysqli_affected_rows($link)==1) {
    $sql = "DELETE FROM venda_produto WHERE codigo_venda = {$id}";
    mysqli_query($link, $sql);
    
    //Deletado com sucesso
    echo json_encode([
      'status' => 'success', 
      'mensagem' => 'Venda deletada!'
    ]);
  }
  else {
    //Erro ao deletar
    echo json_encode([
      'status' => 'error', 
      'mensagem' => 'Ocorreu algum erro ao deletar!'
    ]);
  }
  desconectar($link);
  }
} else {	
  $link = conectar();
  $sql = "select funcionario.codigo_func, funcionario.nome from funcionario";
  $res = mysqli_query($link,$sql);
  $funcionarios = array();
  while ($dados = mysqli_fetch_array($res)){
    $func = [
      'nome_func' => $dados[1],
      'codigo_func' => $dados[0],
    ];

    array_push($funcionarios, $func);
  }

  $sql = "select cliente.codigo_cli, cliente.nome from cliente";
  $res = mysqli_query($link,$sql);
  $clientes = array();
  while ($dados = mysqli_fetch_array($res)){
    $cli = [
      'nome_cli' => $dados[1],
      'codigo_cli' => $dados[0],
    ];

    array_push($clientes, $cli);
  }

  $sql = "select produto.codigo_prod, produto.nome, produto.preco from produto";
  $res = mysqli_query($link, $sql);
  $produtos = array();
  while ($dados = mysqli_fetch_array($res)) {
    $produto = [
      'codigo_prod' => $dados[0],
      'nome' => $dados[1],
      'preco' => $dados[2],
    ];

    array_push($produtos, $produto);
  }

  $data = [];
  $vendaProdutos = [];

  if(isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $sql = "SELECT * from vendas where codigo_vendas = {$id} LIMIT 1";
    $resVendas = mysqli_query($link, $sql);
    while ($linhas = mysqli_fetch_array($resVendas)){
      $data = $linhas;
    }	
    $sql = "select * from venda_produto where codigo_venda = {$id}";
    $resProdutos = mysqli_query($link, $sql);
    while ($produto = mysqli_fetch_array($resProdutos)) {
      array_push($vendaProdutos, $produto);
    }
  }


  echo json_encode([
    'status' => 'success', 
    'mensagem' => 'vendas recuperadas',
    'data' => [
      'funcionarios' => $funcionarios,
      'clientes' => $clientes,
      'produtos' => $produtos,
      'vendas' => $data,
      'vendaProdutos' => $vendaProdutos,
    ]
  ]);
  desconectar($link);
}
 ?>