<?php
     if( $_COOKIE['addActionResult'] == 1) {
        echo "<script type='text/javascript'>alert('Дані про новий товар додано! "
         . "Нижче можна переглянути внесену інформацію і додатково, при потребі, відредагувати її та заново зберегти!');</script>"; 
        setcookie('addActionResult', 0, 0);
      }
$products =  $this->get('product');
$_POST['editSKU'] = $_POST['editName'] = $_POST['editPrice'] = $_POST['editQTY'] = $_POST['editDsc'] = $_POST['editButtonPressed'] = null;
?>
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<p><h3  align="center"> Редагування наявної інформації про товар: </h3></p>
    <div class="product"><p>
        <b>Новий артикул  (перший символ-латинська літера, інші-цифри, і загалом-не більше 10 символів):</b> 
        <input type="text" name="editSKU" size="31" value="<?php 
        echo $products['sku'] !== null ? $products['sku'] : ''?>"></p>
    </div>
    <div class="product"><p>
        <b>Нова назва (всі символи-тільки латинські літери і не більше 30 (з пробілами)):</b> 
        <input type="text" name="editName" size="31" value="<?php 
        echo $products['name'] !== null ? $products['name'] : ''?>"></p>
    </div>
    <div class="product"><p>
        <b>Нова ціна (не більше 12 цифр цілої частини і до 2 цифр дрібної частини (розділовий знак-крапка))):</b> 
        <input type="text" name="editPrice" size="15" value="<?php 
        echo $products['price'] !== null ? $products['price'] : ''?>"></p>
    </div>
    <div class="product"><p>
        <b>Нова кількість (не більше 12 цифр):</b> 
        <input type="text" name="editQTY" size="13" value="<?php 
        echo (int)($products['qty']) !== null ? (int)($products['qty']) : ''?>"></p>
    </div>
    <div class="product"><p>
        <b>Новий опис (тільки латинськими літерами і не більше 50 літер (з пробілами)):</b> 
        <input type="text" name="editDsc" size="51" value="<?php 
        echo $products['description'] !== null ? $products['description'] : ''?>"></p>
    </div>
    <input type="submit" value="Застосувати редагування" name="edit">
</form>
<div class="product"><p><b><?= \Core\Url::getLink('/product/list', 'Вернутись до списку усіх товарів'); ?></b></p></div>