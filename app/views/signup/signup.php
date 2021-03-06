<p align="center" class="price"><b> Реєстрація нового користувача інтернет-магазину test-shop.com: </b></p>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div class="product">
        <b>Введіть Ваше ім'я (не більше 15 символів тексту латиницею):</b> 
        <input type="text" placeholder="<?php echo filter_input(INPUT_POST, 'firstname') !== null ? filter_input(INPUT_POST, 'firstname') : 'Alex'; ?>" 
               name="firstname" size="31">
    </div>
    <div class="product">
        <b>Введіть Ваше прізвище (не більше 20 символів тексту латиницею):</b> 
        <input type="text" placeholder="<?php echo filter_input(INPUT_POST, 'lastname') !== null ? filter_input(INPUT_POST, 'lastname') : 'Goodman'; ?>" 
               name="lastname" size="31">
    </div>
    <div class="product">
        <b>Введіть Ваш контактний номер телефону (не більше 10 цифр без знаків):</b> 
        <input type="text" placeholder="<?php echo filter_input(INPUT_POST, 'tel') !== null ? filter_input(INPUT_POST, 'tel') : '0501234567'; ?>" 
               name="tel" size="31">
    </div>
    <div class="product">
        <b>Введіть назву Вашої елетронної скриньки (не більше 30 символів тексту латиницею, 
            можуть також використовуватись цифри, тире і знак підкреслення):</b> 
        <input type="text" placeholder="<?php echo filter_input(INPUT_POST, 'emailCustomer') !== null ? filter_input(INPUT_POST, 'emailCustomer') :
            'abc@abc.com'; ?>" name="emailCustomer" size="31">
    </div>
    <div class="product">
        <b>Введіть назву Вашого міста (не більше 20 символів тексту латиницею):</b> 
        <input type="text" placeholder="<?php echo filter_input(INPUT_POST, 'city') !== null ? filter_input(INPUT_POST, 'city') : 'Uzhgorod'; ?>"
               name="city" size="31">
    </div>
    <div class="product">
        <b>Введіть пароль до Вашого облікового запису (від 8 до 16 символів (тільки малі латинські букви i цифри)):</b> 
        <input type="password" placeholder="some pass" name="pass_1" size="31">
    </div>
        <div class="product">
        <b>Введіть пароль ще раз:</b> 
        <input type="password" placeholder="same pass again" name="pass_2" size="31">
    </div>
    <input type="submit" value="Зареєструватись" name="signupButton">
</form>