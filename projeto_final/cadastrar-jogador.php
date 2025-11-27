<h1>Cadastrar jogador</h1>
<form action="?page=salvar-jogador" method="POST">
	<input type="hidden" name="acao" value="cadastrar">
	<div class="mb-3">
		<label>Nome
			<input type="text" name="nome_jogador" class="form-control">
		</label>
	</div>
	<div class="mb-3">
		<label>Altura(cm)
			<input type="text" name="altura_jogador" class="form-control">
		</label>
	</div>
	<div class="mb-3">
		<label>Data de Nascimento
			<input type="date" name="dt_nasc_jogador" class="form-control">
		</label>
	</div>
	<div class="mb-3">
		<label>Categoria
			<input type="text" name="categoria_jogador" class="form-control">
		</label>
	</div>
	<div class="mb-3">
		<label>Gênero
			<input type="text" name="genero_jogador" class="form-control">
		</label>
	</div>
	<div class="mb-3">
		<label>Posição
			<input type="text" name="posicao_jogador" class="form-control">
		</label>
	</div>
	<div class="mb-3">
		<label>Número
			<input type="number" name="numero_jogador" class="form-control">
		</label>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Enviar</button>
	</div>
</form>