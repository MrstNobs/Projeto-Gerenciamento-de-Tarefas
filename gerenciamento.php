<?php 
    include_once './php/Conexao.php';

    if(isset($_GET['excluir'])){
        $id = $_GET['excluir'];
        $sql = "DELETE FROM tarefas WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('location: gerenciamento.php');
        exit;
    }

    if(isset($_GET['atualizar_status'])){
        $status = $_GET['atualizar_status'];
        $id = $_GET['id'];
        if($status == 'a fazer'){
            $sql = "UPDATE tarefas SET status = :status WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header('location: gerenciamento.php');
            exit;
        }
        if($status == 'fazendo'){
            $sql = "UPDATE tarefas SET status = :status WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header('location: gerenciamento.php');
            exit;
        }
        if($status == 'pronto'){
            $sql = "UPDATE tarefas SET status = :status WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header('location: gerenciamento.php');
            exit;
        }
    }

    // if (isset($_GET['atualizar_status'])) {
    //     $id = $_GET['atualizar_status'];
    //     $sql = "UPDATE tarefas set status = CASE 
    //     WHEN status = 'a fazer' THEN 'fazendo'
    //     WHEN status = 'fazendo' THEN 'pronto' 
    //     WHEN status = 'pronto' THEN 'a fazer'
    //     END WHERE id = :id";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(':id', $id);
    //     $stmt->execute();
    //     header('location: gerenciamento.php');
    //     exit;
    // }

    $sql = "SELECT tarefas.id as tarefa_id,
    tarefas.usuario as tarefa_usuario,
    tarefas.descricao as tarefa_descricao,
    tarefas.setor as tarefa_setor,
    tarefas.prioridade as tarefa_prioridade,
    tarefas.status as tarefa_status,
    usuarios.id as usuario_id,
    usuarios.nome as usuario_nome FROM tarefas JOIN usuarios ON tarefas.usuario = usuarios.id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tarefas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Tarefas</title>

    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <nav>
        <a href="./index.php">Cadastro de Usuário</a>
        <a href="./tarefas.php">Cadastro de Tarefas</a>
        <a href="./gerenciamento.php">Gerenciar Tarefas</a>
    </nav>

    <h1>Tarefas</h1>
    <div class="colunas">

        <div class="coluna">
            <h2>A Fazer</h2>
            <?php foreach ($tarefas as $tarefa): ?>
                <?php if ($tarefa['tarefa_status'] == 'a fazer'): ?>
                    <div class="pedido">
                        <p><strong>Descrição: </strong> <?=$tarefa['tarefa_descricao']?></p>
                        <p><strong>Setor: </strong> <?=$tarefa['tarefa_setor']?></p>
                        <p><strong>Prioridade: </strong><?=$tarefa['tarefa_prioridade']?></p>
                        <p><strong>Vinculado a: </strong><?=$tarefa['usuario_nome']?></p>


                        <form method="GET" action="./gerenciamento.php">
                            <button name="excluir" value="<?=$tarefa['tarefa_id']?>" onclick="return confirm('Voçê tem Certeza?')">Excluir</button>

                            <a href="./tarefaEditar.php?editar=<?=$tarefa['tarefa_id']?>"> Editar </a>
                            
                            <input type="hidden" name="id" value="<?=$tarefa['tarefa_id']?>">
                            <button type="submit">Alterar Status</button>
                            <select name="atualizar_status">
                                <option value="a fazer">A Fazer </option>
                                <option value="fazendo">Fazendo </option>
                                <option value="pronto">Pronto  </option>
                            </select>
                            
                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div> 

        <div class="coluna">
            <h2>Fazendo</h2>
            <?php foreach ($tarefas as $tarefa): ?>
                <?php if ($tarefa['tarefa_status'] == 'fazendo'): ?>
                    <div class="pedido">
                        <p><strong>Descrição: </strong> <?=$tarefa['tarefa_descricao']?></p>
                        <p><strong>Setor: </strong> <?=$tarefa['tarefa_setor']?></p>
                        <p><strong>Prioridade: </strong><?=$tarefa['tarefa_prioridade']?></p>
                        <p><strong>Vinculado a: </strong><?=$tarefa['usuario_nome']?></p>

                        <form method="GET" action="./gerenciamento.php">
                            <button name="excluir" value="<?=$tarefa['tarefa_id']?>" onclick="return confirm('Voçê tem Certeza?')">Excluir</button>

                            <a href="./tarefaEditar.php?editar=<?=$tarefa['tarefa_id']?>"> Editar </a>

                            <input type="hidden" name="id" value="<?=$tarefa['tarefa_id']?>">
                            <button type="submit">Alterar Status</button>
                            <select name="atualizar_status">
                                <option value="a fazer">A Fazer </option>
                                <option value="fazendo">Fazendo </option>
                                <option value="pronto">Pronto  </option>
                            </select>

                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div> 

        <div class="coluna">
            <h2>Pronto</h2>
            <?php foreach ($tarefas as $tarefa): ?>
                <?php if ($tarefa['tarefa_status'] == 'pronto'): ?>
                    <div class="pedido">
                        <p><strong>Descrição: </strong> <?=$tarefa['tarefa_descricao']?></p>
                        <p><strong>Setor: </strong> <?=$tarefa['tarefa_setor']?></p>
                        <p><strong>Prioridade: </strong><?=$tarefa['tarefa_prioridade']?></p>
                        <p><strong>Vinculado a: </strong><?=$tarefa['usuario_nome']?></p>

                        <form method="GET" action="./gerenciamento.php">
                            <button name="excluir" value="<?=$tarefa['tarefa_id']?>" onclick="return confirm('Voçê tem Certeza?')">Excluir</button>

                            <a href="./tarefaEditar.php?editar=<?=$tarefa['tarefa_id']?>"> Editar </a>

                            <input type="hidden" name="id" value="<?=$tarefa['tarefa_id']?>">
                            <button type="submit">Alterar Status</button>
                            <select name="atualizar_status">
                                <option value="a fazer">A Fazer </option>
                                <option value="fazendo">Fazendo </option>
                                <option value="pronto">Pronto  </option>
                            </select>

                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div> 

    </div>
    
</body>
</html>