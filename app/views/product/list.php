<?php
use Core\Controller;

$maxPrice = 0;

foreach ($products as $product) {
    if ( $maxPrice < $product['price']) {
        $maxPrice = $product['price'];
    }
}
setcookie('maxPrice', $maxPrice, 0);

if (filter_input(INPUT_POST, 'sort') !== null) {
        setcookie('sort', filter_input(INPUT_POST, 'sort'), 0);
} 

if ( filter_input(INPUT_POST, 'prcFrom') !== null && filter_input(INPUT_POST, 'prcTo') !== null) {
        setcookie('prcFrom', filter_input(INPUT_POST, 'prcFrom'), 0);
        setcookie('prcTo', filter_input(INPUT_POST, 'prcTo'), 0);
} 
             
    function getSelection ($choise = '') 
    {
        switch ($choise) {
            case 'pDESC':
                $selected2 = 'selected';
                break;

            case 'qASC':
                $selected3 = 'selected';
                break;

            case 'qDESC':
                $selected4 = 'selected';
                break;
            
            case 'pASC':
            default:
                $selected1 = 'selected';
                break;
            }
            
    return @array($selected1, $selected2, $selected3, $selected4);
    }

    if (@$_COOKIE['sort'] === null && filter_input(INPUT_POST, 'sort') === null) {
        list ($selected1, $selected2, $selected3, $selected4) = getSelection();
    }
    else if (@$_COOKIE['sort'] !== null && filter_input(INPUT_POST, 'sort') === null) {
                list ($selected1, $selected2, $selected3, $selected4) = getSelection($_COOKIE['sort']);
            } 
            else if (@$_COOKIE['sort'] === null && filter_input(INPUT_POST, 'sort') !== null ||
                            @$_COOKIE['sort'] !== null && filter_input(INPUT_POST, 'sort') !== null) {   
                        list ($selected1, $selected2, $selected3, $selected4) = getSelection(filter_input(INPUT_POST, 'sort'));
                    }

if (@$_COOKIE['prcFrom'] === null && @$_COOKIE['prcTo'] === null 
        && filter_input(INPUT_POST, 'prcFrom') === null && filter_input(INPUT_POST, 'prcTo') === null
        ||
        @$_COOKIE['prcFrom'] === null && @$_COOKIE['prcTo'] === null 
        && filter_input(INPUT_POST, 'prcFrom') === null && filter_input(INPUT_POST, 'prcTo') !== null
        ||
        @$_COOKIE['prcFrom'] === null && @$_COOKIE['prcTo'] === null 
        && filter_input(INPUT_POST, 'prcFrom') !== null && filter_input(INPUT_POST, 'prcTo') === null
        ||
        @$_COOKIE['prcFrom'] === null && @$_COOKIE['prcTo'] !== null 
        && filter_input(INPUT_POST, 'prcFrom') === null && filter_input(INPUT_POST, 'prcTo') === null
        ||
        @$_COOKIE['prcFrom'] !== null && @$_COOKIE['prcTo'] === null 
        && filter_input(INPUT_POST, 'prcFrom') === null && filter_input(INPUT_POST, 'prcTo') === null
        ||
        @$_COOKIE['prcFrom'] === null && @$_COOKIE['prcTo'] !== null 
        && filter_input(INPUT_POST, 'prcFrom') === null && filter_input(INPUT_POST, 'prcTo') !== null
        ||
        @$_COOKIE['prcFrom'] !== null && @$_COOKIE['prcTo'] === null 
        && filter_input(INPUT_POST, 'prcFrom') === null && filter_input(INPUT_POST, 'prcTo') !== null
        ||
        @$_COOKIE['prcFrom'] !== null && @$_COOKIE['prcTo'] === null 
        && filter_input(INPUT_POST, 'prcFrom') !== null && filter_input(INPUT_POST, 'prcTo') === null) {
    
$selectedPriceMin = 0;
$selectedPriceMax = $maxPrice;
}
else if (@$_COOKIE['prcFrom'] !== null && @$_COOKIE['prcTo'] !== null 
               && filter_input(INPUT_POST, 'prcFrom') === null && filter_input(INPUT_POST, 'prcTo') === null
            ||
            @$_COOKIE['prcFrom'] !== null && @$_COOKIE['prcTo'] !== null  
               && filter_input(INPUT_POST, 'prcFrom') !== null && filter_input(INPUT_POST, 'prcTo') === null
            ||
            @$_COOKIE['prcFrom'] !== null && @$_COOKIE['prcTo'] !== null  
               && filter_input(INPUT_POST, 'prcFrom') === null && filter_input(INPUT_POST, 'prcTo') !== null) {
    
       $selectedPriceMin = $_COOKIE['prcFrom'];
       $selectedPriceMax = $_COOKIE['prcTo'];
       } 
       else if (@$_COOKIE['prcFrom'] === null && @$_COOKIE['prcTo'] === null  
                      && filter_input(INPUT_POST, 'prcFrom') !== null && filter_input(INPUT_POST, 'prcTo') !== null) {
           
              $selectedPriceMin = filter_input(INPUT_POST, 'prcFrom');
              $selectedPriceMax = filter_input(INPUT_POST, 'prcTo');
              }
              else if (@$_COOKIE['prcFrom'] !== null && @$_COOKIE['prcTo'] !== null  
                             && filter_input(INPUT_POST, 'prcFrom') !== null && filter_input(INPUT_POST, 'prcTo') !== null
                          ||
                           @$_COOKIE['prcFrom'] === null && @$_COOKIE['prcTo'] !== null  
                             && filter_input(INPUT_POST, 'prcFrom') !== null && filter_input(INPUT_POST, 'prcTo') !== null
                          ||
                           @$_COOKIE['prcFrom'] !== null && @$_COOKIE['prcTo'] === null  
                             && filter_input(INPUT_POST, 'prcFrom') !== null && filter_input(INPUT_POST, 'prcTo') !== null) {    
                  
                      $selectedPriceMin = filter_input(INPUT_POST, 'prcFrom');
                      $selectedPriceMax = filter_input(INPUT_POST, 'prcTo');
                      }
?>
<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
<select name='sort'>
   <option <?php echo $selected1; ?> value="pASC">від дешевших до дорожчих</option>
   <option <?php echo $selected2; ?> value="pDESC">від дорожчих до дешевших</option>
   <option <?php echo $selected3; ?> value="qASC">за зростанням кількості</option>
   <option <?php echo $selected4; ?> value="qDESC">за спаданням кількості</option>
</select>
    <p></p>
    <p>
    Ціна від: <input type="text" name="prcFrom" size="14" placeholder="<?php  
    if ($selectedPriceMin) {
          echo $selectedPriceMin;
    }
    else {
         echo '0';
    } 
        ?>">
    Ціна до: <input type="text" name="prcTo" size="14" placeholder="<?php     
    if ($selectedPriceMax) {
          echo $selectedPriceMax;
    }
    else {
          echo $maxPrice;
    }?>">
    </p>
<input type="submit" value="Submit">
</form>
<div class="product" align="center">
    <h3><b><?= \Core\Url::getLink('/product/add', 'Додати товар'); ?></b></h3>
</div>
<?php
$products =  $this->get('products');
foreach($products as $product):
?>
    <div class="product">
        <p class="sku">Код: <?php echo htmlspecialchars_decode($product['sku'])?></p>
        <h4><?php echo htmlspecialchars_decode($product['name'])?><h4>
        <p> Ціна: <span class="price"><?php echo $product['price']?></span> грн</p>
        <p> Кількість: <?php echo $product['qty']?></p>
        <p> Опис: <?php echo htmlspecialchars_decode($product['description'])?></p>
        <p><?php if(!$product['qty'] > 0) { echo 'Нема в наявності'; } ?></p>
        <p>
            <?= \Core\Url::getLink('/product/edit', 'Редагувати', array('id'=>$product['id'])); ?>
        </p>
        <p>
            <?= \Core\Url::getLink('/product/delete', 'Видалити інфо про даний товар', array('id'=>$product['id'])); ?>
        </p>
    </div>
<?php endforeach; ?>