<?php
use Core\Controller;
$maxPrice = 0;
foreach ($products as $product) {
    if ( $maxPrice < $product['price']) {
        $maxPrice = $product['price'];
    }
}
setcookie('maxPrice', $maxPrice, 0);

if (filter_input(INPUT_POST, 'sort') !== null) {
        setcookie('sort', filter_input(INPUT_POST, 'sort'), 0);
} 

if ( filter_input(INPUT_POST, 'prcFrom') !== null && filter_input(INPUT_POST, 'prcTo') !== null) {
        setcookie('prcFrom', filter_input(INPUT_POST, 'prcFrom'), 0);
        setcookie('prcTo', filter_input(INPUT_POST, 'prcTo'), 0);
} 
?>
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<select name='sort'>
   <option <?php echo filter_input(INPUT_POST, 'sort') === 'pASC' ? 'selected' : '';?> value="pASC">від дешевших до дорожчих</option>
   <option <?php echo filter_input(INPUT_POST, 'sort') === 'pDESC' ? 'selected' : '';?> value="pDESC">від дорожчих до дешевших</option>
   <option <?php echo filter_input(INPUT_POST, 'sort') === 'qASC' ? 'selected' : '';?>  value="qASC">за зростанням кількості</option>
   <option <?php echo filter_input(INPUT_POST, 'sort') === 'qDESC' ? 'selected' : '';?>  value="qDESC">за спаданням кількості</option>
</select>
    <p></p>
    <p>
    Ціна від: <input type="text" name="prcFrom" size="14" placeholder="0">
    Ціна до: <input type="text" name="prcTo" size="14" placeholder="<?php echo $maxPrice ?>">
    </p>
<input type="submit" value="Submit">
</form>
<div class="product" align="center">
    <h3><b><?= \Core\Url::getLink('/product/add', 'Додати товар'); ?></b></h3>
</div>
<?php
$products =  $this->get('products');
foreach($products as $product)  :
?>
    <div class="product">
        <p class="sku">Код: <?php echo htmlspecialchars_decode($product['sku'])?></p>
        <h4><?php echo htmlspecialchars_decode($product['name'])?><h4>
        <p> Ціна: <span class="price"><?php echo $product['price']?></span> грн</p>
        <p> Кількість: <?php echo $product['qty']?></p>
        <p> Опис: <?php echo htmlspecialchars_decode($product['description'])?></p>
        <p><?php if(!$product['qty'] > 0) { echo 'Нема в наявності'; } ?></p>
        <p>
            <?= \Core\Url::getLink('/product/edit', 'Редагувати', array('id'=>$product['id'])); ?>
        </p>
        <p>
            <?= \Core\Url::getLink('/product/delete', 'Видалити інфо про даний товар', array('id'=>$product['id'])); ?>
        </p>
    </div>
<?php endforeach; ?>