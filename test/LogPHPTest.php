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
 * Class LogPHPTest
 * @package CodeMommy\Test
 */
class LogPHPTest extends PHPUnitBase
{
    /**
     * LogPHPTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test Add Config
     * @throws Exception
     */
    public function testAddConfig()
    {
        $_SERVER['REQUEST_URI'] = '/LogPHP/addConfig';
        Application::start($this->getTestCasePath());
        $this->expectOutputRegex('/^LogPHP->addConfig<!DOCTYPE html>(.*)/');
    }
}
