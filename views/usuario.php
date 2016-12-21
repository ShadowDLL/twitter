<br/>
<div class="feed">
    <?php foreach ($feed as $item ): ?>
    <strong><?php echo $item['nome']; ?> </strong> <?php echo $item['data_post']; ?><br/>
    <?php echo $item['mensagem']; ?><hr/>
    <?php endforeach; ?>
</div>

