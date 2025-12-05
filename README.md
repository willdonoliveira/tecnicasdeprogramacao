# Técnicas de Programação
## Este repositório é constituído de atividades da disciplina Técnicas de Programação do curso Bacharelado em Engenharia de Software do aluno Willdon Oliveira da Silva.

### Projeto Desenvolvido com Aplicação CRUD. Encontra-se dentro da pasta "projeto_final" o trabalho desenvolvido.
Este projeto consiste em um Sistema de Gerenciamento de Campeonato desenvolvido em PHP com MySQL, implementando operações CRUD (Create, Read, Update, Delete) para gerenciamento de:

Jogadores: Cadastro, listagem, edição e exclusão de jogadores

Equipes: Cadastro, listagem, edição e exclusão de equipes 

### Estrutura CRUD Implementada
Para cada módulo, foram implementadas as quatro operações básicas:

CREATE (Criar): Formulários de cadastro que inserem novos registros no banco de dados
READ (Ler): Páginas de listagem que exibem todos os registros cadastrados
UPDATE (Atualizar): Formulários de edição que modificam registros existentes
DELETE (Deletar): Funcionalidade que remove registros do banco de dados

## Pseudocódigo

    INÍCIO
    CONECTAR ao banco de dados MySQL (via config.php)
    RECEBER parâmetro 'page' da URL 

    SWITCH (página solicitada)
        // Módulos Jogador (CRUD Simples)
        CASO 'cadastrar-jogador': INCLUIR arquivo cadastrar-jogador.php
        CASO 'listar-jogador': INCLUIR arquivo listar-jogador.php
        CASO 'editar-jogador': INCLUIR arquivo editar-jogador.php
        CASO 'salvar-jogador': // Responsável por CREATE, UPDATE, DELETE 
            INCLUIR arquivo salvar-jogador.php
                
        // Módulos Equipe (CRUD com Vínculo)
        CASO 'cadastrar-equipe': INCLUIR arquivo cadastrar-equipe.php
        CASO 'listar-equipe': INCLUIR arquivo listar-equipe.php
        CASO 'editar-equipe': INCLUIR arquivo editar-equipe.php
        CASO 'salvar-equipe': // Responsável por CREATE, UPDATE, DELETE
            INCLUIR arquivo salvar-equipe.php

        CASO PADRÃO: EXIBIR mensagem de boas-vindas
    FIM SWITCH
    FIM
## Módulo 1: Jogador (CRUD Simples)
Módulo dedicado ao gerenciamento dos dados dos jogadores.

## Pseudocódigo - Operação de Cadastro de Jogadores (salvar-jogador.php)


    INÍCIO
    CONECTAR ao banco de dados MySQL 
    RECEBER ação do formulário 
    
    SE ação = "cadastrar" ENTÃO 
        RECEBER nome_jogador, altura_jogador, dt_nasc_jogador, categoria_jogador, genero_jogador, posicao_jogador, numero_jogador do formulário 
        
        CRIAR comando SQL: INSERT INTO jogador (...) VALUES (...)
        EXECUTAR comando SQL
        
        SE comando executado com sucesso ENTÃO
            EXIBIR mensagem: "Cadastrou com sucesso!" 
            REDIRECIONAR para página de listagem de jogadores 
        SENÃO 
            EXIBIR mensagem: "Não Cadastrou!" 
            REDIRECIONAR para página de listagem de jogadores 
        FIM SE 
    FIM SE 
    FIM
## Pseudocódigo - Operação de Listagem de Jogadores (listar-jogador.php)


    INÍCIO
    CONECTAR ao banco de dados MySQL 
    CRIAR comando SQL: SELECT * FROM jogador 
    EXECUTAR consulta SQL 
    OBTER quantidade de resultados 
    
    SE quantidade > 0 ENTÃO 
        EXIBIR tabela com cabeçalhos 
        ENQUANTO houver registros FAÇA 
            EXIBIR ID, nome e todos os outros campos 
            EXIBIR botões de ação (Editar/Excluir) 
            AVANÇAR para próximo registro 
        FIM ENQUANTO 
        FECHAR tabela 
    SENÃO 
        EXIBIR mensagem: "Não encontrou resultado" 
    FIM SE 
    FIM
## Pseudocódigo - Operação de Edição de Jogador (editar-jogador.php & salvar-jogador.php)


    INÍCIO
    CONECTAR ao banco de dados MySQL 
    RECEBER id_jogador da URL (para buscar dados) 
    
    // 1. Edição (Formulário)
    CRIAR comando SQL: SELECT * FROM jogador WHERE id_jogador = ID 
    EXECUTAR consulta SQL 
    OBTER dados do jogador (para preencher o formulário) 
    
    // 2. Salvamento (Ação)
    RECEBER ação do formulário 
    
    SE ação = "editar" ENTÃO 
        RECEBER dados atualizados do formulário (nome_jogador, altura_jogador, etc.) 
        CRIAR comando SQL: UPDATE jogador SET campo1=valor1, ... WHERE id_jogador = ID 
        EXECUTAR comando SQL 
        
        SE comando executado com sucesso ENTÃO
            EXIBIR mensagem: "Editou com sucesso!" 
            REDIRECIONAR para página de listagem de jogadores 
        SENÃO 
            EXIBIR mensagem: "Não foi possível editar!" 
            REDIRECIONAR para página de listagem de jogadores 
        FIM SE 
    FIM SE 
    FIM
## Pseudocódigo - Operação de Exclusão de Jogador (salvar-jogador.php)


    INÍCIO
    CONECTAR ao banco de dados MySQL 
    RECEBER ação = "excluir" e id_jogador da URL 
    
    CRIAR comando SQL: DELETE FROM jogador WHERE id_jogador = ID 
    EXECUTAR comando SQL 
    
    SE comando executado com sucesso ENTÃO
        EXIBIR mensagem: "Excluiu com sucesso!" 
        REDIRECIONAR para página de listagem de jogadores 
    SENÃO 
        EXIBIR mensagem: "Não foi possível excluir!" 
        REDIRECIONAR para página de listagem de jogadores 
    FIM SE 
    FIM
## Módulo 2: Equipe (CRUD com Vínculo)
Módulo para gerenciar equipes, que possuem uma chave estrangeira (jogador_id_jogador) referenciando a tabela jogador.

## Algoritmo 1: Cadastrar Equipe (salvar-equipe.php)


    ALGORITMO cadastrar_equipe 
    VAR 
    nome_equipe, estado_equipe, cidade_equipe, ginasio_equipe, sql: TEXTO 
    jogador_id_jogador: INTEIRO 
    res: BOOLEANO 
     INÍCIO 
    // Receber dados do formulário 
    nome_equipe <- $_POST['nome_equipe'] 
    [...] 
    jogador_id_jogador <- $_POST['jogador_id_jogador'] 
    
    // Construir e Executar comando SQL 
    sql <- "INSERT INTO equipe (..., jogador_id_jogador) VALUES (..., " + jogador_id_jogador + ")" 
    res <- conn->query(sql) 
    
    SE res = VERDADEIRO ENTÃO 
        ESCREVA "Equipe cadastrada com sucesso!" 
        REDIRECIONAR para '?page=listar-equipe' 
    SENÃO 
        ESCREVA "Não foi possível cadastrar a equipe!" 
        REDIRECIONAR para '?page=listar-equipe' 
    FIM SE 
    FIM
## Algoritmo 2: Listar Equipes (Com JOIN) (listar-equipe.php)

    É utilizada uma operação INNER JOIN para exibir o nome completo do jogador vinculado.

    ALGORITMO listar_equipes 
    VAR 
    sql: TEXTO 
    res: RESULTADO 
    qtd: INTEIRO 
    INÍCIO 
    // SQL com JOIN para buscar o nome do jogador vinculado 
    sql <- "SELECT eq.*, jg.nome_jogador 
            FROM equipe AS eq 
            INNER JOIN jogador AS jg 
            ON eq.jogador_id_jogador = jg.id_jogador" 
    
    // Executar consulta e verificar resultados 
    res <- conn->query(sql) 
    qtd <- res->num_rows 
    
    SE qtd > 0 ENTÃO 
        EXIBIR início da tabela e cabeçalhos (incluindo "Nome do Jogador") 
        ENQUANTO res->fetch_object() FAÇA 
            EXIBIR dados (incluindo row->nome_jogador via JOIN) 
            EXIBIR botões de ação (Editar/Excluir) 
        FIM ENQUANTO 
        FECHAR tabela 
    SENÃO 
        ESCREVA "Não encontrou resultado." 
    FIM SE 
    FIM
## Pseudocódigo - Operação de Edição de Equipe (salvar-equipe.php - caso 'editar')


    INÍCIO 
    CONECTAR ao banco de dados MySQL 
    RECEBER id_equipe e dados atualizados do formulário (incluindo NOVO jogador_id_jogador) 
    
    SE ação = "editar" ENTÃO 
        CRIAR comando SQL: UPDATE equipe SET nome_equipe=valor, jogador_id_jogador=NOVO_ID, ... WHERE id_equipe = ID 
        EXECUTAR comando SQL 
        
        SE comando executado com sucesso ENTÃO
            EXIBIR mensagem: "Editou equipe com sucesso!" 
            REDIRECIONAR para página de listagem de equipes 
        SENÃO 
            EXIBIR mensagem: "Não foi possível editar equipe!" 
            REDIRECIONAR para página de listagem de equipes 
        FIM SE 
    FIM SE 
    FIM
## Pseudocódigo - Operação de Exclusão de Equipe (salvar-equipe.php - caso 'excluir')


    INÍCIO
    CONECTAR ao banco de dados MySQL 
    RECEBER ação = "excluir" e id_equipe da URL 
    
    CRIAR comando SQL: DELETE FROM equipe WHERE id_equipe = ID 
    EXECUTAR comando SQL 
    
    SE comando executado com sucesso ENTÃO
        EXIBIR mensagem: "Excluiu equipe com sucesso!" 
        REDIRECIONAR para página de listagem de equipes 
    SENÃO 
        EXIBIR mensagem: "Não foi possível excluir equipe! (Verificar restrições de Chave Estrangeira)" 
        REDIRECIONAR para página de listagem de equipes 
    FIM SE 
    FIM

## Fluxograma - Operação CRUD Completa de Funcionário

                    ┌─────────────┐
                    │   INÍCIO    │
                    └──────┬──────┘
                           │
                           ▼
                    ┌──────────────────┐
                    │  CONECTAR AO BD  │
                    └──────┬───────────┘
                           │
                           ▼
                    ┌────────────────────┐
                    │ RECEBER AÇÃO (page)│
                    └──────┬─────────────┘
                           │
        ┌──────────────────┼──────────────────┐
        │                  │                  │
        ▼                  ▼                  ▼
    ┌────────┐        ┌────────┐        ┌────────┐
    │CADASTRO│        │ LISTAR │        │ EDITAR │
    └───┬────┘        └───┬────┘        └───┬────┘
        │                 │                 │
        ▼                 ▼                 ▼
    ┌─────────────┐  ┌─────────────┐  ┌─────────────┐
    │ RECEBER     │  │ SELECT *    │  │ SELECT pelo │
    │ DADOS FORM  │  │ FROM        │  │ ID          │
    └──────┬──────┘  └──────┬──────┘  └──────┬──────┘
           │                │                 │
           ▼                ▼                 ▼
    ┌─────────────┐  ┌─────────────┐  ┌─────────────┐
    │ INSERT INTO │  │ EXIBIR      │  │ RECEBER     │
    │ TABLE       │  │ TABELA      │  │ DADOS FORM  │
    └──────┬──────┘  └──────┬──────┘  └──────┬──────┘
           │                │                 │
           ▼                ▼                 ▼
    ┌─────────────┐         │          ┌─────────────┐
    │ SUCESSO?    │         │          │ UPDATE SET  │
    └───┬─────┬───┘         │          └──────┬──────┘
        │SIM  │NÃO          │                 │
        │     │             │                 ▼
        │     │             │          ┌─────────────┐
        │     │             │          │ SUCESSO?    │
        │     │             │          └───┬─────┬───┘
        │     │             │          SIM │     │ NÃO
        │     │             │              │     │
        ▼     ▼             ▼              ▼     ▼
      ┌──────────┐      ┌────────┐    ┌──────────┐
      │MENSAGEM  │      │EXIBIR  │    │MENSAGEM  │
      │SUCESSO   │      │RESULT. │    │SUCESSO   │
      └────┬─────┘      └───┬────┘    └────┬─────┘
           │                │              │
           └────────────────┼──────────────┘
                            │
                      ───────
                      │
                      ▼
              ┌───────────────┐
              │ REDIRECIONAR  │
              │ PARA LISTAGEM │
              └───────┬───────┘
                      │
                      ▼
                 ┌─────────┐
                 │   FIM   │
                 └─────────┘

         ┌──────────────┐
         │   EXCLUIR    │
         └──────┬───────┘
                │
                ▼
         ┌──────────────┐
         │ DELETE WHERE │
         │ ID = ?       │
         └──────┬───────┘
                │
                ▼
         ┌──────────────┐
         │  SUCESSO?    │
         └───┬─────┬────┘
         SIM │     │ NÃO
             │     │
             ▼     ▼
      ┌──────────┐
      │ MENSAGEM │
      └────┬─────┘
           │
           ▼
      ┌──────────┐
      │  FIM     │
      └──────────┘
## Fluxograma - Fluxo de Navegação do Sistema

                    ┌─────────────┐
                    │  index.php  │
                    └──────┬──────┘
                           │
                           ▼
                    ┌──────────────────┐
                    │  Menu Principal  │
                    └──────┬───────────┘
                           │
        ┌──────────────────┼─────────────────────────────────────┐
        │                                                        │
        ▼                                                        ▼
    ┌─────────┐                                             ┌─────────┐
    │ Jogador │                                             │ Equipe  │
    └────┬────┘                                             └────┬────┘
         │                                                       │ 
         │                                                       │
    ┌────┴────┐                                             ┌────┴────┐
    │Cadastrar│                                             │Cadastrar│
    │Listar   │                                             │Listar   │
    │Editar   │                                             │Editar   │
    │Excluir  │                                             │Excluir  │
    └────┬────┘                                             └────┬────┘
         │                                                       │
         └───────────────────────────────────────────────────────┘
                          │
                          ▼
                    ┌─────────────┐
                    │ salvar-*.php│
                    └──────┬──────┘
                           │
                           ▼
                    ┌─────────────┐
                    │  BANCO DE   │
                    │   DADOS     │
                    └─────────────┘
                           

## Modelo do Banco de Dados (SQL)

## Tabela: jogador

### SQL

    `id_jogador` INT NOT NULL AUTO_INCREMENT,

  
    `nome_jogador` VARCHAR(45) NOT NULL,

  
    `altura_jogador` DECIMAL(10,2) NULL,

  
    `dt_nasc_jogador` DATE NULL,

  
    `categoria_jogador` VARCHAR(45) NULL,

  
    `genero_jogador` VARCHAR(45) NULL,

  
    `posicao_jogador` VARCHAR(45) NULL,

  
    `numero_jogador` CHAR(3) NULL,

  
    PRIMARY KEY (`id_jogador`))
    ENGINE = InnoDB;

## Tabela: equipe

## Esta tabela possui a chave estrangeira jogador_id_jogador que aponta para jogador.id_jogador.

## SQL


    `id_equipe` INT NOT NULL AUTO_INCREMENT,

  
    `nome_equipe` VARCHAR(45) NOT NULL,

  
    `estado_equipe` VARCHAR(45) NULL,

  
    `cidade_equipe` VARCHAR(45) NULL,

  
    `ginasio_equipe` VARCHAR(45) NULL,

  
    `jogador_id_jogador` INT NOT NULL,

  
    PRIMARY KEY (`id_equipe`, `jogador_id_jogador`),

  
    INDEX `fk_equipe_jogador_idx` (`jogador_id_jogador` ASC),

  
    CONSTRAINT `fk_equipe_jogador`

  
    FOREIGN KEY (`jogador_id_jogador`)

    
    REFERENCES `campeonato`.`jogador` (`id_jogador`)
    
    ON DELETE NO ACTION
    
    ON UPDATE NO ACTION)
    
    ENGINE = InnoDB;
## Observações Técnicas

Conexão com Banco de Dados: Utiliza MySQLi para a conexão orientada a objetos (via $conn em config.php).

Interface: O layout é baseado em Bootstrap para responsividade (conforme referenciado no index.php).

Segurança: Para produção, é altamente recomendável migrar as operações SQL para Prepared Statements para prevenir ataques de Injeção de SQL.
