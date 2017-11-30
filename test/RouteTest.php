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
     * @var string
     */
    private $casePath = '';

    /**
     * @var string
     */
    private $caseConfigPath = '';

    /**
     * RouteTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->casePath = './test/case';
        $this->caseConfigPath = $this->casePath . '/config/';
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
     * Test Start Map
     */
    public function testStartMap()
    {
        copy($this->caseConfigPath . 'route_map.php', $this->caseConfigPath . 'route.php');
        $_SERVER['REQUEST_URI'] = '/test/map';
        Application::start($this->casePath);
        $this->expectOutputString('map');
    }

    /**
     * Test Start PathInfo
     */
    public function testStartPathInfo()
    {
        copy($this->caseConfigPath . 'route_pathinfo.php', $this->caseConfigPath . 'route.php');
        $_SERVER['REQUEST_URI'] = '/test/pathinfo';
        Application::start($this->casePath);
        $this->expectOutputString('pathinfo');
    }

    /**
     * Test Start Symfony
     */
    public function testStartSymfony()
    {
        copy($this->caseConfigPath . 'route_symfony.php', $this->caseConfigPath . 'route.php');
        $_SERVER['REQUEST_URI'] = '/test/symfony';
        Application::start($this->casePath);
        $this->expectOutputString('symfony');
    }
}
