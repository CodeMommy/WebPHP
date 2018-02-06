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
 * Class RoutePHPTest
 * @package CodeMommy\Test
 */
class RoutePHPTest extends PHPUnitBase
{
    /**
     * RoutePHPTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test Route
     * @throws Exception
     */
    public function testRoute()
    {
        $_SERVER['REQUEST_URI'] = '/RoutePHP/route';
        Application::start($this->getTestCasePath());
        $this->expectOutputRegex('/^Route works<!DOCTYPE html>(.*)/');
    }
}
