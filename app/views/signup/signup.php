<?php
//use Controllers\SignupController; // - не працює правильно
//$_POST['newSKU'] = $_POST['newName'] = $_POST['newPrice'] = $_POST['newQTY'] = $_POST['newDsc'] = $_POST['buttonPressed'] = null;
?>
<p align="center" class="price"><b> Реєстрація нового користувача інтернет-магазину test-shop.com: </b></p>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div class="product">
        <b>Введіть Ваше ім'я (не більше 15 символів тексту латиницею):</b> 
        <input type="text" placeholder="Alex" name="firstname" size="31">
    </div>
    <div class="product">
        <b>Введіть Ваше прізвище (не більше 20 символів тексту латиницею):</b> 
        <input type="text" placeholder="Good" name="lastname" size="31">
    </div>
    <div class="product">
        <b>Введіть Ваш контактний номер телефону (не більше 10 цифр без знаків):</b> 
        <input type="number" placeholder="0501234567" name="tel" size="31">
    </div>
    <div class="product">
        <b>Введіть назву Вашої елетронної скриньки (не більше 30 символів тексту латиницею, без цифр):</b> 
        <input type="text" placeholder="abc@abc.com" name="emailcheck" size="31">
    </div>
    <div class="product">
        <b>Введіть назву Вашого міста (не більше 20 символів тексту латиницею):</b> 
        <input type="text" placeholder="Uzhgorod" name="city" size="31">
    </div>
    <div class="product">
        <b>Введіть пароль до Вашого облікового запису (від 8 до 16 символів (тільки латинські букви або цифри)):</b> 
        <input type="password" placeholder="some pass" name="pass_1" size="31">
    </div>
        <div class="product">
        <b>Введіть пароль ще раз:</b> 
        <input type="password" placeholder="some pass" name="pass_2" size="31">
    </div>
    <input type="submit" value="Увійти" name="signupcheck">
</form>
<?php
//if( filter_input(INPUT_POST, 'logincheck') !== null )
// {
//    time_nanosleep(0, 300000);// — Задержка на заданное число секунд и наносекунд
//    //echo "<script type='text/javascript'>window.alert('Дані про товар внесені !');</script>";//працює НАВІТЬ ТОДІ КОЛИ НЕ ТРЕБА 
//    //із заданою затримкою, але потім виводить ту саму сторінку
// }
//echo 'запускаємо метод Helper::redirect(_product/list_) в deleteAction()' . '<br>'; // - не працює правильно
// LoginAction();//запускається - і відразу перенаправляє на .../product/list
?>