<?php

header('Content-Type: application/json; charset=UTF-8');

try {

    $dotenv = parse_ini_file('.env');

    $pdo = new PDO(
        "mysql:host=" . $dotenv['DB_HOST'] . ";dbname=" . $dotenv['DB_NAME'],
        $dotenv['DB_USER'],
        $dotenv['DB_PASS']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    json_encode([
        "success" => false,
        "error" => "Erro de conexao com Banco de dados " . $error->getMessage()
    ]);
}

$method = $_SERVER['REQUEST_METHOD'];

if($method === 'GET') {
    $consulta = $pdo->query('SELECT * FROM carros');
    $cadastro = $consulta->fetchAll(pdo::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "cadastros" => $cadastro
    ]);
} elseif($method === 'POST') {

    $dados = json_decode(file_get_contents("php://input"), true);

    $tipo = $dados['tipo'] ?? null;
    $categoria = $dados['categoria'] ?? null;
    $modelo = $dados['modelo'] ?? null;
    $ano = $dados['ano'] ?? null;
    $valor = $dados['valor'] ?? null;

    $sql = " INSERT INTO carros (tipo, categoria, modelo, ano, valor) 
    VALUE (:tipo, :categoria, :modelo, :ano, :valor)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':tipo'      => $tipo,
        ':categoria' => $categoria,
        ':modelo'    => $modelo,
        ':ano'       => $ano,
        ':valor'     => $valor
    ]);

    echo json_encode(["success" => true, "message" => "Item cadastrado!"]);

} elseif ($method === 'DELETE') {

    $id = $_GET['id'] ?? null;

    if($id) {

        $sql = "DELETE FROM carros WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([':id' => $id]);

        echo json_encode([
            "success" => true,
            "message" => "O carro com ID $id foi deletado com sucesso"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "massage" => "Você esqueceu de passar o ID do carro que deseja excluir"
        ]);
    }

} elseif ($method === 'PUT') {

    $id = $_GET['id'] ?? null;

    $dados = json_decode(file_get_contents("php://input"), true);

    if($id && $dados) {

        $sql = "UPDATE carros SET 
                tipo = :tipo, 
                categoria = :categoria, 
                modelo = :modelo, 
                ano = :ano, 
                valor = :valor 
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':tipo'      => $dados['tipo'],
            ':categoria' => $dados['categoria'],
            ':modelo'    => $dados['modelo'],
            ':ano'       => $dados['ano'],
            ':valor'     => $dados['valor'],
            ':id'        => $id
        ]);

        echo json_encode([
            "success" => true,
            "message" => "O carro com ID $id foi atualizado com sucesso"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "massage" => "Você esqueceu de passar o ID do carro que deseja editar"
        ]);
    }
}