<?php
    require_once('../InsertUsu/conn.php');
    session_start();
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
                echo"<meta http-equiv='refresh' content='1;url=MarcarConsult.php'>";
        
    
    } catch (Exception $e) {
        echo"<script>alert('Erro ao tentar excluir');</script>";
    }
