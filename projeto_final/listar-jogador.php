<h1>Listar Jogador</h1>
<?php 
$sql = "SELECT * FROM jogador";

$res = $conn->query($sql);

$qtd = $res->num_rows;

if($qtd > 0){
    print"<p> Encontrou <b>$qtd</b> resultado(s)</p>";
    print"<table class ='table table-bordered table spired table-hover'>";
    print"<tr>";
    print"<th>#</th>";
    print"<th>Nome</th>";
    print"<th>Altura</th>";
    print"<th>Data de Nascimento</th>";
    print"<th>Categoria</th>";
    print"<th>Gênero</th>";
    print"<th>Posição</th>";
    print"<th>Número</th>";
    print"</tr>";
    while($row = $res ->fetch_object() ){
        print"<tr>";
        print"<td>".$row->id_jogador."</td>";
        print"<td>".$row->nome_jogador."</td>";
        print"<td>".$row->altura_jogador."</td>";
        print"<td>".$row->dt_nasc_jogador."</td>";
        print"<td>".$row->categoria_jogador."</td>";
        print"<td>".$row->genero_jogador."</td>";
        print"<td>".$row->posicao_jogador."</td>";
        print"<td>".$row->numero_jogador."</td>";
       print"<td>
		<button class='btn btn-success' onclick=\" location.href='?page=editar-jogador&id_jogador={$row->id_jogador}';\">Editar</button>

		<button class='btn btn-danger' onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-jogador&acao=excluir&id_jogador={$row->id_jogador}';}else{false;}\">Excluir</button>
		    </td>";
        print"</tr>";
        
    }
    print"</table>";
}else{
    print"<p>Não encontrou resultado(s)</p>";
}

?>
