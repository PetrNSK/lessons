<?php
session_start();

//Вывод списка всех объявлений
function show_ads() {
    echo '<b>Список всех объявлений:</b><br>';
    if (isset($_SESSION['ads']) && count($_SESSION['ads'])>0) {
        foreach ($_SESSION['ads'] as $key => $value) {
            ?><a href="lesson6.php?view=<?= $key ?>"><?= $value['title'] ?></a><?
            echo ' | ' . $value['price'] . ' | ' . $value['seller_name'] . ' | ';
            ?><a href="lesson6.php?del=<?= $key ?>">удалить</a><br><?
        }
    } else {
        echo 'Объявлений пока нет, самое время добавить одно!';
    }
}

//добавляет или удаляет объявление
function add_del_ad() {
    if (isset($_POST['main_form_submit'])) {
        if (!isset($_SESSION['ads'])) {
            $_SESSION['ads'] = array();
        }
        $_SESSION['ads'][] = $_POST;
    } else {
        if (isset($_GET['del'])) {
            unset($_SESSION['ads'][$_GET['del']]);
        }
    }
}

//Вывод формы
function show_private_block($private = '') {
    $checked1 = ($private == 1) ? 'checked=""' : '';
    $checked0 = ($private == 0) ? 'checked=""' : '';
    $checked = ($private == '') ? 'checked=""' : '';
    ?>
    <tr><td></td><td>
            <label class="form-label-radio"><input type="radio" <?= $checked ?> <?= $checked1 ?> value="1" name="private">Частное лицо</label>
            <label class="form-label-radio"><input type="radio" <?= $checked0 ?> value="0" name="private">Компания</label>
        </td></tr>    
    <?
}

function show_name_block($seller_name = '') {
    ?>
    <tr><td>
            <label for="fld_seller_name" class="form-label"><b>Ваше имя</b></label>
        </td>
        <td>
            <input type="text" maxlength="40" class="form-input-text" value="<?= $seller_name ?>" name="seller_name" id="fld_seller_name">
        </td></tr>

    <?
}

function show_email_block($email = '') {
    ?>
    <tr><td>
            <label for="fld_email" class="form-label"><b>Электронная почта</b></label>
        </td><td>
            <input type="text" class="form-input-text" value="<?= $email ?>" name="email" id="fld_email">
        </td></tr>
    <?
}

function show_allow_mails_block($allow_mails = '') {
    $checked = ($allow_mails == 'on') ? 'checked=""' : '';
    ?>   

    <tr><td></td><td>
            <label class="form-label-checkbox" for="allow_mails"> <input type="checkbox" <?= $checked ?> name="allow_mails" id="allow_mails" class="form-input-checkbox"><span class="form-text-checkbox">Я не хочу получать вопросы по объявлению по e-mail</span> </label> 
        </td></tr>
    <?
}

function show_phone_block($phone = '') {
    ?>   
    <tr><td>
            <label id="fld_phone_label" for="fld_phone" class="form-label"><b>Номер телефона</b></label> 
        </td><td>
            <input type="text" class="form-input-text" value="<?= $phone ?>" name="phone" id="fld_phone">
        </td></tr>
    <?
}

function show_city_block($location_id = '') {
    $cities = ['641780' => 'Новосибирск', '641490' => 'Барабинск', '641510' => 'Бердск',
        '641600' => 'Искитим', '641630' => 'Колывань',
        '641680' => 'Краснообск', '641710' => 'Куйбышев',
        '641760' => 'Мошково', '641790' => 'Обь',
        '641800' => 'Ордынское', '641970' => 'Черепаново'];
    ?>   
    <tr><td>
            <label for="region" class="form-label"><b>Город</b></label> 
        </td><td>
            <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select"> <option value="">-- Выберите город --</option>
                <option class="opt-group" disabled="disabled">-- Города --</option>
                <?php
                foreach ($cities as $key => $value) {
                    $selected = ($key == $location_id) ? 'selected=""' : '';
                    ?>
                    <option <?= $selected ?> data-coords=",," value="<?= $key ?>"><?= $value ?></option>
    <?php }
    ?>
            </select>
        </td></tr>
    <?
}

function show_category_block($category_id = '') {
    $categories = [
        'Транспорт' =>
        ['9' => 'Автомобили с пробегом', '109' => 'Новые автомобили',
            '14' => 'Мотоциклы и мототехника', '81' => 'Грузовики и спецтехника', '11' => 'Водный транспорт',
            '10' => 'Запчасти и аксессуары'],
        'Недвижимость' =>
        ['24' => 'Квартиры', '23' => 'Комнаты', '25' => 'Дома, дачи, коттеджи',
            '26' => 'Земельные участки', '85' => 'Гаражи и машиноместа', '42' => 'Коммерческая недвижимость',
            '86' => 'Недвижимость за рубежом'],
        'Работа' =>
        ['111' => 'Вакансии (поиск сотрудников)', '112' => 'Резюме (поиск работы)']
    ];
    ?>   
    <tr><td>
            <label for="fld_category_id" class="form-label"><b>Категория</b></label>
        </td><td>
            <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select"> 
                <option value="">-- Выберите категорию --</option>
                    <?php foreach ($categories as $category => $value) { ?>
                    <optgroup label="<?= $category ?>">
                        <?php
                        foreach ($value as $catid => $catname) {
                            $selected = ($catid == $category_id) ? 'selected=""' : '';
                            ?>
                            <option <?= $selected ?> value="<?= $catid ?>"><?= $catname ?></option>
        <?php } ?>
                    </optgroup>
    <?php } ?>
            </select> 
        </td></tr>
    <?
}

function show_title_block($title = '') {
    ?>   
    <tr><td>
            <label for="fld_title" class="form-label"><b>Название объявления</b></label> 
        </td><td>
            <input type="text" maxlength="50" class="form-input-text-long" value="<?= $title ?>" name="title" id="fld_title"> 
        </td></tr>
    <?
}

function show_description_block($description = '') {
    ?>   
    <tr><td>
            <label for="fld_description" class="form-label" id="js-description-label"><b>Описание объявления</b></label> 
        </td><td>
            <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea"><?= $description ?></textarea> 
        </td></tr>
    <?
}

function show_price_block($price = '0') {
    ?>   
    <tr><td>
            <label id="price_lbl" for="fld_price" class="form-label"><b>Цена</b></label> 
        </td><td>
            <input type="text" maxlength="9" class="form-input-text-short" value="<?= $price ?>" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.</span> 
        </td></tr>


    <?
}
//вывод формы
?>  

<html
    <head>
        <link href="less6.css" rel="stylesheet">
    </head>
    <body>
        <form  method="post"> 
            <table>
                <?php
                add_del_ad();
                $blocks = [
                    'show_private_block' => 'private',
                    'show_name_block' => 'seller_name',
                    'show_email_block' => 'email',
                    'show_allow_mails_block' => 'allow_mails',
                    'show_phone_block' => 'phone',
                    'show_city_block' => 'location_id',
                    'show_category_block' => 'category_id',
                    'show_title_block' => 'title',
                    'show_description_block' => 'description',
                    'show_price_block' => 'price'
                ];
                foreach ($blocks as $show_block => $param) {
                    if (isset($_GET['view'], $_SESSION['ads'][$_GET['view']][$param])) {
                        $show_block($_SESSION['ads'][$_GET['view']][$param]);
                    } else {
                        $show_block();
                    }
                }
                ?>
                <tr><td class="submit">
                        <input type="submit" value="Отправить" id="form_submit" name="main_form_submit" class="vas-submit-input">
                    </td></tr>
            </table>    
        </form> 
        <?
        show_ads();
        ?>
    </body>
</html>