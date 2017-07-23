<?php 

/*
	
	[ENG]
	this is a simple parser for a targeted page on coinexchange.io, that I build for an test.
	You need to change username and pswd for sql database in modules/database/db_conf.php in order to run it properly connected with database. It still can run without databases with minor changes in code mechanics.
	

	[RU]
	Это тестовое задание для парсинга целевой страницы на хостинге coinexchange.io.
	Парсер работает в связке с sql базой данных, но, однако, код может быть незначительно поменян для отказа от нее(сразу выводить результат, либо записыватье го в файл).
	все настройки, типа логина или пароля от базы данных находятся в файле modules/database/db_conf.php и могут свободно меняться.
	Парсер расчитан на существующую sql таблицу parser с столбцом success.
	
	переменная $searchedWord - искомое в сообщении чата слово
			   $url - страница для парсинга
			   
	парсер(сейчас) работает только для парса чата на данном в тестовом задании сайте.
*/


$url = 'https://www.coinexchange.io/market/HUB/BTC';
$searchedWord = 'honey';


$lookFor = "/".$searchedWord."/";

require_once 'modules/simplehtmldom/simple_html_dom.php';
require_once 'modules/database/init.php';
		
$db = new Database();	
$opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"));
$context = stream_context_create($opts);

$html = new simple_html_dom();

$html = file_get_html($url, false, $context);


if($html->innertext!='' and count($html->find('div[class=chat-line]'))) {
 foreach($html->find('div[class=chat-line]') as $line) {
  if (preg_match($lookFor,$line)) {
	  $text = $line->plaintext;
	  $db->SaveToBase($text);
  }
//	 else echo "line does not contains this words";
 }
}

$html->clear(); 
unset($html);


$outputs = $db->ShowFromDb();
foreach ($outputs as $line => $value) {
	print_r($value);
	echo "<br/>";
}
