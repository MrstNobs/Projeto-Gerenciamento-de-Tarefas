<?php 
    include_once './php/Conexao.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        if($nome && $email) {
            $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            header('location: ./tarefas.php');
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuario</title>
    
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <nav>
        <a href="./index.php">Cadastro de Usuário</a>
        <a href="./tarefas.php">Cadastro de Tarefas</a>
        <a href="./gerenciamento.php">Gerenciar Tarefas</a>
    </nav>

    <h1>Cadastro do Usuário</h1>
    <form method="POST" action="./cadastro.php">
        <label for="nome"> Nome: </label>
        <input type="text" id="nome" name="nome" required placeholder="Digite aqui"> <br>

        <label for="email"> Email: </label>
        <input type="text" id="email" name="email" required placeholder="Digite Aqui"> <br>

        <button type="submit"> Cadastrar </button>
    </form>
    
</body>
</html>