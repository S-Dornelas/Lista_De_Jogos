<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Listagem de Jogos</title>
</head>

<body>
    <h1>LISTA DE JOGOS</h1>
    <?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    $ordem = $_GET['o'] ?? "nome";
    $chave = $_GET['c'] ?? "";
    ?>

    <div id="corpo">
        <?php include "topo.php"; ?>
        <!-- <?php
        echo msg_sucesso(' Arquivo aberto com sucesso!');
        echo msg_aviso(' Você esqueceu de colocar o nome!');
        echo msg_erro(' Ops! Falha no cadastro do jogo.');
        ?> -->

        <form method="get" id="busca" action="index.php">
            Ordenar:
            <a href="index.php?o=n&c=<?php echo $chave; ?>">Nome</a> |
            <a href="index.php?o=p&c=<?php echo $chave; ?>">Produtora</a> |
            <a href="index.php?o=n1&c=<?php echo $chave; ?>">Nota Alta</a> |
            <a href="index.php?o=n2&c=<?php echo $chave; ?>">Nota Baixa</a> |
            <a href="index.php">Mostrar todos</a> |
            Buscar: <input type="text" name="c" size="10" maxlength="40" />
            <input type="submit" value="ok" />
        </form>

        <table class="listagem">
            <?php
            $q = "SELECT jogos.cod, jogos.nome, jogos.descricao, jogos.nota, produtoras.produtora, produtoras.pais, genero.genero, jogos.capa FROM genero INNER JOIN jogos ON genero.cod = jogos.cod INNER JOIN produtoras ON produtoras.cod = jogos.cod ";

            if (!empty($chave)) {
                $q .= "WHERE jogos.nome LIKE '%$chave%' OR produtoras.produtora LIKE '%$chave%' OR genero.genero LIKE '%$chave%' ";
            }

            switch ($ordem) {
                case "p":
                    $q .= "ORDER BY produtoras.produtora";
                    break;
                case "n1":
                    $q .= "ORDER BY jogos.nota DESC";
                    break;
                case "n2":
                    $q .= "ORDER BY jogos.nota ASC";
                    break;
                default:
                    $q .= "ORDER BY jogos.nome";
                    break;
            }

            $busca = $banco->query($q);

            if (!$busca) {
                echo "<tr><td>Infelizmente a busca deu errado";
            } else {
                if ($busca->num_rows == 0) {
                    echo "<tr><td>Nenhum registro encontrado";
                } else {
                    while ($registro = $busca->fetch_object()) {
                        $t = thumb($registro->capa);
                        echo "<tr><td><img src='$t' class='mini'/>";
                        echo "<td><a href='detalhes.php?cod=$registro->cod'>$registro->nome</a>";
                        echo "[$registro->genero]";
                        echo "<br/>$registro->produtora";
                        echo "<br/>Nota: $registro->nota /10.0";
                        echo "<td>adm";
                    }
                }
            }

            ?>

        </table>
    </div>
    <?php include_once "rodape.php"; ?>
</body>

</html>