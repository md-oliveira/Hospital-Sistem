<?php
session_start(); 
if(!isset($_SESSION['Cpf'])){
  // Se Sessão com Login não existir
  header("Location: ../Login/index.php");// Redireciona para index
  exit();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../InsertUsu/conn.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CodMed = htmlspecialchars($_POST["_CodMed"]);
    $Cpf = htmlspecialchars($_POST["_Cpf"]);
    $Dia = htmlspecialchars($_POST["_Data"]);
    $Hora = htmlspecialchars($_POST["_Hora"]);
    $Sintomas = htmlspecialchars($_POST["_Sintomas"]); 
    $stmt = $conn->prepare('SELECT med.IdMed, pac.Cpf FROM medico as med, paciente as pac 
                                                      WHERE med.IdMed = :CodMed AND pac.Cpf = :Cpf');
    $stmt->bindParam(':CodMed', $CodMed);
    $stmt->bindParam(':Cpf', $Cpf);    
    $stmt->execute();
    $Resultado = $stmt->fetch(PDO::FETCH_ASSOC); 
    if ($Resultado) {
        $_SESSION['Cpf'] = $Resultado['Cpf'];
        $stmt = $conn->prepare('SELECT med.Nome FROM medico as med WHERE IdMed = :CodMed');
        $stmt->bindParam(':CodMed', $CodMed);
        $stmt->execute();
        $NomeMed = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($NomeMed) {
            $_SESSION['nome_medico'] = $NomeMed['Nome'];
            
            $stmt =$conn->prepare('SELECT med.AreaAtend FROM medico as med WHERE IdMed =:CodMed');
            $stmt->bindParam(':CodMed',$CodMed);
            $stmt->execute();
            $AreaMed = $stmt->fetch(PDO::FETCH_ASSOC);
            if($AreaMed){
              $_SESSION['area_medico'] = $AreaMed['AreaAtend'];
              
              $count = $conn->prepare("SELECT * FROM consulta WHERE 
                                                      Dia =:Dia AND 
                                                      Hora =:Hora AND 
                                                      IdMed=:CodMed AND 
                                                      CpfPac=:Cpf");
              $count->bindParam(':Dia',$Dia);
              $count->bindParam(':Hora',$Hora);
              $count->bindParam(':CodMed',$CodMed);
              $count->bindParam(':Cpf',$Cpf);
              $count->execute();
              $resultado = $count->fetchAll();
               
              if(count($resultado) > 0){
                echo "<script>alert('Já existe uma consulta marcada tente outro dia e horário ');</script>";
                echo"<meta http-equiv='refresh' content='1;url=MarcarConsult.php'>";
              }else{
                $stmt = $conn->prepare('INSERT INTO consulta (IdMed,CpfPac,Dia,Hora,Sintomas) 
                                                VALUES (:CodMed,:Cpf,:Dia,:Hora,:Sintomas)');
                $stmt->bindParam(':CodMed',$CodMed);
                $stmt->bindParam(':Cpf',$Cpf);
                $stmt->bindParam(':Dia',$Dia);
                $stmt->bindParam(':Hora',$Hora);
                $stmt->bindParam(':Sintomas',$Sintomas);
                $stmt->execute();  
                echo "<script>alert('Cadastro Feito com Sucesso');</script>";
              }
             
              // Recuperar o ID do último registro inserido
              $ultimoID = $conn->lastInsertId();
              $stmt = $conn->prepare('SELECT * FROM consulta WHERE idConsulta = :ultimoID');
              $stmt->bindParam(':ultimoID', $ultimoID);
              $stmt->execute();
              $resultadoConsultaId = $stmt->fetch(PDO::FETCH_ASSOC);// dia, hora e id consulta
              //$_SESSION["newsession"]=$value;
              $_SESSION['ResultadoConsulta'] = $resultadoConsultaId['IdConsulta'];
              //echo $_SESSION['ResultadoConsulta'];
            }
        } else {
          echo"<script>alert('Credenciais Inválidas')</script>;";
          echo"<meta http-equiv='refresh' content='1;url=MarcarConsult.php'>";
        }
    } else {
        echo"<script>alert('Médico não encontrado')</script>;";
        echo"<meta http-equiv='refresh' content='1;url=MarcarConsult.php'>";
    } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmar</title>
</head>
<body>
  <form action="DeleteCons.php" method="POST">
    <h1>INFORMAÇÕES DA CONSULTA</h1>
    <div id ="info-med">
      <table style="width:15%" > 
        <h3>Informações do Médico</h3>
        <tr>
            <th>CÓDICO MÉDICO</th>
            <th>NOME MÉDICO</th>
            <th>ÁREA DE ATENDIMENTO</th>
        </tr> 
        <tr>  
            <td><?php echo $CodMed ?></td>
            <td><?php echo $_SESSION['nome_medico']?></td>
            <td><?php echo $_SESSION['area_medico']  ?></td>
        </tr>
      </table>
    </div>
    <br>
      <br>
    <br>
      <br>
    <br>
    <br>
    <div id="info-pac">
      <table style="width:15%">
      <h3>Informações do paciente e Consulta</h3> 
        <tr>
            <th>Nome Paciente</th>
            <th>Cpf Paciente</th>
            <th>Data Consulta</th>
            <th>Horário Consulta</th>
            <th>Sintomas</th>
        </tr>
          <tr>
            <td><?php echo $_SESSION["NomeUsu"]?></td>
            <td><?php echo $Cpf?></td>
            <td><?php echo $Dia?></td>
            <td><?php echo $Hora ?></td>
            <td><?php echo $Sintomas?></td>
          </tr>
      </table>  
    </div>
  



    <h3>Os dados estão incorretos?</h3>
    <h4>Delete a Solicitação</h4>
    <h4>Essa ação não tem mais volta</h4>
    <input type="submit" value="Deletar Consulta">
    <br>
      <br>
    <br>  
    <a href="index.php">Voltar a página Home</a>
  </form>
</body>
</html>















   




























   