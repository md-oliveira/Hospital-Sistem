<?php
 include_once("../../InsertUsu/conn.php");
 session_start();
    $CodMed = 0;
    //echo $CodMed;
    $stmt = $conn->prepare("SELECT Nome , AreaAtend FROM medico WHERE  IdMed > :CodMed");
    $stmt->bindParam(":CodMed",$CodMed);
    $stmt->execute();
    $resultado = $stmt->fetchAll();

    if($resultado){
        $consulta =[];
        foreach($resultado as $r){
        $NomeMed = $r['Nome'];
        $AreaMed = $r['AreaAtend'];

        $consulta [] = [
            'Nome' => $NomeMed,
            'AreaAtend' => $AreaMed

        ];
        //var_dump($consulta);
    }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Médicos</title>
</head>
<body>
    <?php if (!empty($consulta)): ?>
    <table>
        <tr>
            <th>Nome do Médico</th>
            <th>Área Médico</th>
        </tr>
        <?php foreach($consulta as $c) :?>
        <tr>
            <td><?php echo htmlspecialchars($c['Nome']);?></td>
            <td><?php echo htmlspecialchars($c['AreaAtend'])?></td>
            <td></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else :
    echo"<script>alert('Nenhuma Consulta encontrada faça o cadastro!')</script>;";
    echo"<meta http-equiv='refresh' content='1;url=../index.php'>";
?>

<?php endif; ?>





</body>
</html>