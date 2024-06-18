<?php 
    include_once("../../InsertUsu/conn.php");
    //var_dump($conn);
    session_start();
    //$NomeMed = $_SESSION['nome_medico'];
    //$IdCons = $_SESSION['ResultadoConsulta'];
    //$AreaMed = $_SESSION['area_medico']; 
    $CpfPac =   $_SESSION['Cpf'];
    //var_dump($CpfPac);            

    $sql = $conn->prepare("SELECT IdMed,Dia,Hora,Sintomas FROM consulta WHERE CpfPac=:CpfPac");
    $sql->bindParam(":CpfPac", $CpfPac);
    $sql->execute();
    $Busca = $sql->fetch(PDO::FETCH_ASSOC); 
    //var_dump($Busca);
    //$IdMed=$Busca["IdMed"];
    //$Dia=$Busca["Dia"];
    //$Hora=$Busca["Hora"];
    //$Sintomas=$Busca["Sintomas"];
    //echo($Sintomas);

    if ($Busca) {
        // Exibir uma lista de consultas
        echo "<ul>";
        foreach ($Busca as $consulta) {
            echo "<li>";
            print_r ($consulta["IdMed"]);
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "Nenhuma consulta encontrada.";
    }


?>

<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Consultas</title>
</head>
<body>
<h1>Minhas Solicitações</h1>

    <table>
        <tr>
            <th>Médico Responsável</th>
            <th>Área do Médico</th>
            <th>Situação da Consulta</th>
        </tr>
            <td>Jurandir</td>
            <td>Psicologo</td>
            <td>Análise</td>
        <tr>


        </tr>

    </table>



</body>
</html>







