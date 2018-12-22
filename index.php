<?php
require __DIR__.'/vendor/autoload.php';

$fs = new Eddy\Aker\Fs(__DIR__);

$test = $fs->load('filename');

var_dump(Eddy\Aker\Json::toArrayObject($test));
