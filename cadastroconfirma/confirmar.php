<?php
if (isset($_GET['h']) && !empty($_GET['h'])) {
    $status = addslashes($_GET['h']);
    $u = new usuarios($status);
    $u->ativarUsuario();
    echo "Cadastro confirmado com sucesso!";
    echo "<br/><a href='http://www.twitter.orlnet.xyz'>Ir para a página inicial</a>";
}

