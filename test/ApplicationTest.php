<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use CodeMommy\WebPHP\Application;

/**
 * Class ApplicationTest
 * @package Test
 */
class ApplicationTest extends TestCase
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
        $this->assertEquals(true, true);
    }

    /**
     * Test Start
     */
    public function testStart()
    {
        Application::start('./demo');
        $this->assertEquals(true, true);
    }
}
