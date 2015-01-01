<?
echo 'Задание 1:'
?> 
<br>
<?
$name = 'Petr';
$age = 24;
echo 'Меня зовут '.$name;
?> 
<br>
<?
echo 'Мне '.$age.' года';
unset($name,$age);
?>
<br><br>
<?
echo 'Задание 2:';
?> 
<br>
<?
define('CITY','Novosibirsk');

if (defined('CITY')) {
    if(CITY){
    echo CITY;
    }
}
define('CITY','Berdsk');
?><br><br>
<?
echo 'Задание 3:';
?> 
<br>
<?
$book = array(
'title' => '451 градус по Фаренгейту',
'author' =>' Брэдбери, Рэй Дуглас',
'pages' =>'700'
);
echo 'Недавно я прочитал книгу '.$book['title'].', написанную автором'.$book['author'].', я осилил все '.$book['pages'].' страниц, мне она очень понравилась';
?>
<br><br>
<?
echo 'Задание 4:';
?> 
<br>
<?
$book1 = array (
'title' => '451 градус по Фаренгейту',
'author' =>' Брэдбери Рэй Дуглас',
'pages' =>'700'
);
$book2 = array (
'title' => 'Братья Карамазовы',
'author' =>'Достоевский Федор Михайлович',
'pages' =>'150'
);
$books =array($book1,$book2);
echo 'Недавно я прочитал книги '.$books[0]['title'].' и '.$books[1]['title'].',написанные соответственно авторами '.$books[0]['author']. ' и '.$books[1]['author'].
        ', я осилил в сумме '.($books[0]['pages']+$books[1]['pages']).' страниц, не ожидал от себя подобного!';
?>