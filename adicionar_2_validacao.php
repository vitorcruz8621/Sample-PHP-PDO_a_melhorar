<?php
$conexao = new PDO ( "mysql: host=localhost; dbname=persyos", "root", "12345678" ) or die ( "Erro ao conectar PDO MySQL!" );

if ($_SERVER ['REQUEST_METHOD'] == "GET") {
	//  ****************************Metodo de Inser��o***************************
	$query = "insert into pessoa(nome, email, telefone) values ( :nome, :email, :telefone)";
	$result = $conexao->prepare ( $query );
	$result->execute ( [ 
			'nome' => $_GET ['f_nome'],
			'email' => $_GET ['f_email'],
			'telefone' => $_GET ['f_telefone'] 
	] );
	$result = null;
	echo "Inserido com sucesso!<br>";
	echo "<a href=index.php>MENU</a>";
} else {
	die ( "M�todo diferente de GET!" );
}
$conexao = null;
?>