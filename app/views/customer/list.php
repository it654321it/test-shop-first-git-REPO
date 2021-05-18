<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<select name='sortfirst'>
    <option <?php echo filter_input(INPUT_POST, 'sortfirst') === 'last_name_ASC' ? 'selected' : '';?> value="last_name_ASC">Сортувати за прізвищем від A до Я</option>
    <option <?php echo filter_input(INPUT_POST, 'sortfirst') === 'last_name_DESC' ? 'selected' : '';?> value="last_name_DESC">Сортувати за прізвищем від Я до А</option>
</select>
<select name='sortsecond'>
  <option <?php echo filter_input(INPUT_POST, 'sortsecond') === 'email_ASC' ? 'selected' : '';?>  value="email_ASC">Сортувати за ел.адересою від A до Я</option>
  <option <?php echo filter_input(INPUT_POST, 'sortsecond') === 'email_DESC' ? 'selected' : '';?>  value="email_DESC">Сортувати за ел.адересою від Я до A</option>
</select>
<input type="submit" value="Submit">
</form>

<div class="product"><p>
        <?= \Core\Url::getLink('/customer/add', 'Додати інфо про нового клієнта'); ?>
</p></div>
<?php

$customers =  $this->get('customer');

foreach($customers as $customer)  :
?>

    <div class="product">
        <h4>Прізвище: <?php echo $customer['last_name']?></h4>
        <h4>Ел. адреса: <?php echo $customer['email']?><h4>
        <p>Ім"я: <span class="price"><?php echo $customer['first_name']?></span></p>
        <p>Номер конт. телефону: <?php echo $customer['telephone']?></p>
        <p>Місто: <?php echo $customer['city']; ?></p>
        <p>
            <?= \Core\Url::getLink('/customer/edit', 'Редагувати інфо про клієнта', array('customer_id'=>$customer['customer_id'])); ?>
        </p>
    </div>
<?php endforeach; ?>

