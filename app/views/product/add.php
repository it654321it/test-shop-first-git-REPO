<p align="center" class="sku"><b> Додавання нового товару: </b></p>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div class="product">
        <b>Введіть артикул (sku) нового товару (не більше 30 символів тексту):</b> 
        <input type="text" name="newSKU" size="31">
    </div>
    <div class="product">
        <b>Введіть назву нового товару (не більше 30 символів тексту):</b> 
        <input type="text" name="newName" size="31">
    </div>
    <div class="product">
        <b>Введіть ціну нового товару (не більше 12 цифр цілої частини і до 2 цифр дрібної частини):</b> 
        <input type="text" name="newPrice" size="15">
    </div>
    <div class="product">
        <b>Введіть кількість нового товару (не більше 12 цифр):</b> 
        <input type="text" name="newQTY" size="13">
    </div>
    <div class="product">
        <b>Введіть опис нового товару (не більше 50 символів тексту):</b> 
        <input type="text" name="newDsc" size="51">
    </div>
    <input type="submit" value="Додати" name="ad">
</form>