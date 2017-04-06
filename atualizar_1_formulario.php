<html>
<head>
<title>Atualizar 1 - Formulario</title>
</head>
<body>
		<?php
		try {
			if ($_SERVER ['REQUEST_METHOD'] == 'GET') {
				if (isset ( $_GET ['v_codigo'] )) {
					$codigo = $_GET ['v_codigo'];
					$conn = new PDO ( "mysql: host=localhost; dbname=persyos", "root", "12345678" );
					$query = "select * from pessoa where codigo = :codigo";
					$result = $conn->prepare ( $query );
					$result->execute ( [ 
							':codigo' => $codigo 
					] );
					foreach ( $result->fetchAll () as $rows ) {
						echo "Codigo: " . $rows ['codigo'] . "<br>";
						echo "Nome: " . $rows ['nome'] . "<br>";
						echo "Email: " . $rows ['email'] . "<br>";
						echo "Telefone: " . $rows ['telefone'] . "<br>";
					}
				}
			} else {
				echo "Metodo diferente de GET.";
				echo "<a href=exibirRegistros.php>MENU</a>";
				exit ();
			}
		} catch ( PDOException $exp ) {
			echo $exp->getMessage ();
		}
		?>
		<p>
		<strong>Insira os novos dados:</strong>
	
	
	<form action="atualizar_2_validacao.php" method="get">
		<table>
			<tr>
				<td><input type="hidden" name="f_codigo"
					value=<?php echo  $codigo ?>></td>
			</tr>
			<tr>
				<td>Nome:</td>
				<td><input type="text" name="f_nome"></td>
			</tr>
			<tr>
				<td>E-mail:</td>
				<td><input type="text" name="f_email"></td>
			</tr>
			<tr>
				<td>Telefone:</td>
				<td><input type="number" name="f_telefone"></td>
			</tr>
			<tr>
				<td><input type="submit" name="Enviar"></td>
				<td><input type="reset" name="Limpar"></td>
			</tr>
		</table>
	</form>
</body>
</html>