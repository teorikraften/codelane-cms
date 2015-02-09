<?php

/*
	Gör inte den andra ordningen, utan gör så här, exakt:
	1. Kopiera den här filen till samma mapp men med namnet .env.php (Ja, punkt i början. Den gör så att operativsystemet tror att det är en dold fil, men tro mig, den finns där även om den inte syns.)
	2. Ändra infon.
*/

return array(
	'DATABASE_SERVER' => 'localhost',
	'DATABASE_NAME' => 'codelane-cms',
	'DATABASE_USER' => 'root',
	'DATABASE_PASSWORD' => '',
	'DOMAIN' => 'http://localhost',
);
