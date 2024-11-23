<?php
set_time_limit(0);
ini_set('memory_limit', '-1');
// CONNECTION
$servername =  "localhost";
$username = "root";
$password = "";
$database = "bd_test";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error)
{
    die("Connection failed".$conn->connect_error);
}
// QUERYS
$path_file = "./Imunes_e_isentas.csv";


$tempo1 = date('h:i:s');
echo "$tempo1\n";
if(($handle = fopen($path_file, 'r')) !== FALSE) {
    fgetcsv($handle);
    while(($dados = fgetcsv($handle, 10000000, ';')) !== FALSE) {
        $ano = $dados[0];
        $cnpj = $dados[1];
        $forma = $dados[2];
        $tipo = $dados[3];
        $quantidade = $dados[4];
        

        $sql = "INSERT INTO dados2(ano, cnpj, forma, tipo, quantidade) VALUES ('$ano', '$cnpj','$forma', '$tipo', '$quantidade')";

        if(!$conn->query($sql)){
            echo "Erro ao inserir".$conn->error."\n";
        }
    }
    //fclose($handle);
    $tempo2 = date('h:i:s');
        echo "$tempo2\n";
        fclose($handle);
} else {
    echo "Não foi possível abrir o arquivo CSV";
}


// SELECT ALL
$tempo1 = date('h:i:s');
echo "$tempo1\n";
try{
    $sql = "SELECT * FROM dados";
    if(!$conn->query($sql)){
        echo "Erro ao selecionar dados " + $conn->error +"\n";
    }
    $result = $conn->query($sql);
    $tempo2 = date('h:i:s');
    echo "$tempo2\n";
}catch(Exception $e)
{
    echo "Error ao selecionar dados. " + $e ;
}


// SELECT WITH JOIN
$tempo1 = date('h:i:s');
echo "$tempo1\n";
try {
    // SQL com JOIN
    $sql = "SELECT dados.id, dados.ano, dados.cnpj 
            FROM dados 
            INNER JOIN dados2 
            ON dados.quantidade = dados2.quantidade
            LIMIT 100000000";
    
    $result = $conn->query($sql); // Execute a consulta uma única vez
    
    if (!$result) {
        // Captura o erro diretamente
        echo "Erro ao selecionar dados: " . $conn->error . "\n";
    } else {
        echo "Consulta executada com sucesso.\n";
    }

    $tempo2 = date('h:i:s');
    echo "$tempo2\n";
} catch (Exception $e) {
    // Exceções manuais ou geradas por PDO se configurado
    echo "Erro ao selecionar dados: " . $e->getMessage() . "\n";
}

//$sql = "CREATE INDEX idx_quantidade_dados ON dados(quantidade)";
//$sql = "CREATE INDEX idx_quantidade_dados2 ON dados2(quantidade)";
//$conn->query($sql);


// UPDATE dados
$tempo1 = date('h:i:s');
echo "$tempo1\n";
try {
    $sql = "UPDATE dados SET forma = 1 WHERE forma = 0";
    $result = $conn->query($sql);
    $tempo2 = date('h:i:s');
    echo "$tempo2\n";
}catch(Exception $e)
{
    echo "Erro ao atualizar dados";
}


// DELETE dados
$tempo1 = date('h:i:s');
echo "$tempo1\n";
try{
    $sql = "DELETE FROM dados";

    $result = $conn->query($sql);
    $tempo2 = date('h:i:s');
    echo "$tempo2\n";
    echo "$result";
}catch(\Exception $e)
{
    echo "Erro ao deletar dados" . $e->getMessage();
}