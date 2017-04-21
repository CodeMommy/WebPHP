<?php

use CodeMommy\WebPHP\Environment;

return array(
    'debug' => Environment::get('application.debug', false)
);