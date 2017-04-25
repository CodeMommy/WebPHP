<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

require_once(__DIR__ . '/../vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use CodeMommy\WebPHP\DateTime;

class DateTimeTest extends TestCase
{
    public function testTime()
    {
        $this->assertEquals(date('Y-m-d H:i:s'), DateTime::now());
    }
}