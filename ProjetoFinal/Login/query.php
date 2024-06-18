<?php 
try{
    require_once "../InsertUsu/conn.php";
    session_start();
}catch(Exception $e){ 
    print_r($e);}

    if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $NomeUsu = htmlspecialchars($_POST["_NomeUsu"]);
    $Senha = $_POST['_Senha'];

    try{
        $stmt = $conn ->prepare('SELECT * FROM paciente WHERE NomeUsu = :NomeUsu');
        $stmt -> bindParam(':NomeUsu',$NomeUsu);
        $stmt -> execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if($resultado)
        {
            //Verifica se a senha criptografada está correta
            if(password_verify($Senha,$resultado['Senha']))
            {   $_SESSION["NomeUsu"] = $NomeUsu;
                echo "<script>alert('Login feito com sucesso!');</script>";
                echo"<meta http-equiv='refresh' content='1;url=../InterfaceUsu/index.php'>";
                
            }else{
                echo "<script>alert('Senha Incorreta');</script>";
                echo"<meta http-equiv='refresh' content='1;url= index.php'>";
            }
        }else{
            echo "<script>alert('Usuário não encontrado');</script>";
            echo"<meta http-equiv='refresh' content='1;url= index.php'>";
        }
    }catch(PDOException $e){
        echo "Erro no login:".$e->getMessage();
        print($e);
    }
}
