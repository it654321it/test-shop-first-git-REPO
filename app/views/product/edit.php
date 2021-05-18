<?php
$products =  $this->get('product');
$_POST['editSKU'] = $_POST['editName'] = $_POST['editPrice'] = $_POST['editQTY'] = $_POST['editDsc'] = $_POST['editButtonPressed'] = null;
?>
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<p><b> Редагування товару </b></p>
    <div class="product"><p>
        <b>Редагування артикулу (sku) товару (не більше 30 символів тексту):</b> 
        <input type="text" name="editSKU" size="31" placeholder="<?php echo $products['sku']?>">
    </div>
    <div class="product"><p>
        <b>Редагування назви товару (не більше 30 символів тексту):</b> 
        <input type="text" name="editName" size="31" placeholder="<?php echo $products['name']?>"></p>
    </div>
    <div class="product"><p>
        <b>Редагування ціни товару (не більше 12 цифр цілої частини і до 2 цифр дрібної частини):</b> 
        <input type="text" name="editPrice" size="15" placeholder="<?php echo $products['price']?>"></p>
    </div>
    <div class="product"><p>
        <b>Редагування кількості товару (не більше 12 цифр):</b> 
        <input type="text" name="editQTY" size="13" placeholder="<?php echo $products['qty']?>"></p>
    </div>
    <div class="product"><p>
        <b>Редагування опису товару (не більше 50 символів тексту):</b> 
        <input type="text" name="editDsc" size="51" placeholder="<?php echo $products['description']?>"></p>
    </div>
    <input type="submit" value="Редагувати" name="edit">
</form>
<div class="product"><p><b><?= \Core\Url::getLink('/product/list', 'Вернутись назад до списку усіх товарів'); ?></b></p></div>
    