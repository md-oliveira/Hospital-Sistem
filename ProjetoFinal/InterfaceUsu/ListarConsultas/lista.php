<?php 
session_start();
if(!isset($_SESSION['Cpf'])){
    // Se Sessão com Login não existir
    header("Location: ../Login/index.php");// Redireciona para index
    exit();
}
include_once("../../InsertUsu/conn.php");

$CpfPac = $_SESSION['Cpf'];

$stmt = $conn->prepare("SELECT consulta.*, medico.Nome AS NomeMedico, medico.AreaAtend
FROM consulta
INNER JOIN medico ON consulta.IdMed = medico.IdMed
WHERE consulta.CpfPac = :CpfPac
");
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
        $NomeMed = $resultado['NomeMedico'];
        $AreaAtend = $resultado['AreaAtend'];

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
                   // echo"<script>alert('Nenhuma Consulta encontrada faça o cadastro!')</script>;";
                   // echo"<meta http-equiv='refresh' content='1;url=../index.php'>";
                ?>
            
            <?php endif; ?>

            <div>
                <form action="deleteConsu.php" method="POST">
                    <h3>Deseja Cancelar a Consulta?</h3>
                    <h3>Essa ação não tem mais volta!</h3> 
                    <h3>Código da Consuta</h3>        
                    <input type="text" required placeholder="Código da Consulta" name ="_CodCons">
                    <br>
                    <br>
                    <br>    
                    <input type="submit" required placeholder="Código da Consulta" value ="Cancelar Consulta">   
                    <br>
                     <br>
                    <br>
                    <a href="../index.php">Voltar a página Home</a>
                </form>
            </div>    




    </body>
    </html>
