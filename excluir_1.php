<?php
	$conn = new PDO("mysql: host=localhost; dbname=persyos", "root", "12345678") or die("Erro de conexao.");
	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		$codigo = $_GET['v_codigo'];
		switch ( $codigo ) {
			case 0:
				$statement = "TRUNCATE TABLE pessoa";
				$query = $conn->prepare($statement);
				$query->execute();
				echo "<br>Todos os registros foram excluidos.";
				break;
			default:
				$statement = "delete from pessoa where codigo = :codigo";
				$query = $conn->prepare($statement);
				$query->execute([':codigo' => $codigo]);
				echo "<br>Pessoa excluida.";
				break;
		}
	}
	else echo "<p>Metodo diferente de GET.";
	$conn = null;
	echo "<br><a href=exibirRegistros.php>Menu</a>";
?>