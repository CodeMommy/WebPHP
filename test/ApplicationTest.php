<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace CodeMommy\WebPHP\Test;

use CodeMommy\WebPHP\Application;

/**
 * Class ApplicationTest
 * @package CodeMommy\WebPHP\Test
 */
class ApplicationTest extends BaseTest
{
    /**
     * ApplicationTest constructor.
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
        new Application();
        $this->assertTrue(true);
    }

    /**
     * Test Start
     */
    public function testStart()
    {
        $name = strval(rand(1, 100));
        copy($this->getTestCasePath('config/route_symfony.php'), $this->getTestCasePath('config/route.php'));
        $_SERVER['REQUEST_URI'] = sprintf('/test/symfony/%s', $name);
        Application::start($this->getTestCasePath());
        $this->expectOutputString($name);
    }
}
