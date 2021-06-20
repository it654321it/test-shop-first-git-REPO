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
<input type="submit" value="Застосувати">
</form>
<h3 align="center"><b><?= \Core\Url::getLink('/product/add', 'Додати новий товар'); ?></b></h3>
<?php
if (filter_input(INPUT_POST, 'addOrder') !== null) { 
    @$_SESSION['OrderedRate']++;
}
$products =  $this->get('products');
foreach($products as $product):
?>
    <div class="product">
        <form name="second" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="<?php echo $product['sku']?>" size="3" value="<?php 
        echo filter_input(INPUT_POST, $product['sku']) !== null ? filter_input(INPUT_POST, $product['sku']) : ''?>">
        <b> шт.</b>
        <input type="submit" name="addOrder" value="Додати в корзину">
        </form>
 <?php 
if( session_status( ) == 2 ) {     
    if (filter_input(INPUT_POST, 'addOrder') !== null) { 
        \Models\Product::cart(filter_input(INPUT_POST, $product['sku']), $product['price'], 
                htmlspecialchars_decode($product['name']), htmlspecialchars_decode($product['sku']));
    } 
}
?>
        <p class="sku">Код: <?php echo htmlspecialchars_decode($product['sku'])?>
        </p>
        <p>Назва: <?php echo htmlspecialchars_decode($product['name'])?>
        </p>
        <p> Ціна: <span class="price"><?php echo $product['price']?></span> грн
        </p>
        <p> Кількість: <?php echo (int)($product['qty'])?> шт.
        </p>
        <p> Опис: <?php echo htmlspecialchars_decode($product['description'])?>
        </p>
        <p><?php if(!$product['qty'] > 0) { echo 'Нема в наявності'; } ?></p>
        <p>
            <h4><b><?= \Core\Url::getLink('/product/edit', 'Редагувати', array('id'=>$product['id'])); ?></b></h4>
        </p>
        <p>
            <h4 align="right" colour="red"><b><?= \Core\Url::getLink('/product/delete', 'Видалити', array('id'=>$product['id'])); ?></b></h4>
        </p>
    </div>
<?php endforeach; ?>