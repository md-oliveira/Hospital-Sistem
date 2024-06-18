<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Pesquisar'])) {
    $Cep = preg_replace('/[^0-9]/', '', $_POST["_Endereco"]);
    
    $url = "https://viacep.com.br/ws/{$Cep}/json/";
    
    $response = file_get_contents($url);
    
    $data = json_decode($response, true);

    if (!isset($data['erro'])) {
        $rua = $data['logradouro'] ?? 'Não Encontrado';    
        $bairro = $data['bairro'] ?? 'Não Encontrado';
        $cidade = $data['localidade'] ?? 'Não Encontrado';
        $uf = $data['uf'] ?? 'Não Encontrado';
        $_Resultado = "{$uf}-{$cidade}-{$bairro}-{$rua}";
    } else {
        echo "Não foi Possível realizar a busca";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir</title>
</head>
<body>
    <form action="" method="POST">
        <div name="api-card">
            <label>Cep</label>
            <input type="text" required placeholder="Cep" name="_Endereco" value="<?php echo isset($_POST['_Endereco']) ? htmlspecialchars($_POST['_Endereco']) : ''; ?>"><br>
            <br>
            <input type="submit" name="Pesquisar" value="Pesquisar"><br>
            <br>
            <label>Logradouro</label>
            <p><?php echo isset($rua) ? htmlspecialchars($rua) : ''; ?></p><br>
                    
            <label>Bairro</label>
            <p><?php echo isset($bairro) ? htmlspecialchars($bairro) : ''; ?></p><br>
                    
            <label>Cidade</label>
            <p><?php echo isset($cidade) ? htmlspecialchars($cidade) : ''; ?></p><br>

            <label>Estado</label><br>
            <p><?php echo isset($uf) ? htmlspecialchars($uf) : ''; ?></p><br>
        </div>
    </form>

    <form action="query.php" method="post">
        <div id="CardCadastro">
            <label>Nome</label>
            <input type="text"  required placeholder="Nome" name="_Nome" value="<?php echo isset($_POST['_Nome']) ? htmlspecialchars($_POST['_Nome']) : ''; ?>"> <br>

            <label>Senha</label>
            <input type="password" required placeholder="Senha" name="_Senha" value="<?php echo isset($_POST['_Senha']) ? htmlspecialchars($_POST['_Senha']) : ''; ?>"> <br>

            <label>Gmail</label>
            <input type="email" required placeholder="Gmail" name="_Gmail" value="<?php echo isset($_POST['_Gmail']) ? htmlspecialchars($_POST['_Gmail']) : ''; ?>"> <br>

            <label>Cpf</label>
            <input type="text" required placeholder="Cpf" name="_Cpf" value="<?php echo isset($_POST['_Cpf']) ? htmlspecialchars($_POST['_Cpf']) : ''; ?>"> <br>
            
            <label>Nome de Usuário</label>
            <input type="text" required placeholder="Nome De Usuario" name="_NomeUsu" value="<?php echo isset($_POST['_NomeUsu']) ? htmlspecialchars($_POST['_NomeUsu']) : ''; ?>"><br>            

            <label>Data de Nascimento</label>
            <input type="date" required placeholder="Data de Nascimento" name="_Data" value="<?php echo isset($_POST['_Data']) ? htmlspecialchars($_POST['_Data']) : ''; ?>"><br>

            <input type="hidden" name="_Resultado" value="<?php echo isset($_Resultado) ? htmlspecialchars($_Resultado) : ''; ?>">

            <input type="submit" value="Cadastrar"><br>
        </div>    
    </form>
</body>
</html>