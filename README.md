# Tecnicas de Programação

Este repositório contém atividades do curso de Engenharia de Software adicionada a disciplina de Técnicas de Programação do aluno Willdon Oliveira da Silva.
INÍCIO
    CONECTAR ao banco de dados MySQL
    RECEBER parâmetro 'page' da URL
    Projeto Desenvolvido com Aplicação CRUD
Este projeto consiste em um Sistema de Gerenciamento de Campeonato desenvolvido em PHP com MySQL, implementando operações CRUD (Create, Read, Update, Delete) para gerenciamento de:

Jogador: Cadastro, listagem, edição e exclusão de jogadores
Equipe: Cadastro, listagem, edição e exclusão de equipes
Para cada módulo, foram implementadas as quatro operações básicas:

CREATE (Criar): Formulários de cadastro que inserem novos registros no banco de dados
READ (Ler): Páginas de listagem que exibem todos os registros cadastrados
UPDATE (Atualizar): Formulários de edição que modificam registros existentes
DELETE (Deletar): Funcionalidade que remove registros do banco de dados
Pseudocódigo
Pseudocódigo - Operação de Cadastro de Jogadores
    
    SWITCH (página solicitada)
        // Módulos Jogador
        CASO 'cadastrar-jogador':
            INCLUIR arquivo cadastrar-jogador.php
        CASO 'listar-jogador':
            INCLUIR arquivo listar-jogador.php
        CASO 'editar-jogador':
            INCLUIR arquivo editar-jogador.php
        CASO 'salvar-jogador': // Responsável por CREATE, UPDATE, DELETE
            INCLUIR arquivo salvar-jogador.php
            
        // Módulos Equipe
        CASO 'cadastrar-equipe':
            INCLUIR arquivo cadastrar-equipe.php
        CASO 'listar-equipe':
            INCLUIR arquivo listar-equipe.php
        CASO 'editar-equipe':
            INCLUIR arquivo editar-equipe.php
        CASO 'salvar-equipe': // Responsável por CREATE, UPDATE, DELETE
            INCLUIR arquivo salvar-equipe.php

        CASO PADRÃO:
            EXIBIR mensagem de boas-vindas
    FIM SWITCH
FIM
Módulo 1: Jogador (CRUD Simples)
Pseudocódigo - Operação de Cadastro de Jogador

INÍCIO
    CONECTAR ao banco de dados MySQL
    RECEBER ação do formulário (normalmente "cadastrar" no salvar-jogador.php)
    
    SE ação = "cadastrar" ENTÃO
        RECEBER nome_jogador do formulário
        RECEBER altura_jogador do formulário
        RECEBER dt_nasc_jogador do formulário
        RECEBER categoria_jogador do formulário
        RECEBER genero_jogador do formulário
        RECEBER posicao_jogador do formulário
        RECEBER numero_jogador do formulário
        
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
Pseudocódigo - Operação de Listagem de Jogadores

INÍCIO
    CONECTAR ao banco de dados MySQL
    CRIAR comando SQL: SELECT * FROM jogador
    EXECUTAR consulta SQL
    OBTER quantidade de resultados
    
    SE quantidade > 0 ENTÃO
        EXIBIR tabela com cabeçalhos (Nome, Altura, Posição, etc.)
        ENQUANTO houver registros FAÇA
            EXIBIR ID do jogador
            EXIBIR nome do jogador
            EXIBIR todos os outros campos (Altura, Posição, etc.)
            EXIBIR botões de ação (Editar/Excluir)
            AVANÇAR para próximo registro
        FIM ENQUANTO
        FECHAR tabela
    SENÃO
        EXIBIR mensagem: "Não encontrou resultado"
    FIM SE
FIM
Pseudocódigo - Operação de Edição de Jogador

INÍCIO
    CONECTAR ao banco de dados MySQL
    RECEBER id_jogador da URL (para buscar dados)
    CRIAR comando SQL: SELECT * FROM jogador WHERE id_jogador = ID
    EXECUTAR consulta SQL
    OBTER dados do jogador (para preencher o formulário)
    
    RECEBER ação do formulário (normalmente "editar" no salvar-jogador.php)
    
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
Pseudocódigo - Operação de Exclusão de Jogador
Snippet de código

INÍCIO
    CONECTAR ao banco de dados MySQL
    RECEBER ação = "excluir"
    RECEBER id_jogador da URL
    
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
Módulo 2: Equipe (CRUD com Vínculo)
Pseudocódigo - Operação de Cadastro de Equipe

INÍCIO
    CONECTAR ao banco de dados MySQL
    // Antes de tudo, o formulário de cadastro deve buscar e exibir a lista de Jogadores
    // para preencher o campo 'jogador_id_jogador' (Chave Estrangeira)
    
    RECEBER ação do formulário (normalmente "cadastrar" no salvar-equipe.php)
    
    SE ação = "cadastrar" ENTÃO
        RECEBER nome_equipe do formulário
        RECEBER estado_equipe do formulário
        RECEBER cidade_equipe do formulário
        RECEBER ginasio_equipe do formulário
        RECEBER **jogador_id_jogador** (ID do jogador selecionado)
        
        CRIAR comando SQL: INSERT INTO equipe (..., jogador_id_jogador) VALUES (..., ID_JOGADOR)
        EXECUTAR comando SQL
        
        SE comando executado com sucesso ENTÃO
            EXIBIR mensagem: "Cadastrou equipe com sucesso!"
            REDIRECIONAR para página de listagem de equipes
        SENÃO
            EXIBIR mensagem: "Não Cadastrou equipe!"
            REDIRECIONAR para página de listagem de equipes
        FIM SE
    FIM SE
FIM
Pseudocódigo - Operação de Listagem de Equipes

INÍCIO
    CONECTAR ao banco de dados MySQL
    // É necessário usar JOIN para exibir o nome do Jogador vinculado
    CRIAR comando SQL: SELECT eq.*, jg.nome_jogador FROM equipe AS eq INNER JOIN jogador AS jg ON eq.jogador_id_jogador = jg.id_jogador
    EXECUTAR consulta SQL
    OBTER quantidade de resultados
    
    SE quantidade > 0 ENTÃO
        EXIBIR tabela com cabeçalhos (Nome Equipe, Estado, Nome do Jogador, etc.)
        ENQUANTO houver registros FAÇA
            EXIBIR ID da equipe
            EXIBIR nome da equipe
            EXIBIR nome_jogador (obtido pelo JOIN)
            EXIBIR demais campos da equipe
            EXIBIR botões de ação (Editar/Excluir)
            AVANÇAR para próximo registro
        FIM ENQUANTO
        FECHAR tabela
    SENÃO
        EXIBIR mensagem: "Não encontrou resultado"
    FIM SE
FIM
Pseudocódigo - Operação de Edição de Equipe

INÍCIO
    CONECTAR ao banco de dados MySQL
    RECEBER id_equipe da URL (para buscar dados)
    CRIAR comando SQL: SELECT * FROM equipe WHERE id_equipe = ID
    EXECUTAR consulta SQL
    OBTER dados da equipe (incluindo o ID do Jogador vinculado)
    
    // O formulário deve buscar e exibir a lista de Jogadores, marcando o Jogador atualmente vinculado como 'selected'.
    
    RECEBER ação do formulário (normalmente "editar" no salvar-equipe.php)
    
    SE ação = "editar" ENTÃO
        RECEBER dados atualizados do formulário (nome_equipe, estado_equipe, e **jogador_id_jogador**)
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
Pseudocódigo - Operação de Exclusão de Equipe

INÍCIO
    CONECTAR ao banco de dados MySQL
    RECEBER ação = "excluir"
    RECEBER id_equipe da URL
    
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

Fluxograma
Fluxograma - Operação CRUD Completa de Jogador

    A[INÍCIO] --> B(CONECTAR AO BD);
    B --> C(RECEBER AÇÃO / page);
    
    subgraph Ações CRUD (salvar-jogador.php / index.php)
        C --> D(CADASTRO);
        C --> E(LISTAR);
        C --> F(EDITAR);
        C --> G(EXCLUIR);
    end
    
    subgraph Bloco Cadastro
        D --> H[RECEBER DADOS FORM (nome_jogador, altura, etc.)];
        H --> I[INSERT INTO jogador];
        I --> J{SUCESSO?};
    end
    
    subgraph Bloco Listar
        E --> K[SELECT * FROM jogador];
        K --> L[OBTER QUANTIDADE DE RESULTADOS];
        L --> M{Quantidade > 0?};
        M -- SIM --> N[EXIBIR TABELA (Com Ações Editar/Excluir)];
        M -- NÃO --> O[EXIBIR 'Não encontrou resultado'];
    end
    
    subgraph Bloco Editar
        F --> P[SELECT * FROM jogador pelo ID];
        P --> Q[RECEBER DADOS FORM ATUALIZADOS];
        Q --> R[UPDATE jogador SET... WHERE ID=?];
        R --> J; // Reutiliza a verificação de sucesso
    end
    
    subgraph Bloco Excluir
        G --> S[RECEBER id_jogador da URL];
        S --> T[DELETE FROM jogador WHERE ID=?];
        T --> U{SUCESSO?};
    end
    
    subgraph Mensagens e Fim
        J -- SIM --> V[MENSAGEM SUCESSO];
        J -- NÃO --> W[MENSAGEM FALHA];
        
        U -- SIM --> X[MENSAGEM SUCESSO];
        U -- NÃO --> Y[MENSAGEM FALHA];
        
        N --> Z[REDIRECIONAR PARA LISTAGEM];
        O --> Z;
        V --> Z;
        W --> Z;
        X --> Z;
        Y --> Z;
        
        Z --> FIM;
   FIM
   Fluxograma - Fluxo de Navegação do Sistema
   graph TD
    A[index.php] --> B(Menu Principal);
    
    B --> C{JOGADOR};
    B --> D{EQUIPE};
    
    subgraph Módulo Jogador
        C --> C1(Cadastrar);
        C --> C2(Listar);
        C --> C3(Editar);
        C --> C4(Excluir);
    end
    
    subgraph Módulo Equipe
        D --> D1(Cadastrar);
        D --> D2(Listar);
        D --> D3(Editar);
        D --> D4(Excluir);
    end
    
    C1 --> E;
    C3 --> E;
    C4 --> E; 
    D1 --> E;
    D3 --> E;
    D4 --> E;
    
    E[salvar-*.php];
    E --> F(BANCO DE DADOS);
    
    C2 --> Z;
    D2 --> Z;
    Z(Páginas de Listagem);
    Z --> B; // Volta para o Menu
    
    F --> C2; // Retorno do CRUD (após salvar)
    F --> D2; // Retorno do CRUD (após salvar)

  Especificação em Linguagem Algorítmica (PHP)
Módulo Equipe (CRUD)
Algoritmo 1: Cadastrar Equipe

ALGORITMO cadastrar_equipe
VAR
    nome_equipe: TEXTO
    estado_equipe: TEXTO
    cidade_equipe: TEXTO
    ginasio_equipe: TEXTO
    jogador_id_jogador: INTEIRO // Chave Estrangeira
    sql: TEXTO
    res: BOOLEANO
INÍCIO
    // Receber dados do formulário
    nome_equipe <- $_POST['nome_equipe']
    estado_equipe <- $_POST['estado_equipe']
    cidade_equipe <- $_POST['cidade_equipe']
    ginasio_equipe <- $_POST['ginasio_equipe']
    jogador_id_jogador <- $_POST['jogador_id_jogador']
    
    // Construir comando SQL
    sql <- "INSERT INTO equipe (nome_equipe, estado_equipe, cidade_equipe, ginasio_equipe, jogador_id_jogador) 
            VALUES ('" + nome_equipe + "', '" + estado_equipe + "', '" + cidade_equipe + "', '" + ginasio_equipe + "', " + jogador_id_jogador + ")"
    
    // Executar comando SQL
    res <- conn->query(sql)
    
    // Verificar resultado
    SE res = VERDADEIRO ENTÃO
        ESCREVA "Equipe cadastrada com sucesso!"
        REDIRECIONAR para '?page=listar-equipe'
    SENÃO
        ESCREVA "Não foi possível cadastrar a equipe!"
        REDIRECIONAR para '?page=listar-equipe'
    FIM SE
FIM
Algoritmo 2: Listar Equipes (Com JOIN)
Este algoritmo executa a operação SELECT com JOIN no arquivo listar-equipe.php para exibir o nome do jogador vinculado.

ALGORITMO listar_equipes
VAR
    sql: TEXTO
    res: RESULTADO
    qtd: INTEIRO
    row: REGISTRO
INÍCIO
    // Construir comando SQL com JOIN para buscar o nome do jogador vinculado
    sql <- "SELECT eq.*, jg.nome_jogador FROM equipe AS eq 
            INNER JOIN jogador AS jg ON eq.jogador_id_jogador = jg.id_jogador"
    
    // Executar consulta
    res <- conn->query(sql)
    
    // Obter quantidade de resultados
    qtd <- res->num_rows
    
    // Verificar se há resultados
    SE qtd > 0 ENTÃO
        ESCREVA "Encontrou " + qtd + " resultado(s)"
        ESCREVA início da tabela
        ESCREVA cabeçalhos da tabela (incluindo "Nome do Jogador")
        
        // Loop para exibir cada registro
        ENQUANTO res->fetch_object() FAÇA
            row <- próximo registro
            ESCREVA row->id_equipe
            ESCREVA row->nome_equipe
            ESCREVA row->estado_equipe
            ESCREVA row->nome_jogador // Exibição do nome do jogador via JOIN
            ESCREVA botões de ação (Editar/Excluir)
        FIM ENQUANTO
        
        ESCREVA fim da tabela
    SENÃO
        ESCREVA "Não encontrou resultado."
    FIM SE
FIM
Algoritmo 3: Editar Equipe
Este algoritmo executa a operação UPDATE no arquivo salvar-equipe.php quando a ação é 'editar'.

ALGORITMO editar_equipe
VAR
    id_equipe: INTEIRO
    nome_equipe: TEXTO
    estado_equipe: TEXTO
    cidade_equipe: TEXTO
    ginasio_equipe: TEXTO
    jogador_id_jogador: INTEIRO
    sql: TEXTO
    res: BOOLEANO
INÍCIO
    // Receber ID da equipe e dados atualizados
    id_equipe <- $_REQUEST['id_equipe']
    nome_equipe <- $_POST['nome_equipe']
    estado_equipe <- $_POST['estado_equipe']
    cidade_equipe <- $_POST['cidade_equipe']
    ginasio_equipe <- $_POST['ginasio_equipe']
    jogador_id_jogador <- $_POST['jogador_id_jogador']
    
    // Construir comando SQL UPDATE (incluindo atualização da Chave Estrangeira)
    sql <- "UPDATE equipe SET 
            nome_equipe='" + nome_equipe + "', 
            estado_equipe='" + estado_equipe + "', 
            cidade_equipe='" + cidade_equipe + "',
            ginasio_equipe='" + ginasio_equipe + "',
            jogador_id_jogador=" + jogador_id_jogador + 
            " WHERE id_equipe=" + id_equipe
    
    // Executar comando SQL
    res <- conn->query(sql)
    
    // Verificar resultado
    SE res = VERDADEIRO ENTÃO
        ESCREVA "Equipe editada com sucesso!"
        REDIRECIONAR para '?page=listar-equipe'
    SENÃO
        ESCREVA "Não foi possível editar a equipe!"
        REDIRECIONAR para '?page=listar-equipe'
    FIM SE
FIM
Algoritmo 4: Excluir Equipe
Este algoritmo executa a operação DELETE no arquivo salvar-equipe.php quando a ação é 'excluir'.

ALGORITMO excluir_equipe
VAR
    id_equipe: INTEIRO
    sql: TEXTO
    res: BOOLEANO
INÍCIO
    // Receber ID da equipe
    id_equipe <- $_REQUEST['id_equipe']
    
    // Construir comando SQL DELETE
    sql <- "DELETE FROM equipe WHERE id_equipe=" + id_equipe
    
    // Executar comando SQL
    res <- conn->query(sql)
    
    // Verificar resultado
    SE res = VERDADEIRO ENTÃO
        ESCREVA "Equipe excluída com sucesso!"
        REDIRECIONAR para '?page=listar-equipe'
    SENÃO
        ESCREVA "Não foi possível excluir a equipe! (Verifique se há restrições de chave estrangeira)"
        REDIRECIONAR para '?page=listar-equipe'
    FIM SE
FIM
Integração no Sistema
Algoritmo 5: Sistema de Roteamento Principal (Atualizado)
Snippet de código

ALGORITMO roteamento_sistema
VAR
    pagina: TEXTO
INÍCIO
    // Conectar ao banco de dados
    INCLUIR 'config.php'
    
    // Receber parâmetro de página
    pagina <- $_REQUEST['page']
    
    // Roteamento baseado na página solicitada
    ESCOLHA pagina
        // Módulos Jogador
        CASO 'cadastrar-jogador':
            INCLUIR 'cadastrar-jogador.php'
        CASO 'listar-jogador':
            INCLUIR 'listar-jogador.php'
        CASO 'editar-jogador':
            INCLUIR 'editar-jogador.php'
        CASO 'salvar-jogador':
            INCLUIR 'salvar-jogador.php'
            
        // Módulos Equipe (Novos casos)
        CASO 'cadastrar-equipe':
            INCLUIR 'cadastrar-equipe.php'
        CASO 'listar-equipe':
            INCLUIR 'listar-equipe.php'
        CASO 'editar-equipe':
            INCLUIR 'editar-equipe.php'
        CASO 'salvar-equipe':
            INCLUIR 'salvar-equipe.php'
            
        CASO PADRÃO:
            ESCREVA "Seja bem vindo ao sistema The Liga Pro"
    FIM ESCOLHA
FIM
Algoritmo 6: Gerenciamento de Ações CRUD da Equipe (salvar-equipe.php)
Snippet de código

ALGORITMO gerenciar_acoes_equipe
VAR
    acao: TEXTO
INÍCIO
    // Receber ação do formulário (cadastrar, editar ou excluir)
    acao <- $_REQUEST['acao']
    
    // Executar ação correspondente
    ESCOLHA acao
        CASO 'cadastrar':
            EXECUTAR algoritmo_cadastrar_equipe()
        CASO 'editar':
            EXECUTAR algoritmo_editar_equipe()
        CASO 'excluir':
            EXECUTAR algoritmo_excluir_equipe()
        CASO PADRÃO:
            ESCREVA "Ação não reconhecida."
    FIM ESCOLHA
FIM

SUBALGORITMO algoritmo_cadastrar_equipe()
    // Implementação do Algoritmo 1: Cadastrar Equipe
FIM SUBALGORITMO

SUBALGORITMO algoritmo_editar_equipe()
    // Implementação do Algoritmo 3: Editar Equipe
FIM SUBALGORITMO

SUBALGORITMO algoritmo_excluir_equipe()
    // Implementação do Algoritmo 4: Excluir Equipe
FIM SUBALGORITMO

Descrição das Tabelas do Banco de Dados
Tabela: jogador
ALGORITMO cadastrar_jogador
    id_jogador` INT NOT NULL AUTO_INCREMENT,
  `nome_jogador` VARCHAR(45) NOT NULL,
  `altura_jogador` DECIMAL(10,2) NULL,
  `dt_nasc_jogador` DATE NULL,
  `categoria_jogador` VARCHAR(45) NULL,
  `genero_jogador` VARCHAR(45) NULL,
  `posicao_jogador` VARCHAR(45) NULL,
  `numero_jogador` CHAR(3) NULL,
  PRIMARY KEY (`id_jogador`))
ENGINE = InnoDB;

Tabela: equipe
 `id_equipe` INT NOT NULL AUTO_INCREMENT,
  `nome_equipe` VARCHAR(45) NOT NULL,
  `estado_equipe` VARCHAR(45) NULL,
  `cidade_equipe` VARCHAR(45) NULL,
  `ginasio_equipe` VARCHAR(45) NULL,
  `jogador_id_jogador` INT NOT NULL,
  PRIMARY KEY (`id_equipe`, `jogador_id_jogador`),
  INDEX `fk_equipe_jogador_idx` (`jogador_id_jogador` ASC) ,
  CONSTRAINT `fk_equipe_jogador`
    FOREIGN KEY (`jogador_id_jogador`)
    REFERENCES `campeonato`.`jogador` (`id_jogador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

Observações Técnicas
Conexão com Banco de Dados: Utiliza MySQLi para conexão orientada a objetos
Roteamento: Sistema de roteamento simples baseado em parâmetro GET 'page'
Validação: Validações básicas implementadas nos formulários HTML
Interface: Utiliza Bootstrap para criação de interface responsiva
Segurança: Para produção, recomenda-se implementar prepared statements e validação de entrada



  
