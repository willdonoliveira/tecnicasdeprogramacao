<h1>Editar Equipe</h1>
<?php 
    $sql_1 = "SELECT * FROM equipe WHERE id_equipe=".$_REQUEST["id_equipe"];
    $res_1 = $conn->query($sql_1);
    $row_1 = $res_1->fetch_object();
?>
<form action="?page=salvar-equipe" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    <input type="hidden" name="id_equipe" value="<?php print $row_1->id_equipe; ?>">
   <div class='mb-3'>
        <label >Nome do Jogador(a)</label>
        <select name="jogador_id_jogador" class="form-control">
            <option>- Escolha -</option>
            <?php 
                $sql = "SELECT * FROM jogador";
                $res = $conn->query($sql);
                if($res->num_rows > 0){
                    while($row = $res->fetch_object()){
                         if($row_1->jogador_id_jogador==$row->id_jogador){
                     print"<option value='".$row->id_jogador."' selected >".$row->nome_jogador."</option>";
                    }else{
                    print"<option value='".$row->id_jogador."'>".$row->nome_jogador."</option>";
                }
                    }
                
                }else{
                    print"<option>Não há jogadores(as) cadastradas</option>";
                }
            ?>
             </select>
    </div>
    <div class='mb-3'>
        <label >Nome da Equipe</label>
        <input type="text" name="nome_equipe" value="<?php print $row_1->nome_equipe; ?>"class="form-control">
    </div>
    <div class='mb-3'>
        <label >Estado</label>
        <input type="text" name="estado_equipe" value="<?php print $row_1->estado_equipe; ?>"class="form-control">
    </div>
    <div class='mb-3'>
        <label >Cidade</label>
        <input type="text" name="cidade_equipe" value="<?php print $row_1->cidade_equipe; ?>"class="form-control">
    </div>
    <div class='mb-3'>
        <label >Ginásio</label>
        <input type="text" name="ginasio_equipe" value="<?php print $row_1->ginasio_equipe; ?> "class="form-control">
    </div>
        <button type="submit" class="btn btn-success">Enviar</button>
    </div>
</form>