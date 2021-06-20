<p><h3 align="center"><b> Оплата замовленого товару: </b></h3></p>
<div class="product">
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <b>Номер банківської картки (16 цифр):</b> 
      <input type="text" name="bankCardNumber" size="17" value="<?php 
        echo filter_input(INPUT_POST, 'bankCardNumber') !== null ? filter_input(INPUT_POST, 'bankCardNumber') : ''?>">
      <br><br>
      <b>Термін дії банківської картки (2 цифр - місяць, 2 цифри - рік (через кому)):</b> 
      <input type="text" name="bankCardTime" size="5" value="<?php 
        echo filter_input(INPUT_POST, 'bankCardTime') !== null ? filter_input(INPUT_POST, 'bankCardTime') : ''?>">
      <br><br>
      <b>Тризначний CVV-код банківської картки (3 цифри):</b> 
      <input type="text" name="cvv" size="4" value="<?php 
        echo filter_input(INPUT_POST, 'cvv') !== null ? filter_input(INPUT_POST, 'cvv') : ''?>">
      <br><br>
      <input type="submit" value="Оплатити" name="payByCard">
</form>
</div>