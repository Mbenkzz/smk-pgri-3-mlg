<?php

require __DIR__ . '/core/app.php';

$app = new App();

$app->autoload();

$app->config();

$app->start();

?>