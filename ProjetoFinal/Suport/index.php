<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Suporte</title>
</head>
<body>
    <div class="container">
        <div class="right">
            <h2>Suporte</h2>
            <br><br>
                <form action="relatorio.php" method="POST">
                    <style>
                        .ocorrido{
                                width: 300px; 
                                height: 50px;
                            }
                    </style>

                    <h3>Nos informe quem é você!</h3>

                    
                    <input type="text" required placeholder="Nome Completo" name="_Nome"> <br>

                    
                    <input type="text" required placeholder="Cpf" name="_Cpf"><br>

                    
                    <input type="email" required placeholder="Email" name="_Email">
                    <br>
                    
                    <textarea class="ocorrido" required placeholder="Ocorrido" name="_Ocorrido"></textarea><br>
                
                    <input type="submit" value="Enviar" >        
                
                </form>
            </div>
        </div>    
    </body>
</html>