<?php
    session_start();
    if(!isset($_SESSION['Cpf'])){
        // Se Sessão com Login não existir
        header("Location: ../Login/index.php");// Redireciona para index
        exit();
    }
    require_once('../InsertUsu/conn.php');
    //var_dump($_SESSION['ResultadoConsulta']);
    $IdCons = $_SESSION['ResultadoConsulta'];
    //preg_match('/\d+/', $IdCons, $matches);
    //echo($IdCons);
    try {
        $stmt = $conn->prepare('DELETE FROM consulta 
                                       WHERE IdConsulta = :IdCons');
        $stmt->bindParam(':IdCons',$IdCons);
        $stmt->execute();
        
        echo "<script>alert('Consulta Deletada, Essa ação não pode ser desfeita!');</script>";
        echo"<meta http-equiv='refresh' content='1;url=index.php'>";
        
    
    } catch (Exception $e) {
        echo"<script>alert('Erro ao tentar excluir');</script>";
    }
