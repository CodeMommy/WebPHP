<?php

use CodeMommy\ConfigPHP\Config;

return array(
    'debug' => Config::get('environment.application.debug', false)
);
