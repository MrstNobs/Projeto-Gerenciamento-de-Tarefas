<?php 
    include './php/Conexao.php';

    if(isset($_GET['editar'])){
        $EditarTarefaId = $_GET['editar'];
        
        $sql = "SELECT tarefas.id AS TarefaID,
        tarefas.usuario AS TarefaUser,
        tarefas.descricao AS TarefaDesc,
        tarefas.setor AS TarefaSetor,
        tarefas.prioridade AS TarefaPrior,
        tarefas.status AS TarefaStatus,
        usuarios.id AS UsuarioID,
        usuarios.nome AS UsuarioNome FROM tarefas JOIN usuarios ON tarefas.usuario = usuarios.id
        WHERE tarefas.id = :id ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $EditarTarefaId);
        $stmt->execute();
        $TUDOS = $stmt->fetch();
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $prioridadeEditado = $_POST['prioridadeEditado'];
        $descricaoEditado = $_POST['descricaoEditado'];
        $usuarioEditado = $_POST['usuarioEditado'];
        $setorEditado = $_POST['setorEditado'];
        $tarefaID = $_POST['tarefaID'];

        $sql = "UPDATE tarefas SET usuario = :usuarioEditado, descricao = :descricaoEditado, setor = :setorEditado, prioridade = :prioridadeEditado WHERE id = :tarefaID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usuarioEditado', $usuarioEditado);
        $stmt->bindParam(':descricaoEditado', $descricaoEditado);
        $stmt->bindParam(':setorEditado', $setorEditado);
        $stmt->bindParam(':prioridadeEditado', $prioridadeEditado);
        $stmt->bindParam(':tarefaID', $tarefaID);
        $stmt->execute();
        header('location: tarefas.php');
        exit;
    }

    $sql = "SELECT * FROM usuarios ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll();

    $prior = ['baixa', 'media', 'alta'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <nav>
        <a href="./index.php">Cadastro de Usuário</a>
        <a href="./tarefas.php">Cadastro de Tarefas</a>
        <a href="./gerenciamento.php">Gerenciar Tarefas</a>
    </nav>

    <h1> Cadastro de Tarefas </h1>
    <form method="POST" action="./tarefaEditar.php">
        <label for="descricao"> Descrição: </label>
        <input type="text" name="descricaoEditado" id="descricao" placeholder="Aqui" required> <br>

        <label for="setor"> Setor: </label>
        <input type="text" name="setorEditado" id="setor" placeholder="Aqui" required> <br>

        <label for="usuario"> Usuário</label>
        <select name="usuarioEditado" id="usuario" >

            <option value="<?php echo $TUDOS['UsuarioID'];?>" > <?php echo $TUDOS['UsuarioNome'];?> </option>
        
            <?php foreach($clientes as $cliente): ?>
                <?php if($cliente['id'] == $TUDOS['UsuarioID']){  ?>
                    <?php $cliente['id'] = null; // poderia deixar sem nada que já adiantaria também ?>
                <?php } else { ?>
                <option value="<?=$cliente['id']?>"> <?=$cliente['nome']?> </option>
                <?php } ?>
            <?php endforeach; ?>   
        
        </select> <br>

        <label for="prioridade">Prioridade: </label>
        <select name="prioridadeEditado" id="prioridade">
            <!-- Traz o a Prioridade da tabela Tarefa -->
            <option value="<?php echo $TUDOS['TarefaPrior'];?>"> <?php echo $TUDOS['TarefaPrior'];?>  </option>
            
            <!-- Se a Prioridade for e mesma do que da Tabela Tarefa então ele mostrar o restante das opções, sendo assim, evitando o valor duplicado -->
            <?php if($TUDOS['TarefaPrior'] == $prior[0]){ ?> 
                <option value="media"> Media </option>
                <option value="alta"> Alta </option>    
            <?php } ?>
            <?php if($TUDOS['TarefaPrior'] == $prior[1]){ ?> 
                <option value="baixa"> Baixa </option>
                <option value="alta"> Alta </option>    
            <?php } ?>
            <?php if($TUDOS['TarefaPrior'] == $prior[2]){ ?> 
                <option value="baixa"> Baixa </option>
                <option value="media"> Media </option>    
            <?php } ?>
        </select>

        <input type="hidden" name="tarefaID" value="<?php echo $EditarTarefaId;?>"> 
        <button type="submit"> Editar </button>
    </form>

    <script>    
        var descricao = document.getElementById('descricao');
        var setor = document.getElementById('setor');

        descricao.value = "<?php echo $TUDOS['TarefaDesc']; ?>";
        setor.value = "<?php echo $TUDOS['TarefaSetor'];?>";

    </script>
</body>
</html> 