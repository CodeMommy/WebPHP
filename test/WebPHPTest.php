<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace CodeMommy\Test;

use Exception;
use CodeMommy\DevelopPHP\PHPUnitBase;
use CodeMommy\WebPHP\Application;

/**
 * Class WebPHPTest
 * @package CodeMommy\Test
 */
class WebPHPTest extends PHPUnitBase
{
    /**
     * WebPHPTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test Load Library
     * @throws Exception
     */
    public function testLoadLibrary()
    {
        $_SERVER['REQUEST_URI'] = '/WebPHP/loadLibrary';
        Application::start($this->getTestCasePath());
        $this->expectOutputRegex('/^Load Library<!DOCTYPE html>(.*)/');
    }
}
