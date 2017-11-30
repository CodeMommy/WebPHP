<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use CodeMommy\WebPHP\Route;
use CodeMommy\WebPHP\Application;

/**
 * Class RouteTest
 * @package Test
 */
class RouteTest extends TestCase
{
    /**
     * RouteTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test Construct
     */
    public function testConstruct()
    {
        new Route();
        $this->assertEquals(true, true);
    }

    /**
     * Test Start
     */
    public function testStart()
    {
        $casePath = './test/case';
        $caseConfigPath = $casePath . '/config/';
        copy($caseConfigPath . 'route_map.php', $caseConfigPath . 'route.php');
        Application::start($casePath);
        copy($caseConfigPath . 'route_pathinfo.php', $caseConfigPath . 'route.php');
        Application::start($casePath);
        copy($caseConfigPath . 'route_symfony.php', $caseConfigPath . 'route.php');
        Application::start($casePath);
        $this->assertEquals(true, true);
    }
}
