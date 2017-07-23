# coin-parser


<b>[ENG]</b>
	this is a simple parser for a targeted page on coinexchange.io, that I build for an test.
	You need to change username and pswd for sql database in modules/database/db_conf.php in order to run it properly connected with database. It still can run without databases with minor changes in code mechanics.
	

	<b>[RU]</b>
	Это тестовое задание для парсинга целевой страницы на хостинге coinexchange.io.
	Парсер работает в связке с sql базой данных, но, однако, код может быть незначительно поменян для отказа от нее(сразу выводить результат, либо записыватье го в файл).
	все настройки, типа логина или пароля от базы данных находятся в файле modules/database/db_conf.php и могут свободно меняться.
	Парсер расчитан на существующую sql таблицу parser с столбцом success.
	
	переменная $searchedWord - искомое в сообщении чата слово
			   $url - страница для парсинга
			   
	парсер(сейчас) работает только для парса чата на данном в тестовом задании сайте.
