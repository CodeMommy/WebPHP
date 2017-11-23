<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use CodeMommy\WebPHP\Controller;

/**
 * Class ControllerTest
 * @package Test
 */
class ControllerTest extends TestCase
{
    /**
     * ControllerTest constructor.
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
        new Controller();
        $this->assertEquals(true, true);
    }
}
