<p align="center" class="price"><b> Введіть Ваші дані для входу в систему </b></p>

<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div class="product">
        <b>Введіть назву Вашої елетронної скриньки:</b> 
        <input type="text" placeholder="email@email.com" name="email" size="31">
    </div>
    <div class="product">
        <b>Введіть пароль до Вашого облікового запису:</b> 
        <input type="password" placeholder="some pass" name="password" size="31">
    </div>
    <input type="submit" value="Увійти" name="logincheck"> <!
</form>