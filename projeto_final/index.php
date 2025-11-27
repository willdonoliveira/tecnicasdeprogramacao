<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="widht-device-widht, initial-scale-1">
	<title>The Liga PRO</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">The Liga Pro</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="dark" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Jogador
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?page=cadastrar-jogador">Cadastrar</a></li>
            <li><a class="dropdown-item" href="?page=listar-jogador">Listar</a></li>
          </ul>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Equipe
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?page=cadastrar-equipe">Cadastrar</a></li>
            <li><a class="dropdown-item" href="?page=listar-equipe">Listar</a></li>
          </ul>
        </li>
         
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container mt-3">
  <div class="row">
    <div class="col">
      <?php
        include("config.php");
        
        switch (@$_REQUEST['page']) {
          //jogador
          case 'cadastrar-jogador':
          include('cadastrar-jogador.php');
            break;
          case 'listar-jogador':
          include('listar-jogador.php');
            break;
            case 'editar-jogador':
          include('editar-jogador.php');
            break;
            case 'salvar-jogador':
          include('salvar-jogador.php');
            break;

            //equipe
          case 'cadastrar-equipe':
          include('cadastrar-equipe.php');
            break;
          case 'listar-equipe':
          include('listar-equipe.php');
            break;
            case 'editar-equipe':
          include('editar-equipe.php');
            break;
            case 'salvar-equipe':
          include('salvar-equipe.php');
            break;

          default:
            // code...
            print"<h1>Seja bem vindo ao sistema da The Liga Pro</h1>";
        }
      ?>
      </div>
    </div>
  </div>

	<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>