<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace CodeMommy\WebPHP\Test;

use Exception;
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
     * @throws Exception
     */
    public function testConstruct()
    {
        new Application();
        $this->assertTrue(true);
    }

    /**
     * Test Start
     * @throws Exception
     */
    public function testStart()
    {
        $name = strval(rand(1, 100));
        $_SERVER['REQUEST_URI'] = sprintf('/test/symfony/%s', $name);
        Application::start($this->getTestCasePath());
        $this->expectOutputString($name);
    }
}
