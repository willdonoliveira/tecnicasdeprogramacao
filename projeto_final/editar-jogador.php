<h1>Editar Jogador</h1>
<?php 
$sql = "SELECT * FROM jogador WHERE id_jogador=".$_REQUEST["id_jogador"];
$res = $conn->query($sql);
$row = $res->fetch_object();
?>
<form action="?page=salvar-jogador" method="POST">
	<input type="hidden" name="acao" value="editar">
	<input type="hidden" name="id_jogador" value="<?php print $row->id_jogador; ?>">
	<div class="mb-3">
		<label>Nome
			<input type="text" name="nome_jogador" class="form-control"  value="<?php print $row->nome_jogador; ?>">
		</label>
	</div>
	<div class="mb-3">
		<label>Altura
			<input type="text" name="altura_jogador" class="form-control"  value="<?php print $row->altura_jogador; ?>">
		</label>
	</div>
    <div class="mb-3">
		<label>Data de Nascimento
			<input type="text" name="dt_nasc_jogador" class="form-control" value= "<?php print $row->dt_nasc_jogador; ?>">
		</label>
	</div>
	<div class="mb-3">
		<label>Categoria
			<input type="text" name="categoria_jogador" class="form-control" value="<?php print $row->categoria_jogador; ?>">
		</label>
	</div>
	<div class="mb-3">
		<label>Gênero
			<input type="text" name="genero_jogador" class="form-control" value= "<?php print $row->genero_jogador; ?>">
		</label>
	</div>
	<div class="mb-3">
		<label>Posição
			<input type="text" name="posicao_jogador" class="form-control" value= "<?php print $row->posicao_jogador; ?>">
		</label>
	</div>
	<div class="mb-3">
		<label>Número
			<input type="text" name="numero_jogador" class="form-control" value= "<?php print $row->numero_jogador; ?>">
		</label>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Enviar</button>
	</div>
</form>