<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<meta charset="UTF8"/>
	<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.css">
	
	<script type="text/javascript" src="../JS/jquery.js"></script>
	<script src="../JS/bootstrap.js"></script>

	
</head>
<body>
	<div class="navbar navbar-default" role="navigation">
	    <div class="container">
			<div class="navbar-collapse collapse">

			    <ul class="nav navbar-nav navbar-left">
						<li class="active"><a href="home.php">Home</a></li>
						<li class="dropdown ">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consulta<b class="caret"></b></a>
						    <ul class="dropdown-menu">
						    </ul>
						</li>			
						<li class="dropdown ">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Produto<b class="caret"></b></a>
						    <ul class="dropdown-menu">

							<li class="divider"></li>
						    </ul>
						</li>
						<li class="dropdown">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Animal<b class="caret"></b></a>
						    <ul class="dropdown-menu">
							<li class="divider"></li>
						    </ul>
						</li>

						<li class="dropdown">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cliente<b class="caret"></b></a>
						    <ul class="dropdown-menu">
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
						    </ul>
						</li>

						<li class="dropdown">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vendas<b class="caret"></b></a>
						    <ul class="dropdown-menu">
						    </ul>
						</li>

							<li class="dropdown">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Produtos<b class="caret"></b></a>
						    <ul class="dropdown-menu">
						    </ul>
						</li>
						
				    </ul>

			</div><!--/.nav-collapse -->
	    </div>
	</div>
	<div class="container">
		<div class="row">
			<form class="form-horizontal" method="" action="">
				<fieldset>
					<div class="form-group">
				        <label class="control-label col-xs-2">Nome</label>
				        <div class="col-xs-5">
				            <input type="text" class="form-control" required name="inome" placeholder="Nome Completo" value="">
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="control-label col-xs-2">CPF</label>
				        <div class="col-xs-5">
				            <input type="number" class="form-control" min="1" required name="icpf" placeholder="CPF" value="">
							<input type="hidden" name="icod" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>"/>
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="control-label col-xs-2">Telefone</label>
				        <div class="col-xs-5">
				            <input type="number" class="form-control"  min="1" required name="itel" placeholder="Telefone" value="">
				        </div>
				    </div>
				    <div class="form-group">
				        <label class="control-label col-xs-2">Email</label>
				        <div class="col-xs-5">
				            <input type="email" class="form-control" required name="iemail" placeholder="Email" value="">
				        </div>
				    </div>
				    <div class="form-group" id="senha">
				        <label class="control-label col-xs-2">Senha</label>
				        <div class="col-xs-5">
				            <input type="password" class="form-control" required name="ipassword" placeholder="Senha">
				        </div>
				    </div>
				    <div class="form-group">
				        <div class="col-xs-offset-2 col-xs-5">
				            <div class="checkbox">
				                <label><input type="checkbox" name="cstatus">Ativar</label>
				            </div>
				        </div>
				    </div>
				    <div class="form-group">
				        <div class="col-xs-offset-2 col-xs-10">
				            <button type="submit" class="btn btn-primary" name="btnCad"><?php echo ucfirst($_GET['tela']); ?></button>
				        </div>
				    </div>
			    </fieldset>

				<div class="alert mt-2 text-center" role="alert" style="display: none; margin-top: 10px;"></div>
			</form>
		</div>
	</div>
	

</body>
</html>