<?php
require __DIR__.'/vendor/autoload.php';

$fs = new Eddy\Aker\Fs(__DIR__);

$test = $fs->load('filename1');

var_dump(Eddy\Aker\Json::toArray($test));
