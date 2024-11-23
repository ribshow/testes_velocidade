<?php
require 'vendor/autoload.php'; // Autoload do Composer para carregar a biblioteca MongoDB
set_time_limit(0);
ini_set('memory_limit', '-1');
// Caminho do arquivo CSV
$path_file = "./Imunes_e_isentas.csv";

 // Conectar ao MongoDB
 $client = new MongoDB\Client("mongodb://localhost:27017");

 // Selecionar o banco de dados e a coleção
 $database = $client->bd_test; // Substitua por seu banco de dados
 $collection = $database->dados; // Substitua por sua coleção

/*
try {

    $tempo1 = date('h:i:s');
    echo "Início: $tempo1\n";
    // inserindo os documentos
    if (($handle = fopen($path_file, 'r')) !== FALSE) {
        fgetcsv($handle); // Ignora a primeira linha (cabeçalho)

        $bulkData = []; // Para armazenar os documentos a serem inseridos em lote

        while (($dados = fgetcsv($handle, 10000000, ';')) !== FALSE) {
            $ano = (int)$dados[0]; // Conversão para inteiro
            $cnpj = $dados[1];
            $forma = (int)$dados[2];
            $tipo = (int)$dados[3];
            $quantidade = (int)$dados[4];

            // Adiciona o documento ao array
            $bulkData[] = [
                'ano' => $ano,
                'cnpj' => $cnpj,
                'forma' => $forma,
                'tipo' => $tipo,
                'quantidade' => $quantidade,
            ];
        }

        // Inserir os documentos em lote no MongoDB
        if (!empty($bulkData)) {
            $result = $collection->insertMany($bulkData);
            echo "Inseridos: " . $result->getInsertedCount() . " documentos.\n";
        }

        fclose($handle);

        $tempo2 = date('h:i:s');
        echo "Término: $tempo2\n";
    } else {
        echo "Não foi possível abrir o arquivo CSV.\n";
    }

} catch (MongoDB\Exception\Exception $e) {
    echo "Erro ao conectar ou inserir no MongoDB: " . $e->getMessage() . "\n";
}
*/

// select all
/*
$tempo1 = date('h:i:s');
echo "Início: $tempo1\n";

$result = $collection->find();

$tempo2 = date('h:i:s');
echo "Término: $tempo2\n";
*/

/*
// select with condition
$tempo1 = date('h:i:s:ms');
echo "Início: $tempo1\n";

$result = $collection->find(['quantidade' => 1]);

$tempo2 = date('h:i:s:ms');
echo "Término: $tempo2\n";
//var_dump($result);
*/

/*
// update
$tempo1 = date('h:i:s');
echo "Início: $tempo1\n";

$updateResult = $collection->updateMany(['quantidade'=> 1], ['$set' => ['quantidade'=> 2]]);

$tempo2 = date('h:i:s');
echo "Término: $tempo2\n";
*/

/*
// SELECT -> aggregate
$tempo1 = date('h:i:s');
echo "Início: $tempo1\n";

$pipeline = [
    ['$lookup' => [
        'from' => 'dados2',
        'localField' => 'ano',
        'foreignField' => 'ano',
        'as' => 'dados_unidos'
    ]],
    ['$unwind' => '$dados_unidos'],
    ['$match' => ['ano' => 2022]],
    ['$limit' => 1744404],
    ['$count' => 'total']
    ];

$aggregate = $collection->aggregate($pipeline);

foreach($aggregate as $r)
{
    echo "Total registros: " . $r['total'] . "\n";
}
/*
$cursor = $collection->aggregate($pipeline);
foreach ($cursor as $document) {
    // Processar cada documento individualmente
    print_r($document);
} 
$tempo2 = date('h:i:s');
echo "Término: $tempo2\n"; */

// Delete all
$tempo1 = date('h:i:s');
echo "Início: $tempo1\n";

$deleted = $collection->deleteMany(['quantidade' => 2]);

$tempo2 = date('h:i:s');
echo "Término: $tempo2\n";