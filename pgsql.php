<?php
set_time_limit(0);
ini_set('memory_limit', '-1');
// CONNECTION
$path_file = "./Imunes_e_isentas.csv";

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'bd_test';
$user = 'postgres';
$password = 'ROOT';

/*
try {
    // Conexão com o banco de dados usando PDO
    $dsn = "pgsql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);

    // Configurar o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Registrar o tempo inicial
    $tempo1 = date('h:i:s');
    echo "Início: $tempo1\n";

    if (($handle = fopen($path_file, 'r')) !== FALSE) {
        // Ignorar o cabeçalho
        fgetcsv($handle);
        $pdo->exec("SET statement_timeout = 0");
        $pdo->exec("SET work_mem = '128MB'");

        // Preparar a consulta SQL para inserção
        $sql = "INSERT INTO dados2 (ano, cnpj, forma, tipo, quantidade) VALUES (:ano, :cnpj, :forma, :tipo, :quantidade)";
        $stmt = $pdo->prepare($sql);

        // Ler e inserir cada linha do arquivo CSV
        while (($dados = fgetcsv($handle, 10000000, ';')) !== FALSE) {
            $stmt->execute([
                ':ano' => $dados[0],
                ':cnpj' => $dados[1],
                ':forma' => $dados[2],
                ':tipo' => $dados[3],
                ':quantidade' => $dados[4]
            ]);
        }

        fclose($handle);

        // Registrar o tempo final
        $tempo2 = date('h:i:s');
        echo "Término: $tempo2\n";

        echo "Processamento concluído com sucesso!";
    } else {
        echo "Não foi possível abrir o arquivo CSV";
    }
} catch (PDOException $e) {
    echo "Erro ao conectar ou executar operações no banco de dados: " . $e->getMessage();
}*/

/*
try{
    // Conexão com o banco de dados usando PDO
    $dsn = "pgsql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);

    // Configurar o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Registrar o tempo inicial
    $tempo1 = date('h:i:s');
    echo "Início: $tempo1\n";

    $sql = "SELECT * FROM dados ORDER BY id ASC";
    $stm = $pdo->prepare($sql);
    $result = $stm->execute();

    $tempo2 = date('h:i:s');
    echo "Término: $tempo2\n";
} catch (PDOException $e) {
    echo "Erro ao conectar ou executar operações no banco de dados: " . $e->getMessage();
}*/

/*
try{
    // Conexão com o banco de dados usando PDO
    $dsn = "pgsql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);

    // Configurar o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Registrar o tempo inicial
    $tempo1 = date('h:i:s');
    echo "Início: $tempo1\n";

    $sql = "UPDATE dados2 SET quantidade = 1 WHERE quantidade = 2";
    $stm = $pdo->prepare($sql);
    $stm->execute();

    $tempo2 = date('h:i:s');
    echo "Término: $tempo2\n";
} catch (PDOException $e)
{
    echo "Erro ao conectar ou executar operações no banco de dados: " . $e->getMessage();
}*/

/*
try{
    // Conexão com o banco de dados usando PDO
    $dsn = "pgsql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);

    // Configurar o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Registrar o tempo inicial
    $tempo1 = date('h:i:s');
    echo "Início: $tempo1\n";

    $sql = "SELECT * FROM dados JOIN dados2 ON dados.quantidade = dados2.quantidade LIMIT 10000000";
    $stm = $pdo->prepare($sql);
    $stm->execute();

    $tempo2 = date('h:i:s');
    echo "Término: $tempo2\n";
} catch (PDOException $e)
{
    echo "Erro ao conectar ou executar operações no banco de dados: " . $e->getMessage();
}*/

try{
    // Conexão com o banco de dados usando PDO
    $dsn = "pgsql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);

    // Configurar o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Registrar o tempo inicial
    $tempo1 = date('h:i:s');
    echo "Início: $tempo1\n";

    $sql = "DELETE FROM dados";
    $stm = $pdo->prepare($sql);
    $stm->execute();

    $tempo2 = date('h:i:s');
    echo "Término: $tempo2\n";
} catch (PDOException $e)
{
    $tempo3 = date('h:i:s');
    echo "Falhou: $tempo3 \n";
    echo "Erro ao conectar ou executar operações no banco de dados: " . $e->getMessage();
}
?>