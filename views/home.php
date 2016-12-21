<div class="feed">
    <form method="POST">
        <textarea name="msg" class="textareapost" autofocus ></textarea><br/>
        <input type="submit" value="Enviar" />
    </form>
    <?php foreach ($feed as $item ): ?>
    <a href="usuario/posts?id_usuario=<?php echo $item['id_usuario']; ?>"><?php echo $item['nome']; ?> </a><br/>
    <?php echo ($item['mensagem']." - ".$item['data_post']); ?><hr/>
    <?php endforeach; ?>
</div>
<div class="rightside">
    <h4>Relacionamentos</h4>
    <div class="rs-meio"><?php echo $id_seguido; ?><br/>Seguidores</div>
    <div class="rs-meio"><?php echo $id_seguidor; ?><br/>Seguindo</div>
    <div style="clear: both;"></div>
    <h4>Sugestões de Amigos</h4>
    <table border="0" width="100%">
        <tr>
            <td width="80%"></td>
            <td></td>
        </tr>
        <?php foreach($sugestao as $usuario): ?>
        <tr>
            <td><a href="usuario/posts?id_usuario=<?php echo $usuario['id']; ?>"><?php echo $usuario['nome']; ?></a></td>
            <td>
                <?php if($usuario['seguido'] == '0'): ?>
                <a href="home/seguir/<?php echo $usuario['id']; ?>">Seguir</a>
                <?php else: ?>
                <a href="home/naoSeguir/<?php echo $usuario['id']; ?>">Seguindo</a>
                <?php endif;?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
