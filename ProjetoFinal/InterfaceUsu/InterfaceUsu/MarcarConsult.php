<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requisição de Consultas</title>
</head>
<body>
            
    <form action="Registro.php" method="POST">
        <label>Digite o Código do seu Médico</label>
            <input type="text" required  placeholder="Códico Médico" name="_CodMed">
        <br>
        <label>Digite Seu CPF</label>
            <input type="text" required placeholder="CPF" name="_Cpf" > 
        <br>
       <label>Escolha o Dia</label>
            <input type="date" required placeholder="Data" name="_Data">
        <br>   
        <label>Escolha o Horário para a consulta</label>
            <input type="time" required placeholder="Hora" step="3600"  min="8:00" max="22:00" name="_Hora" >
        <br>
        <label>O que você está sentindo?</label><br>
            <textarea name="_Sintomas" cols="30" rows="10"></textarea>
        <br>
        
        <input type="submit" value="Cadastrar Consulta">

    </form>
    

</body>
</html>