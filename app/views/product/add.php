<p><h3 align="center"><b> Додавання нового товару: </b></h3></p>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div class="product">
        <b>Артикул (перший символ-латинська літера, інші-цифри, і загалом-не більше 10 символів):</b> 
        <input type="text" name="newSKU" size="11" value="<?php 
        echo filter_input(INPUT_POST, 'newSKU') !== null ? filter_input(INPUT_POST, 'newSKU') : ''?>">
    </div>
    <div class="product">
        <b>Назва (всі символи-тільки латинські літери і не більше 30 (з пробілами)):</b> 
        <input type="text" name="newName" size="31" value="<?php 
        echo filter_input(INPUT_POST, 'newName') !== null ? filter_input(INPUT_POST, 'newName') : ''?>">
    </div>
    <div class="product">
        <b>Ціна (не більше 12 цифр цілої частини і до 2 цифр дрібної частини (розділовий знак-крапка)):</b> 
        <input type="text" name="newPrice" size="15"value="<?php 
        echo filter_input(INPUT_POST, 'newPrice') !== null ? filter_input(INPUT_POST, 'newPrice') : ''?>">
    </div>
    <div class="product">
        <b>Кількість (не більше 12 цифр):</b> 
        <input type="text" name="newQTY" size="13"value="<?php 
        echo filter_input(INPUT_POST, 'newQTY') !== null ? filter_input(INPUT_POST, 'newQTY') : ''?>">
    </div>
    <div class="product">
        <b>Опис (тільки латинськими літерами і не більше 50 літер (з пробілами)):</b> 
        <input type="text" name="newDsc" size="51"value="<?php 
        echo filter_input(INPUT_POST, 'newDsc') !== null ? filter_input(INPUT_POST, 'newDsc') : ''?>">
    </div>
    <input type="submit" value="Додати" name="ad">
</form>
<?php
if (filter_input(INPUT_POST, 'ad') === "Додати") {
    setcookie('addActionResult', 1, 0);
}
?>