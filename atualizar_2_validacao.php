<?php
try {
	$conn = new PDO ( "mysql: host=localhost; dbname=persyos", "root", "12345678" ) or die ( "Erro ao conectar" );
	if (isset ( $_GET ['f_codigo'] ))
		$codigo = $_GET ['f_codigo'];
	
	if (isset ( $_GET ['f_nome'] ) && $_GET ['f_nome'] != null) {
		$nome = $_GET ['f_nome'];
		$query_nome = "update pessoa set nome = :nome where codigo = :codigo";
		$result = $conn->prepare ( $query_nome );
		$result->execute ( [ 
				':nome' => $nome,
				':codigo' => $codigo 
		] );
	}
	
	if (isset ( $_GET ['f_email'] ) && $_GET ['f_email'] != null) {
		$email = $_GET ['f_email'];
		$query_email = "update pessoa set email = :email where codigo = :codigo";
		$result = $conn->prepare ( $query_email );
		$result->execute ( [ 
				':email' => $email,
				':codigo' => $codigo 
		] );
	}
	
	if (isset ( $_GET ['f_telefone'] ) && $_GET ['f_telefone'] != null) {
		$telefone = $_GET ['f_telefone'];
		$query_telefone = "update pessoa set telefone = :telefone where codigo = :codigo";
		$result = $conn->prepare ( $query_telefone );
		$result->execute ( [ 
				':telefone' => $telefone,
				':codigo' => $codigo 
		] );
	}
	
	$query = "select * from pessoa";
	$result = $conn->prepare ( $query );
	$result->execute ();
	foreach ( $result->fetchAll () as $rows ) {
		echo "Codigo: " . $rows ['codigo'] . "<br>";
		echo "Nome: " . $rows ['nome'] . "<br>";
		echo "Email: " . $rows ['email'] . "<br>";
		echo "Telefone: " . $rows ['telefone'] . "<br>";
	}
	
	echo "Editado!";
	$conn = null;
} catch ( PDOException $e ) {
	print "Error!: " . $e->getMessage () . "<br/>";
	die ( "Continue tentando." );
}

echo "<br><a href=exibirRegistros.php>Menu</a>";
?>