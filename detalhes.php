<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Programa Estudonauta</title>
</head>

<body>
    <h1>Detalhes do jogo</h1>
    <?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    // fazendo as includes (inclusão de função e banco)
    ?>
    <div id="corpo">
        <?php include "topo.php"; ?>

        <table class='detalhes'>
            <?php
            $cod = $_GET['cod'] ?? 0;
            $q = "SELECT * FROM jogos j WHERE j.cod = '$cod'";
            $busca = $banco->query($q);
            if (!$busca) {
                echo "Erro na consulta ao banco de dados: " . $banco->error;
            } else {
                if ($busca->num_rows == 1) {
                    $registro = $busca->fetch_object();
                    $thumb = thumb($registro->capa);
                    echo "<tr><td rowspan='3'><img class='grande' src='$thumb' />";
                    echo "<td><h2>$registro->nome</h2>";
                    echo "Nota: $registro->nota /10.0";
                    echo "<tr><td><p>$registro->descricao</p>";
                } else {
                    echo "<p>Nenhum registro encontrado</p>";
                }
            }
            ?>
        </table>
        <?php echo voltar() ?>
    </div>
    <?php include "rodape.php"; ?>
</body>

</html>