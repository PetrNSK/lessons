<?php

//GET

$news = 'Четыре новосибирские компании вошли в сотню лучших работодателей
Выставка университетов США: открой новые горизонты
Оценку «неудовлетворительно» по качеству получает каждая 5-я квартира в новостройке
Студент-изобретатель раскрыл запутанное преступление
Хоккей: «Сибирь» выстояла против «Ак Барса» в пятом матче плей-офф
Здоровое питание: вегетарианская кулинария
День святого Патрика: угощения, пивной теннис и уличные гуляния с огнем
«Красный факел» пустит публику на ночные экскурсии за кулисы и по закоулкам столетнего здания
Звезды телешоу «Голос» Наргиз Закирова и Гела Гуралиа споют в «Маяковском»';
$news = explode("\n", $news);

//print_r($news);

function print_all_news() {
    global $news;
    echo 'Новости под номером ' . $_GET['id'] . ' не существует!<br><b>Весь список новостей:</b> <br>';
    foreach ($news as $key) {
        echo "$key <br>";
    }
}

function print_article($id) {
    global $news;
    if ($id < count($news)) {
        echo $news[$id];
    } else {
        print_all_news();
    }
}
if(isset($_GET['id'])) {
print_article($_GET['id']);
}
else{
header("HTTP/1.0 404 Not Found");
echo 'Ошибка 404<br>Извините такой страницы не найдено! Попробуйте указать парметр id';
}
// Функция вывода всего списка новостей.
// Функция вывода конкретной новости.
// Точка входа.
// Если новость присутствует - вывести ее на сайте, иначе мы выводим весь список
// Был ли передан id новости в качестве параметра?
// если параметр не был передан - выводить 404 ошибку
// thtp://php.net/manual/ru/function.header.php
?>