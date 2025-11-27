
<h1>Listar equipe</h1>
<?php 
    $sql = "SELECT * FROM equipe AS mo
    INNER JOIN jogador AS ma
    ON mo.jogador_id_jogador = ma.id_jogador";
    $res = $conn->query($sql);
    $qtd = $res->num_rows;

    if($qtd > 0){
        print"<p>Encontrou<b>$qtd</b resultados(s)</p>>";
        print"<table class='table table-bordered table-striped table hover'>";
         print"<tr>";
            print "<th>#</th>";
            print "<th>Nome do Jogador(a)</th>";
            print "<th>Nome da Equipe</th>";
            print "<th>Estado</th>";
            print "<th>Cidade</th>";
            print "<th>Ginásio</th>";
            print "<th>Ações</th>";
            print"</tr>";	
        while ($row = $res->fetch_object()){
            print"<tr>";
            print "<td>".$row->id_equipe."</td>";
            print "<td>".$row->nome_jogador."</td>";
            print "<td>".$row->nome_equipe."</td>";
            print "<td>".$row->estado_equipe."</td>";
            print "<td>".$row->cidade_equipe."</td>";
            print "<td>".$row->ginasio_equipe."</td>";
            print "<td>
                        <button onclick=\"location.href='?page=editar-equipe&id_equipe=".$row->id_equipe."';\" class='btn btn-primary'>Editar</button>

                         <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-equipe&acao=excluir&id_equipe=".$row->id_equipe."';}else{false;}\" class='btn btn-danger'>Excluir</button>
                 </td>";
            print"</tr>";
        }
         print"</table>";
    }else{
        print"Não encontrou resultados";
    }

?>
