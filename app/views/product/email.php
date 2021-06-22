<p><h3 align="center"><b> Для відправки даного замовлення на Вашу електронну скриньку будь ласка заповніть наступні поля: </b></h3></p>
<div class="product">
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <b>Ваша елетронна скринька:</b> 
      <input type="text" name="emailOrder" size="50" value="<?php 
        echo filter_input(INPUT_POST, 'emailOrder') !== null ? filter_input(INPUT_POST, 'emailOrder') : '';
            if (filter_input(INPUT_POST, 'sendOrderToEmail') !== null) { 
                if( session_status( ) == 2 ) {   
                    @$_SESSION['sendEmailNameOrder'] = filter_input(INPUT_POST, 'emailOrder');
                }      
            }
        ?>">
      <br><br>
        <b>Тема листа:</b> 
        <input type="text" name="emailTheme" size="150" value="<?php 
        echo filter_input(INPUT_POST, 'emailTheme') !== null ? filter_input(INPUT_POST, 'emailTheme') : '';    
            if (filter_input(INPUT_POST, 'sendOrderToEmail') !== null) { 
                if( session_status( ) == 2 ) {   
                    @$_SESSION['sendEmailThemeOrder'] = filter_input(INPUT_POST, 'emailTheme');
                }      
            }
        ?>">
      <br><br>
      <input type="submit" value="Відправити на електронку" name="sendOrderToEmail">
</form>
</div>