<?php 
    echo "<footer>";
    echo "<p>Acessado por " . $_SERVER['REMOTE_ADDR'] . " em " . date('d/m/y') . "</p>";
    echo "<p>Desenvolvido por Sandro Dornelas &copy 2023</p>";
    echo "</footer>";
    $banco->close()
?>