<?php include_once 'funcoes.php'; 

verificaPermissao();

if(isset($_GET['sair'])) {
	if($_GET['sair'] == true){
		session_destroy();
		redireciona('index.php');
	}
}
?>
<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <title></title>
  <meta charset="UTF8" />
  <link rel="stylesheet" type="text/css" href="../CSS/bootstrap.css">

  <script type="text/javascript" src="../JS/jquery.js"></script>
  <script src="../JS/bootstrap.js"></script>
</head>

<body>
<div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-left">
        <li class="active"><a href="home.php">Home</a></li>
        <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consulta<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="frmConsulta.php?tela=cadastrar">Cadastrar</a></li>
            <li><a href="conConsulta.php">Consultar</a></li>

            <li class="divider"></li>
          </ul>
        </li>
        <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Veterinário<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="frmVet.php?tela=cadastrar">Cadastrar</a></li>
            <li><a href="conVet.php">Consultar</a></li>

            <li class="divider"></li>
          </ul>
        </li>
        <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Produto<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="frmProduto.php?tela=cadastrar">Cadastrar</a></li>
            <li><a href="conProduto.php">Consultar</a></li>

            <li class="divider"></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Animal<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="frmAnimal.php?tela=cadastrar">Cadastrar</a></li>
            <li><a href="conAnimal.php">Consultar</a></li>

            <li class="divider"></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cliente<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="frmCliente.php?tela=cadastrar">Cadastrar</a></li>
            <li><a href="conCliente.php">Consultar</a></li>

            <li class="divider"></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Funcionário<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="frmFuncionario.php?tela=cadastrar">Cadastrar</a></li>
            <li><a href="conFuncionario.php">Consultar</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Banho e Tosa<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="frmbanhoEtosa.php?tela=cadastrar">Cadastrar</a></li>
            <li><a href="conbanhoEtosa.php">Consultar</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vendas<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="frmVendas.php?tela=cadastrar">Cadastrar</a></li>
            <li><a href="conVendas.php">Consultar</a></li>
          </ul>
        </li>
        </li>

      </ul>
    </div>
  <div class="container">
    <div class="row">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Busca</a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">

              <form class="form-inline" method="POST" action="">
                <fieldset>
                  <div class="form-group">
                    <input type="number" class="form-control" name="ibcod" placeholder="Codigo do Produto">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="ibnome" placeholder="Nome do Produto">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btnPesq">
                      <i class="glyphicon glyphicon-search"> Pesquisar </i>
                    </button>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>

      <table cellpadding="0" cellspacing="0" class="table">
        <thead>
          <th>Codigo</th>
          <th>Nome</th>
          <th>Descricao</th>
          <th>Preco</th>
          <th>Status</th>
          <th>Ações</th>
        </thead>
        <tbody>
          <?php 
					$link = conectar();
					$condicao = "";
					$and = null;
					if(isset($_POST['btnPesq'])){
						if($_POST['ibnome'] != NULL || $_POST['ibcod'] != NULL){
							$condicao = " WHERE ";
							if($_POST['ibnome'] != NULL){
								$condicao .= " nome LIKE '%". $_POST['ibnome'] ."%'";
								$and = true;
							}
							if($_POST['ibcod'] != NULL){
								if($and){
									$condicao .= " AND codigo_prod = ". $_POST['ibcod'] ;
								}else{
									$condicao .= " codigo_prod = ". $_POST['ibcod'] ;
								}
							}
						}
					}



					$sql = "SELECT * FROM produto " . $condicao;
					
					$res = mysqli_query($link,$sql);
					while ($dados = mysqli_fetch_array($res)){
						echo "<tr>";
						echo "<td>".$dados['codigo_prod']."</td>";
						echo "<td>".$dados['nome']."</td>";	
						echo "<td>".$dados['descr']."</td>";	
						echo "<td>".$dados['preco']."</td>";	
						if($dados['status']==1){
							echo "<td><spam>Ativo</spam></td>";
						}else{
							echo "<td><spam>Desativado</spam></td>";	
						}
						
						$id = base64_encode($dados['codigo_prod']);
						echo "<td><a href='frmProduto.php?tela=editar&id=".$id."' title='Editar Produto'> <spam class='glyphicon glyphicon-pencil'> </spam> </a>";
						echo "<a href='frmProduto.php?tela=excluir&id=".$id."' title='Excluir Produto'> <spam class='glyphicon glyphicon-remove'> </spam> </a>";
						echo "</td>";
						echo "</tr>";
					}
					desconectar($link);
					?>

        </tbody>

      </table>
    </div>
  </div>



</body>

</html>