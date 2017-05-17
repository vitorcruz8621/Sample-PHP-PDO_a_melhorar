<?php
$conn = new PDO ( "mysql: host=localhost; dbname=persyos", "root", "12345678" ) or die ( "erro ao conectar." );
$query_all = "";

$b_codigo = false;
$b_nome = false;
$b_email = false;
$b_telefone = false;

if ($_SERVER ['REQUEST_METHOD'] == "GET") {
	if (isset ( $_GET ['f_codigo'] ) && $_GET ['f_codigo'] != null) {
		$GLOBALS ['b_codigo'] = true;
	}
	if (isset ( $_GET ['f_nome'] ) && $_GET ['f_nome'] != null) {
		$GLOBALS ['b_nome'] = true;
	}
	if (isset ( $_GET ['f_email'] ) && $_GET ['f_email'] != null) {
		$GLOBALS ['b_email'] = true;
	}
	if (isset ( $_GET ['f_telefone'] ) && $_GET ['f_telefone'] != null) {
		$GLOBALS ['b_telefone'] = true;
	}
	
	if (($GLOBALS ['b_codigo'] || $GLOBALS ['b_nome'] || $GLOBALS ['b_email'] || $GLOBALS ['b_telefone']) == true) {
		if ($GLOBALS ['b_codigo'] == true) {
			$GLOBALS ['query_all'] = " codigo = :codigo";
		}
		
		if ($GLOBALS ['b_nome'] == true && $GLOBALS ['b_codigo'] == true) {
			$GLOBALS ['query_all'] += " and nome like :nome";
		} else if ($GLOBALS ['b_nome'] == true && $GLOBALS ['b_codigo'] == false) {
			$GLOBALS ['query_all'] = " nome like :nome";
		} else {
		}
		
		if ($GLOBALS ['b_email'] == true && ($GLOBALS ['b_nome'] || $GLOBALS ['b_codigo']) == true) {
			$GLOBALS ['query_all'] += " and email like :email";
		} else if ($GLOBALS ['b_email'] == true && ($GLOBALS ['b_nome'] || $GLOBALS ['b_codigo']) == false) {
			$GLOBALS ['query_all'] = " email like :email";
		} else {
		}
		
		if ($GLOBALS ['b_telefone'] == true && ($GLOBALS ['b_nome'] || $GLOBALS ['b_codigo'] || $GLOBALS ['b_email']) == true) {
			$GLOBALS ['query_all'] += " and telefone = :telefone";
		} else if ($GLOBALS ['b_telefone'] == true && ($GLOBALS ['b_nome'] || $GLOBALS ['b_codigo'] || $GLOBALS ['b_email']) == false) {
			$GLOBALS ['query_all'] = " telefone = :telefone";
		} else {
		}
		
		$gob = $GLOBALS ['query_all'];
		$q = "select * from pessoa where " . $gob;
		$array = array ();
		$query = $conn->prepare ( $q );
		
		if (! empty ( $_GET ['f_codigo'] )) {
			$query->bindParam ( ':codigo', $_GET ['f_codigo'], PDO::PARAM_INT );
			$array += [ 
					':codigo' => $_GET ['f_codigo'] 
			];
		}
		if (! empty ( $_GET ['f_nome'] )) {
			$query->bindParam ( ':nome', $_GET ['f_nome'], PDO::PARAM_STR );
			$array += [ 
					':nome' => "%" . $_GET ['f_nome'] . "%"
			];
		}
		if (! empty ( $_GET ['f_email'] )) {
			$query->bindParam ( ':email', $_GET ['f_email'], PDO::PARAM_STR );
			$array += [ 
					':email' => "%" . $_GET ['f_email'] . "%"
			];
		}
		if (! empty ( $_GET ['f_telefone'] )) {
			$query->bindParam ( ':telefone', $_GET ['f_telefone'], PDO::PARAM_INT );
			$array += [ 
					':telefone' => $_GET ['f_telefone'] 
			];
		}
		
		$query->execute ( $array );
		
		echo "<strong>Resultado da Consulta</strong>";
		foreach ( $query->fetchAll () as $rows ) {
			echo "<p>Codigo: " . $rows ['codigo'];
			echo "<br>Nome: " . $rows ['nome'];
			echo "<br>Email: " . $rows ['email'];
			echo "<br>Telefone: " . $rows ['telefone'];
		}
	} else
		echo "Campos do formulario estao em branco.";
} else
	echo "<br>Metodo diferente de GET.";

echo "<br><a href=index.php>Menu</a>";
$conn = null;

?>