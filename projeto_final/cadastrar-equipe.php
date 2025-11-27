<h1>Cadastrar equipe</h1>
<form action="?page=salvar-equipe" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
   <div class='mb-3'>
        <label >Nome do Jogador(a)</label>
        <select name="jogador_id_jogador" class="form-control">
            <option>- Escolha -</option>
            <?php 
                $sql = "SELECT * FROM jogador";
                $res = $conn->query($sql);
                if($res->num_rows > 0){
                    while($row = $res->fetch_object()){
                        print"<option value='".$row->id_jogador."'>".$row->nome_jogador."</option>";
                    }
                
                }else{
                    print"<option>Não há jogadores(as) cadastradas</option>";
                }
            ?>
             </select>
  
    </div>
    <div class='mb-3'>
        <label >Nome da Equipe</label>
        <input type="text" name="nome_equipe" class="form-control">
    </div>
    <div class='mb-3'>
        <label >Estado</label>
        <input type="text" name="estado_equipe" class="form-control">
    </div>
    <div class='mb-3'>
        <label >Cidade</label>
        <input type="text" name="cidade_equipe" class="form-control">
    </div>
    <div class='mb-3'>
        <label >Ginásio</label>
        <input type="text" name="ginasio_equipe" class="form-control">
    </div>
        <button type="submit" class="btn btn-success">Enviar</button>
    </div>
</form>