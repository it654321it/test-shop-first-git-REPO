<?php
$customer =  $this->get('customer');
?>
<p align="center" class="price"><b> Ваші реєстраційні дані в test-shop.com: </b></p>
    <div class="product">
        <b>Ім'я: <?php echo $customer['first_name']?></b> 
    </div>
    <div class="product">
        <b>Прізвище: <?php echo $customer['last_name']?></b> 
     </div>
    <div class="product">
        <b>Контактний номер телефону: <?php echo $customer['telephone']?></b> 
    </div>
    <div class="product">
        <b>Елетронна скринька: <?php echo $customer['email']?></b> 
    </div>
    <div class="product">
        <b>Місто: <?php echo $customer['city']?></b> 
    </div>
    <div class="product">
        <b>Правo адміністрування сайту (додавати, редагувати та видаляти інфо про товар): <?php if ($customer['admin_role'] == 1) {echo 'Так';} else {echo 'Ні';}?></b>
    </div>
    <div class="product">
          <?= \Core\Url::getLink('/customer/list', '  Вернутись до списку всіх клієнтів'); ?>    
    </div>