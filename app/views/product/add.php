<div align="center">
    <h3><b>Додати інформацію про новий товар</b></h3>
</div>
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
        <b>Введіть ціну нового товару (не більше 12 цифр цілої частини і не більше 2 цифр дрібної частини (крапка для розділення)):</b> 
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
<?php
if (filter_input(INPUT_POST, 'ad') === "Додати") {
    setcookie('addActionResult', 1, 0);
}
?>