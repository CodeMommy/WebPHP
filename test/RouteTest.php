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
        $this->assertTrue(true);
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
        $name = 'pathinfo';
        copy($this->caseConfigPath . 'route_pathinfo.php', $this->caseConfigPath . 'route.php');
        $_SERVER['REQUEST_URI'] = sprintf('/test/pathinfo/name/%s', $name);
        Application::start($this->casePath);
        $this->expectOutputString($name);
    }

    /**
     * Test Start Symfony
     */
    public function testStartSymfony()
    {
        $name = 'symfony';
        copy($this->caseConfigPath . 'route_symfony.php', $this->caseConfigPath . 'route.php');
        $_SERVER['REQUEST_URI'] = sprintf('/test/symfony/%s', $name);
        Application::start($this->casePath);
        $this->expectOutputString($name);
    }

    /**
     * Test Start Symfony Namespace
     */
    public function testStartSymfonyNamespace()
    {
        copy($this->caseConfigPath . 'route_symfony.php', $this->caseConfigPath . 'route.php');
        $_SERVER['REQUEST_URI'] = '/test/home';
        Application::start($this->casePath);
        $this->expectOutputString('index');
    }

    /**
     * Test Start Map Empty
     */
    public function testStartMapEmpty()
    {
        copy($this->caseConfigPath . 'route_map.php', $this->caseConfigPath . 'route.php');
        $_SERVER['REQUEST_URI'] = '/test/mapEmpty';
        Application::start($this->casePath);
        $this->expectOutputString('');
    }
}
