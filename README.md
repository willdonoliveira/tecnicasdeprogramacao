 Pseudocódigo - Roteamento Principal (index.php)


INÍCIO
    CONECTAR ao banco de dados MySQL
    RECEBER parâmetro 'page' da URL

    SWITCH (página solicitada)
        // Módulos Jogador
        CASO 'cadastrar-jogador': INCLUIR arquivo cadastrar-jogador.php
        CASO 'listar-jogador': INCLUIR arquivo listar-jogador.php
        CASO 'editar-jogador': INCLUIR arquivo editar-jogador.php
        CASO 'salvar-jogador': // Responsável por CREATE, UPDATE, DELETE
            INCLUIR arquivo salvar-jogador.php
            
        // Módulos Equipe
        CASO 'cadastrar-equipe': INCLUIR arquivo cadastrar-equipe.php
        CASO 'listar-equipe': INCLUIR arquivo listar-equipe.php
        CASO 'editar-equipe': INCLUIR arquivo editar-equipe.php
        CASO 'salvar-equipe': // Responsável por CREATE, UPDATE, DELETE
            INCLUIR arquivo salvar-equipe.php

        CASO PADRÃO:
            EXIBIR mensagem de boas-vindas
    FIM SWITCH
FIM
 Módulo 1: Jogador (CRUD Simples)
Pseudocódigo - Operação de Cadastro de Jogadores
Snippet de código

INÍCIO
    CONECTAR ao banco de dados MySQL
    RECEBER ação do formulário (normalmente "cadastrar" no salvar-jogador.php)
    
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
Pseudocódigo - Operação de Listagem de Jogadores
Snippet de código

INÍCIO
    CONECTAR ao banco de dados MySQL
    CRIAR comando SQL: SELECT * FROM jogador
    EXECUTAR consulta SQL
    OBTER quantidade de resultados
    
    SE quantidade > 0 ENTÃO
        EXIBIR tabela com cabeçalhos (Nome, Altura, Posição, etc.)
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
Pseudocódigo - Operação de Edição de Jogador
Snippet de código

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
Módulo 2: Equipe (CRUD com Vínculo)
Pseudocódigo - Operação de Cadastro de Equipe
Snippet de código

INÍCIO
    CONECTAR ao banco de dados MySQL
    // O formulário deve buscar e exibir a lista de Jogadores
    
    RECEBER ação do formulário (normalmente "cadastrar" no salvar-equipe.php)
    
    SE ação = "cadastrar" ENTÃO
        RECEBER nome_equipe, estado_equipe, cidade_equipe, ginasio_equipe
        RECEBER **jogador_id_jogador** (ID do jogador selecionado - Chave Estrangeira)
        
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
Pseudocódigo - Operação de Listagem de Equipes (com JOIN)
Snippet de código

INÍCIO
    CONECTAR ao banco de dados MySQL
    // É necessário usar JOIN para exibir o nome do Jogador vinculado
    CRIAR comando SQL: SELECT eq.*, jg.nome_jogador FROM equipe AS eq INNER JOIN jogador AS jg ON eq.jogador_id_jogador = jg.id_jogador
    EXECUTAR consulta SQL
    OBTER quantidade de resultados
    
    SE quantidade > 0 ENTÃO
        EXIBIR tabela com cabeçalhos (Nome Equipe, Estado, Nome do Jogador, etc.)
        ENQUANTO houver registros FAÇA
            EXIBIR campos da equipe e nome_jogador (obtido pelo JOIN)
            EXIBIR botões de ação (Editar/Excluir)
            AVANÇAR para próximo registro
        FIM ENQUANTO
        FECHAR tabela
    SENÃO
        EXIBIR mensagem: "Não encontrou resultado"
    FIM SE
FIM
Pseudocódigo - Operação de Edição de Equipe
Snippet de código

INÍCIO
    CONECTAR ao banco de dados MySQL
    RECEBER id_equipe da URL (para buscar dados)
    CRIAR comando SQL: SELECT * FROM equipe WHERE id_equipe = ID
    EXECUTAR consulta SQL
    OBTER dados da equipe
    
    // O formulário deve marcar o Jogador atualmente vinculado.
    
    RECEBER ação = "editar" ENTÃO
        RECEBER dados atualizados do formulário (incluindo **jogador_id_jogador**)
        CRIAR comando SQL: UPDATE equipe SET nome_equipe=valor, jogador_id_jogador=NOVO_ID, ... WHERE id_equipe = ID
        EXECUTAR comando SQL
        
        SE comando executado com sucesso ENTÃO
            EXIBIR mensagem: "Editou equipe com sucesso!"
            REDIRECIONAR para página de listagem de equipes
        SENÃO
            EXIBIR mensagem: "Não foi possível editar equipe!"
            REDIRECIONAR para página de listagem de equipes
        FIM SE
FIM
Pseudocódigo - Operação de Exclusão de Equipe
Snippet de código

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

Fluxograma - Operação CRUD Completa de Jogador
Snippet de código

graph TD
    A[INÍCIO] --> B(CONECTAR AO BD);
    B --> C(RECEBER AÇÃO / page);
    
    subgraph Ações CRUD (salvar-jogador.php / index.php)
        C --> D(CADASTRO);
        C --> E(LISTAR);
        C --> F(EDITAR);
        C --> G(EXCLUIR);
    end
    
    subgraph Bloco Cadastro
        D --> H[RECEBER DADOS FORM];
        H --> I[INSERT INTO jogador];
        I --> J{SUCESSO?};
    end
    
    subgraph Bloco Listar
        E --> K[SELECT * FROM jogador];
        K --> L[OBTER QUANTIDADE];
        L --> M{Qtd > 0?};
        M -- SIM --> N[EXIBIR TABELA];
        M -- NÃO --> O[EXIBIR 'Não encontrou'];
    end
    
    subgraph Bloco Editar
        F --> P[SELECT * FROM pelo ID];
        P --> Q[RECEBER DADOS ATUALIZADOS];
        Q --> R[UPDATE jogador SET...];
        R --> J; 
    end
    
    subgraph Bloco Excluir
        G --> S[RECEBER id_jogador];
        S --> T[DELETE FROM jogador];
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
    end
Fluxograma - Fluxo de Navegação do Sistema
Snippet de código

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
🛠 Especificação em Linguagem Algorítmica (PHP)
Os algoritmos abaixo detalham as operações CRUD do Módulo Equipe (no arquivo salvar-equipe.php), onde o código de roteamento principal é simplificado para ESCOLHA pagina.

Algoritmo 1: Cadastrar Equipe
Snippet de código

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
Algoritmo 2: Listar Equipes (Com JOIN)
Snippet de código

ALGORITMO listar_equipes
VAR
    sql: TEXTO
    res: RESULTADO
    qtd: INTEIRO
INÍCIO
    // SQL com JOIN para buscar o nome do jogador vinculado
    sql <- "SELECT eq.*, jg.nome_jogador FROM equipe AS eq INNER JOIN jogador AS jg ON eq.jogador_id_jogador = jg.id_jogador"
    
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
Algoritmo 3: Gerenciamento de Ações CRUD da Equipe (salvar-equipe.php)
Snippet de código

ALGORITMO gerenciar_acoes_equipe
VAR
    acao: TEXTO
INÍCIO
    acao <- $_REQUEST['acao']
    
    ESCOLHA acao
        CASO 'cadastrar': EXECUTAR algoritmo_cadastrar_equipe()
        CASO 'editar': EXECUTAR algoritmo_editar_equipe()
        CASO 'excluir': EXECUTAR algoritmo_excluir_equipe()
        CASO PADRÃO: ESCREVA "Ação não reconhecida."
    FIM ESCOLHA
FIM
🗄 Descrição das Tabelas do Banco de Dados
Tabela: jogador
SQL

CREATE TABLE IF NOT EXISTS `campeonato`.`jogador` (
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
Tabela: equipe
SQL

CREATE TABLE IF NOT EXISTS `campeonato`.`equipe` (
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
 Observações Técnicas
Conexão com Banco de Dados: Utiliza MySQLi para conexão orientada a objetos.

Roteamento: Sistema de roteamento simples baseado em parâmetro GET 'page' no arquivo index.php.

Interface: Utiliza Bootstrap para criação de interface responsiva.

Segurança: Para produção, recomenda-se implementar prepared statements e validação de entrada de dados.
