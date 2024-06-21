<?php
session_start();
// Verifica se o usuário está logado
if(!isset($_SESSION['Cpf'])){
    // Se Sessão com Login não existir
    header("Location: ../Login/index.php");// Redireciona para index
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <nav>
        <a href="MarcarConsult.php">Marcar Consultas</a>
        <a href="ListarConsultas/lista.php">Minhas Consultas</a>
        <a href="ListarMedicos/lista.php">Nome e código de médicos</a>
        <a href="destroy.php">Sair</a>
    </nav>
   


</body>
</html>


