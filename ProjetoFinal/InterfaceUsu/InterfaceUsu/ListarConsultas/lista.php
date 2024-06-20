<?php 
include_once("../../InsertUsu/conn.php");
session_start();

$CpfPac = $_SESSION['Cpf'];

$stmt = $conn->prepare("SELECT * FROM consulta WHERE CpfPac = :CpfPac");
$stmt->bindParam(':CpfPac', $CpfPac);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($resultados) {
    $consultas = [];
    foreach ($resultados as $resultado) {
        $CodCons = $resultado['IdConsulta'];
        $Cpf = $resultado['CpfPac'];
        $Dia = $resultado['Dia'];
        $Hora = $resultado['Hora'];
        $Sintomas = $resultado['Sintomas'];
        $IdMed = $resultado['IdMed'];

        $stmt = $conn->prepare("SELECT Nome, AreaAtend FROM medico WHERE IdMed = :IdMed");
        $stmt->bindParam(':IdMed', $IdMed);
        $stmt->execute();
        $medico = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($medico) {
            $NomeMed = $medico['Nome'];
            $AreaAtend = $medico['AreaAtend'];
        }

        $consultas[] = [
            'CodCons' => $CodCons,
            'NomeMed' => $NomeMed,
            'AreaAtend' => $AreaAtend,
            'Dia' => $Dia,
            'Hora' => $Hora,
            'Sintomas' => $Sintomas
        ];
    }
} else {
    $consultas = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Consultas</title>
</head>
<body>
<h1>Minhas Solicitações</h1>

<?php if (!empty($consultas)) : ?>
    <table border="1">
        <tr>
            <th>Código Consulta</th>
            <th>Médico Responsável</th>
            <th>Área do Médico</th>
            <th>Dia</th>
            <th>Hora</th>
            <th>Sintomas</th>
            <th>Situação da Consulta</th>
        </tr>
        <?php foreach ($consultas as $c) : ?>
        <tr>
            <td><?php echo htmlspecialchars($c['CodCons']); ?></td>
            <td><?php echo htmlspecialchars($c['NomeMed']); ?></td>
            <td><?php echo htmlspecialchars($c['AreaAtend']); ?></td>
            <td><?php echo htmlspecialchars($c['Dia']); ?></td>
            <td><?php echo htmlspecialchars($c['Hora']); ?></td>
            <td><?php echo htmlspecialchars($c['Sintomas']); ?></td>
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
