<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use CodeMommy\WebPHP\DateTime;

/**
 * Class DateTimeTest
 * @package Test
 */
class DateTimeTest extends TestCase
{
    /**
     * DateTimeTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test Time
     */
    public function testTime()
    {
        $this->assertEquals(date('Y-m-d H:i:s'), DateTime::now());
    }
}
