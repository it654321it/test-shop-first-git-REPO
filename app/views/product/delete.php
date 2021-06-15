<div class="product">
    <h3 align="center"><b>Інформація про товар, який Ви хочете видалити:</b></h3>
</div>
<?php
$products =  $this->get('product');
?>
    <div class="product">
        <p class="sku">Код товару: <?php echo $products[1]?></p>
        <h4><?php echo $products[2]?><h4>
        <p> Ціна: <span class="price"><?php echo $products[3]?></span> грн</p>
        <p> Кількість: <?php echo $products[4]?></p>
        <p>Опис: <?php echo $products[5]; ?></p>
    </div>
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
    <input type="submit" value="Видалити" name="del">
</form>