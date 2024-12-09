<?php 
    include_once './php/Conexao.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $descricao = $_POST['descricao'];
        $setor = $_POST['setor'];
        $usuario = $_POST['usuario'];
        $prioridade = $_POST['prioridade'];
        $data = date('d-m-Y');

        if ($descricao && $setor && $usuario && $prioridade && $data) {
            $sql = "INSERT INTO tarefas (usuario, descricao, setor, prioridade, data) VALUES (:usuario, :descricao, :setor, :prioridade, :data)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':setor', $setor);
            $stmt->bindParam(':prioridade', $prioridade);
            $stmt->bindParam(':data', $data);
            $stmt->execute();
            header('location: ./cadastro.php');
            exit;
        }
    }

    $sql = "SELECT * FROM usuarios";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Tarefas</title>

    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <nav>
        <a href="./index.php">Cadastro de Usuário</a>
        <a href="./tarefas.php">Cadastro de Tarefas</a>
        <a href="./gerenciamento.php">Gerenciar Tarefas</a>
    </nav>

    <h1>Cadastro de Tarefas</h1>
    <form action="./tarefas.php" method="POST">
        <label for="descricao"> Descrição: </label>
        <input type="text" id="descricao" name="descricao" required placeholder="Digite Aqui"><br>

        <label for="setor"> Setor: </label>
        <input type="text" id="setor" name="setor" required placeholder="Digite Aqui"><br>

        <label for="usuario"> Usuário: </label>
        <select name="usuario">
            <option value=""> Selecione </option>
            <?php foreach($usuarios as $usuario): ?>
                <option value="<?=$usuario['id']?>"> <?=$usuario['nome']?> </option>
            <?php endforeach; ?>
        </select> <br>

        <label for="prioridade"> Prioridade </label>
        <select name="prioridade">
            <option value="baixa"> Baixa </option>
            <option value="media"> Média </option>
            <option value="alta"> Alta </option>
        </select>

        <button type="submit">Cadastrar </button>
    </form>
</body>
</html>