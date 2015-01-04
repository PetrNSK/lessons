<?

$ini_string = '
[игрушка мягкая мишка белый]
цена = ' . mt_rand(1, 10) . ';
количество заказано = ' . mt_rand(1, 10) . ';
осталось на складе = ' . mt_rand(0, 10) . ';
diskont = diskont' . mt_rand(0, 2) . ';
    
[одежда детская куртка синяя синтепон]
цена = ' . mt_rand(1, 10) . ';
количество заказано = ' . mt_rand(1, 10) . ';
осталось на складе = ' . mt_rand(0, 10) . ';
diskont = diskont' . mt_rand(0, 2) . ';
    
[игрушка детская велосипед]
цена = ' . mt_rand(1, 10) . ';
количество заказано = ' . mt_rand(1, 10) . ';
осталось на складе = ' . mt_rand(0, 10) . ';
diskont = diskont' . mt_rand(0, 2) . ';

';
$bd = parse_ini_string($ini_string, true);

function draw_line() {
    echo '<br>______________________________________________________________________________________________<br>';
}

$result = array(
    'item_names' => 0,
    'quantity' => 0,
    'sum' => 0
);

//Вывод ИТОГО
function show_result() {
    global $result;
    echo '<b>ИТОГО:</b><br>Наименований: ' . $result['item_names'] .
    ', общее количество: ' . $result['quantity'] . ' шт.'
    . ' на сумму: ' . $result['sum'] . ' руб.';
}

$special_offer_conditions = array(
  'name' => 'игрушка детская велосипед',
  'количество заказано' => 3,
  'осталось на складе' => 3
);
$special_offer_value = 30;
$special_offer_text = 'Скидка по акции: "купи 3 и больше детских велосипедов и получи скидку 30%!"';

//проверка на АКЦИЮ
function check_offer($item){    
    global $special_offer_conditions;
    foreach($special_offer_conditions as $key=>$value){
        if(gettype($value)=='string'){
            if($item[$key] != $value){
                return false;
            }
        }
        else {
            if($item['params'][$key] < $value) {
                return false;
            }
        }
    }

    return true;
}



function show_item($item, $stock) {
    static $count = 1;
    global $result;
    global $special_offer_value;
    global $special_offer_text;
    $cur_price = $item['params']['цена'];
    $cur_offer = $item['params']['количество заказано'];
    $cur_stock = $item['params']['осталось на складе'];
    $cur_out_stock = -$stock;
    switch (check_offer($item)) {
        case true:
            $cur_discount = $special_offer_value;
            break;
        default:
            $cur_discount = (int) substr($item['params']['diskont'], -1) * 10;
            break;
    }
    $cur_discount_price = $cur_price - $cur_price * $cur_discount / 100;

    //Товар в наличии в полном объеме
    if ($stock >= 0) {
        echo '<br>' . $count . '. ' . $item['name'] . '<br>Количество:' . $cur_offer . ' шт. по цене: ' . $cur_price . ' руб.';
        //есть скидка на товар
        if ($cur_discount > 0) { 
            echo '<br>Скидка:' . $cur_discount . '% сумма со скидкой:' . ($cur_discount_price * $cur_offer) . ' руб.';
            echo (check_offer($item)==true) ? '<br>'.$special_offer_text:''; 
            $result['sum']+= ($cur_discount_price * $cur_offer);
        } 
        //Нет скидки
        else {
            echo '<br>Сумма:' . ($cur_price * $cur_offer) . ' руб.';
            $result['sum']+= ($cur_price * $cur_offer);
        }
        $result['item_names']+=1;
        $result['quantity']+=$cur_offer;
    }
    //Товара не хватает
    else {
        if ($cur_out_stock < $cur_offer) {
            echo '<br>' . $count . '. ' . $item['name'] . '<br>Количество:' . $cur_stock . ' шт. по цене: ' . $cur_price . ' руб.';
            //Есть скидки
            if ($cur_discount > 0) {
                echo '<br>Скидка:' . $cur_discount . '% сумма со скидкой:' . ($cur_discount_price * $cur_stock) . ' руб.';
                echo (check_offer($item)==true) ? '<br>'.$special_offer_text:''; 
                $result['sum']+= ($cur_discount_price * $cur_stock);
            } 
            //Нет скидки
            else {
                echo '<br>Сумма:' . ($cur_price * $cur_stock) . ' руб.<br>';
                $result['sum']+= ($cur_price * $cur_stock);
            }
            echo '<br><b>ВНИМАНИЕ!</b> Товара не хватает на складе! Недостающее количество: ' . $cur_out_stock;

            $result['item_names']+=1;
            $result['quantity']+=$cur_stock;
        }
        //Товар отсустствует на складе
        else {
            echo '<br>' . $count . '. ' . $item['name'] . '<br>Количество:' . $cur_offer . ' шт. по цене: ' . $cur_price . ' руб.';
            echo '<br><b>ВНИМАНИЕ!</b> Извините, в данный момент товара нет в наличии на складе! Попробуйте заказать его позднее!';
        }
    }
    draw_line();
    $count++;
}

function show_cart() {
    global $bd;
    echo 'Состав вашего заказа №' . rand(0, 100) . ':<br>';
    foreach ($bd as $key => $value) {
        $cur_item = array(
            'name' => $key,
            'params' => $value
        );
        $stock = $cur_item['params']['осталось на складе'] - $cur_item['params']['количество заказано'];
        show_item($cur_item, $stock);
    }
    show_result();
}

echo 'КОРЗИНА:<br>';
show_cart();
?>