<?php
echo "<a href=adicionar_1_formulario.php>ADICIONAR</a><br>";
echo "<a href=excluir_1.php?v_codigo=0>DROPALL</a><br>";
?>
<form action="consultar.php" method="get">
	<table>
		<tr>
			<td>Codigo:</td>
			<td><input type="number" name="f_codigo"></td>
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

<?php
try {
	$conexao = new PDO ( "mysql: host=localhost; dbname=persyos", "root", "12345678" ) or die ( "Erro ao conectar PDO MySQL!" );
	
	// Tambem pode se fazer dessa forma, mas aconselha-se o uso de prepare() e execute()
	// $result = $conexao->query("select * from pessoa");
	
	$result = $conexao->prepare ( "select * from pessoa" );
	$result->execute ();
	echo "<strong>Listagem PDO MySQL</strong><br>";
	
	try {
		$link = new PDO ( "mysql: host=localhost; dbname=persyos", "root", "12345678" );
		$result = $link->prepare ( "select * from pessoa" );
		$result->execute ();
		
		?>
<table>
		<?php
		foreach ( $result->fetchAll () as $rows ) {
			?><tr>
		<td>XXXXXXXXXXXXX</td>
		<td>XXXXXXXXXXXXX</td>
	</tr>
	<tr>
		<td>Codigo</td>
		<td><?php echo $rows ['codigo']; ?></td>
	</tr>
	<tr>
		<td>Nome</td>
		<td><?php echo $rows ['nome']; ?></td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td><?php echo $rows ['email']; ?></td>
	</tr>
	<tr>
		<td>Telefone</td>
		<td><?php echo $rows ['telefone']; ?></td>
	</tr>
	<tr>
		<td><?php echo "<a href=excluir_1.php?v_codigo=" . $rows ['codigo'] . ">EXCLUIR</a>"; ?></td>
	</tr>
	<tr>
		<td><?php echo "<a href=atualizar_1_formulario.php?v_codigo=" . $rows ['codigo'] . ">ALTERAR</a>"; ?></td>
	</tr>
	<?php
		}
		?>
	
</table>
<?php
		$link = null;
	} catch ( PDOException $exp ) {
		echo $exp->getMessage ();
	}
	
	?>
<table>
	<?php
	foreach ( $result->fetchAll () as $rows ) {
		?><tr>
		<td>XXXXXXXXXXXXX</td>
		<td>XXXXXXXXXXXXX</td>
	</tr><?php
		?><tr>
		<td>Codigo</td>
		<td><?php echo $rows ['codigo']; ?></td>
	</tr><?php
		?><tr>
		<td>Nome</td>
		<td><?php echo $rows ['nome']; ?></td>
	</tr><?php
		?><tr>
		<td>E-mail</td>
		<td><?php echo $rows ['email']; ?></td>
	</tr><?php
		?><tr>
		<td>Telefone</td>
		<td><?php echo $rows ['telefone']; ?></td>
	</tr><?php
		echo "<a href=excluir_1.php?v_codigo=" . $rows ['codigo'] . ">EXCLUIR</a><br>";
		echo "<a href=atualizar_1_formulario.php?v_codigo=" . $rows ['codigo'] . ">ALTERAR</a><p>";
	}
	?>
	</table>
<?php
	$conexao = null;
	echo ".<br/>";
	echo "..<br/>";
	echo "...<br/>";
} catch ( PDOException $exp ) {
	echo "Erro! " . $exp->getMessage ();
	die ();
}

/*
 * echo "<p><strong>Listagem MySQLi</strong><br>";
 * unset($rows);
 *
 * $conexao = mysqli_connect("localhost","root","","persyos") or die("Erro ao conectar MySQLi!");
 * $db = mysqli_select_db($conexao, "persyos") or die("DB inexistente ou corrompido.");
 * $result = mysqli_query($conexao, $query);
 * while ( $rows = mysqli_fetch_assoc( $result ) ) {
 * echo $rows["nome"] . "<br>";
 * }
 * echo mysqli_close($conexao) . "<br>";
 *
 *
 * $conexao = new mysqli("localhost","root","","persyos") or die("Erro ao conectar PDO MySQLi!");
 * $result = $conexao->query($query);
 * echo "<p><strong>Listagem PDO MySQLi</strong><br>";
 * while ( $rows = mysqli_fetch_assoc($result) ) {
 * echo $rows["nome"] . "<br>";
 * }
 * echo $conexao->close();
 */
?>