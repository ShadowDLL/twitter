<form method="POST">
    <div style="border:1px solid #000000; margin:auto;padding:20px;width:200px;margin-top:100px;">
        <h2>Tela de Cadastro</h2>
        Nome:<br/>
        <input type="text" name="nome" autofocus/><br/><br/>
        Email:<br/>
        <input type="email" name="email" /><br/><br/>
        Senha:<br/>
        <input type="password" name="senha" /><br/><br/>
        <input type="submit" value="Cadastrar" />
        <?php
            if (!empty($aviso)) {
                echo ("<br/>".$aviso);
            }
        ?>
    </div>
</form>
