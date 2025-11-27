<?php 
    switch ($_REQUEST["acao"]){
        case 'cadastrar':
        $nome = $_POST["nome_equipe"];
        $estado = $_POST["estado_equipe"];
		$cidade = $_POST["cidade_equipe"];
		$ginasio = $_POST["ginasio_equipe"];
		$jogador = $_POST["jogador_id_jogador"];
		
		$sql = "INSERT INTO equipe (nome_equipe, estado_equipe, cidade_equipe, ginasio_equipe, jogador_id_jogador)
		VALUES('{$nome}', '{$estado}', '{$cidade}', '{$ginasio}', {$jogador})";

		$res = $conn->query($sql);

		if ($res==true){
			print "<script>alert('Cadastrou com sucesso!');</script>";
			print "<script>location.href='?page=listar-equipe';</script>";
		}else{
			print "<script>alert('Não cadastrou!');</script>";
			print "<script>location.href='?page=listar-equipe';</script>";
		}
         break;

         //EDITAR
        case 'editar':
        $nome = $_POST["nome_equipe"];
        $estado = $_POST["estado_equipe"];
		$cidade = $_POST["cidade_equipe"];
		$ginasio = $_POST["ginasio_equipe"];
		$jogador = $_POST["jogador_id_jogador"];
		
		$sql = "UPDATE equipe SET nome_equipe='{$nome}', estado_equipe='{$estado}', cidade_equipe='{$cidade}', ginasio_equipe='{$ginasio}', jogador_id_jogador={$jogador} WHERE id_equipe=".$_REQUEST['id_equipe'];

		$res = $conn->query($sql);

		if ($res==true){
			print "<script>alert('Editou com sucesso!');</script>";
			print "<script>location.href='?page=listar-equipe';</script>";
		}else{
			print "<script>alert('Não editou!');</script>";
			print "<script>location.href='?page=listar-equipe';</script>";
		}
         break;
        case 'excluir':
           $sql = "DELETE FROM equipe WHERE id_equipe=".$_REQUEST['id_equipe'];

           $res = $conn->query($sql);

		if ($res==true){
			print "<script>alert('Excluiu com sucesso!');</script>";
			print "<script>location.href='?page=listar-equipe';</script>";
		}else{
			print "<script>alert('Não foi possível!');</script>";
			print "<script>location.href='?page=listar-equipe';</script>";
		}
            break;
    }
?>
