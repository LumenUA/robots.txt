<!DOCTYPE html>
<html>
<head>
	<title>Поиск файла robots.txt</title>
	<meta charset='utf-8'>
</head>
<body>
	<form method="POST">
	<!-- Ввод адреса сайта -->
	<input name="input_url" type="text" size="25" maxlength="25">
	<input type="submit" name="ok" value="Ok">
	</form>
	<?php
// ..Сохрянем в переменую текс из инпута
$text_input = $_POST['input_url'];
//Определяем, была ли установлена переменная.
	if (isset($_POST['ok'])) {
		if (@file_get_contents('http://'.$text_input.'/robots.txt') === false) {
			echo '<h1>robots.txt Отсуствует</h1>';
		} else {
				$url = file_get_contents('http://'.$text_input.'/robots.txt');//Соедяем в строку содержимое robots.txt
				$header = get_headers('http://'.$text_input.'/robots.txt');//Поучаем ответ сервера 
				$status = substr($header[0], 9, 3);// Обрезаем статус до цифр

	 			$sitemap_count = substr_count($url, 'Sitemap');
				$host_count = substr_count($url, 'Host'); //Подсчитываем колиство подстрок в строке
			
		// Узнаём размер файла
				$fh = fopen('http://'.$text_input.'/robots.txt', "r");
				$str = fread($fh, 32768); //Bytes
				$fsize += strlen($str);
				function HumanBytes($size) {
					$filesizename = array(" Bytes", " KB");
					return $size ? round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
					}
				}

			}
				?>

				<table border="1">
					<theader>
						<tr>

							<td>
								Name
							</td>

							<td>
								Result
							</td>

							<td>
								Status
							</td>

							<td>
								Description
							</td>

						</tr>
					</theader>

					<tr>
						<td>
							Проверка наличия файла robots.txt
						</td>
						<td>
							Файл robots.txt присутствует
						</td>
						<td>
							OK
						</td>
						<td>
							Доработки не требуются
						</td>
					</tr>

					<tr>
						<td>
							Проверка количества директив HOST, прописанных в файле
						</td>
						<? if ($host_count > 0) { ?>
						<td>
							В файле прописана <?echo $host_count;?> диретив Host
						</td>
						<td>
							OK
						</td>
						<td>
							Доработки не требуются
						</td>

						<?} else { ?>


						<td>
							В файле прописано несколько директив Host
						</td>
						<td>
							Ошибка
						</td>
						<td>
							Директива Host должна быть указан только 1 раз
						</td>


						<?}?>
					</tr>

					<tr>
						<td>
							Проверка указания директивы Sitemap
						</td>
						<? if ($sitemap_count > 0) { ?>
						<td>
							Директива Sitemap указана
						</td>
						<td>
							OK
						</td>
						<td>
							Доработки не требуются
						</td>
						
						<?} else { ?>
						

						<td>
							В файле robots.txt не указана директива Sitemap
						</td>
						<td>
							Ошибка
						</td>
						<td>
							Добавить в файл robots.txt директиву Sitemap
						</td>
						

						<?}?>
					</tr>

					<tr>
						<td>
							Проверка кода ответа сервера для файла robots.txt
						</td>
						<? if ($status == 200) { ?>
						<td>
							Файл robots.txt отдаёт код ответа <?echo $status;?>
						</td>
						<td>
							OK
						</td>
						<td>
							Доработки не требуются
						</td>
						
						<?} else { ?>
						

						<td>
							При обращении к файлу robots.txt сервер возвращает код ответа <?echo $status;?>
						</td>
						<td>
							Ошибка
						</td>
						<td>
							Файл robots.txt должен отдавать код ответа 200, иначе файл не будет обрабатываться. Необходимо настроить сайт
						</td>
						

						<?}?>
					</tr>
					<tr>
						<td>
							Размер файла robots.txt
						</td>
						<? if ($fsize < 32768) { ?>
						<td>
							Размер файла robots.txt <?echo HumanBytes ($fsize);?> что на находиться в пределах допустимой нормы
						</td>
						<td>
							OK
						</td>
						<td>
							Доработки не требуются
						</td>
						
						<?} else { ?>
						

						<td>
							Размер файла robots.txt <?echo $fsize;?> что превышает допустимую норму
						</td>
						<td>
							Ошибка
						</td>
						<td>
							Максимально допустимый размер файла robots.txt состовляет 32кб. Необходимо отредактировать файл robots.txt
						</td>
						

						<?}?>
					</tr>

			</table>



</body>
</html>