<p><h3 align="center"><b> Ваше замовлення: </b></h3></p>
<div class="product">
 <?php
if( session_status( ) == 2 ) {   
    $sumQty = $sumPrc = 0;
    
for ($i=1; $i<=@$_SESSION['OrderedRate']; $i++):    
    $sumQty += @$_SESSION[(string)('orderedQty'.$i)][0];
    $sumPrc += @$_SESSION[(string)('orderedPrice'.$i)][0] * @$_SESSION[(string)('orderedQty'.$i)][0];
?>
<p><b>№ позиції замовлення:</b> <?php echo $i?></p>
<p><b>Акртикул:</b> <?php echo @$_SESSION[(string)('orderedSku'.$i)][0]?></p>
<p><b>Назва:</b> <?php echo@$_SESSION[(string)('orderedName'.$i)][0]?></p>
<p><b>Ціна:</b> <?php echo@$_SESSION[(string)('orderedPrice'.$i)][0]?> грн</p>
<p><b>Кількість:</b> <?php echo@$_SESSION[(string)('orderedQty'.$i)][0]?> шт.</p>
<p><b>До сплати по даному артикулу:</b> <?php 
echo @$_SESSION[(string)('orderedPrice'.$i)][0] * @$_SESSION[(string)('orderedQty'.$i)][0]?> грн.</p>
<p><h5 align="right"><b><?= \Core\Url::getLink('/product/delete', 'Не замовляти даний арктиул'); ?></b></h5></p>
***************************************************************************************************************************************************************************************************
<?php endfor; 
}
?>
</div>
<h3 align="center"><b>Всього замовлено: </b></h3>
<h4 align="center"><b>товарів:</b> <?php echo $sumQty?> шт., <b>на суму:</b> <?php echo $sumPrc?> грн. </h4>
<h4><b><?= \Core\Url::getLink('/product/cardpay', 'Оплатити товар'); ?></b></h4>
<h4 align="right"><b><?= \Core\Url::getLink('/product/deleteOrder', 'Відмовитись від усього'); ?></b></h4>