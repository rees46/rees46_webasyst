<?php

/**
 * Положить в корень сайта.
 * Прописать доступ к БД
 * Открыть URL http://мой-домен.com/export-audience.php
 * Сохранить результат в файл audience.csv
 * Загрузить в REES46
 */

header('content-type: text/plain; charset=utf-8');

$mysqli = new mysqli('host', 'user', 'password', 'database');
$customers = $mysqli->query('SELECT * FROM shop_customer');

while ($customer = $customers->fetch_row()) {
	$result = $mysqli->query("SELECT * FROM wa_contact_emails WHERE contact_id = " . $customer[0] . " AND status = 'confirmed'");
	if($result->num_rows == 0) {
		$result = $mysqli->query("SELECT * FROM wa_contact_emails WHERE contact_id = " . $customer[0]);
	}
	if($result->num_rows > 0) {
		$row = $result->fetch_row();
		echo $customer[0] . ',' . $row[2] . PHP_EOL;
	}
}
