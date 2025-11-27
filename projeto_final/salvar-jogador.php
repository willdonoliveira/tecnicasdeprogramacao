<?php
switch ($_REQUEST["acao"]) {
	case "cadastrar":
		$nome = $_POST["nome_jogador"];
		$altura = $_POST["altura_jogador"];
        $dt_nasc = $_POST["dt_nasc_jogador"];
		$categoria = $_POST["categoria_jogador"];
		$genero = $_POST["genero_jogador"];
		$posicao = $_POST["posicao_jogador"];
		$numero = $_POST["numero_jogador"];
		
	
		
		$sql = "INSERT INTO jogador (nome_jogador, altura_jogador, dt_nasc_jogador, categoria_jogador, genero_jogador, posicao_jogador, numero_jogador)
		VALUES('{$nome}', '{$altura}', '{$dt_nasc}', '{$categoria}', '{$genero}', '{$posicao}', '{$numero}')";

		$res = $conn->query($sql);

		if ($res==true){
			print "<script>alert('Cadastrou com sucesso!');</script>";
			print "<script>location.href='?page=listar-jogador';</script>";
		}else{
			print "<script>alert('Não cadastrou!');</script>";
			print "<script>location.href='?page=listar-jogador';</script>";
		}
		break;

		case 'editar':
			$nome = $_POST["nome_jogador"];
			$altura = $_POST["altura_jogador"];
            $dt_nasc = $_POST["dt_nasc_jogador"];
			$categoria = $_POST["categoria_jogador"];
			$genero = $_POST["genero_jogador"];
			$posicao = $_POST["posicao_jogador"];
			$numero = $_POST["numero_jogador"];

			$sql = "UPDATE jogador SET
						nome_jogador ='{$nome}',
						altura_jogador ='{$altura}',
						dt_nasc_jogador ='{$dt_nasc}',
						categoria_jogador ='{$categoria}',
						genero_jogador ='{$genero}',
						posicao_jogador ='{$posicao}',
						numero_jogador ='{$numero}'
					WHERE
						id_jogador=".$_REQUEST["id_jogador"];

			$res = $conn->query($sql);

		if ($res==true){
			print "<script>alert('Editado com sucesso!');</script>";
			print "<script>location.href='?page=listar-jogador';</script>";
		}else{
			print "<script>alert('Não foi possível editar!');</script>";
			print "<script>location.href='?page=listar-jogador';</script>";
		}
			break;

		case 'excluir':
			$sql = "DELETE FROM jogador WHERE id_jogador=".$_REQUEST["id_jogador"];
			$res = $conn->query($sql);

		if ($res==true){
			print "<script>alert('Excluído com sucesso com sucesso!');</script>";
			print "<script>location.href='?page=listar-jogador';</script>";
		}else{
			print "<script>alert('Não foi possível excluir!');</script>";
			print "<script>location.href='?page=listar-jogador';</script>";
		}
			break;
		}
?>