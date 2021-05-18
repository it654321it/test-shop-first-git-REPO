<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<select name='sort'>
   <option <?php echo filter_input(INPUT_POST, 'sort') === 'pASC' ? 'selected' : '';?> value="pASC">від дешевших до дорожчих</option>
   <option <?php echo filter_input(INPUT_POST, 'sort') === 'pDESC' ? 'selected' : '';?> value="pDESC">від дорожчих до дешевших</option>
   <option <?php echo filter_input(INPUT_POST, 'sort') === 'qASC' ? 'selected' : '';?>  value="qASC">за зростанням кількості</option>
   <option <?php echo filter_input(INPUT_POST, 'sort') === 'qDESC' ? 'selected' : '';?>  value="qDESC">за спаданням кількості</option>
</select>
<input type="submit" value="Submit">
</form>

<div class="product"><p>
        <?= \Core\Url::getLink('/product/add', 'Додати товар'); ?>
</p></div>

<?php
$products =  $this->get('products');

foreach($products as $product)  :
?>

    <div class="product">
        <p class="sku">Код: <?php echo $product['sku']?></p>
        <h4><?php echo $product['name']?><h4>
        <p> Ціна: <span class="price"><?php echo $product['price']?></span> грн</p>
        <p> Кількість: <?php echo $product['qty']?></p>
        <p><?php if(!$product['qty'] > 0) { echo 'Нема в наявності'; } ?></p>
        <p>
            <?= \Core\Url::getLink('/product/edit', 'Редагувати', array('id'=>$product['id'])); ?>
        </p>
        <p>
            <?= \Core\Url::getLink('/product/delete', 'Видалити інфо про даний товар', array('id'=>$product['id'])); ?>
        </p>
    </div>
<?php endforeach; ?>