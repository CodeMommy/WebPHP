<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace CodeMommy\WebPHP\Test;

use PHPUnit\Framework\TestCase;

/**
 * Class BaseTest
 * @package CodeMommy\WebPHP\Test
 */
class BaseTest extends TestCase
{
    const TEST_CASE_PATH = 'test_case';

    /**
     * Test Case Path
     * @var string
     */
    private $testCasePath = '';

    /**
     * BaseTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->testCasePath = sprintf('%s/../%s', __DIR__, self::TEST_CASE_PATH);
    }

    /**
     * Get Test Case Path
     * @param string $path
     * @return string
     */
    protected function getTestCasePath($path = '')
    {
        if (empty($path)) {
            return $this->testCasePath;
        }
        $path = trim($path, '/\\');
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        return sprintf('%s%s%s', $this->testCasePath, DIRECTORY_SEPARATOR, $path);
    }

    /**
     * Test
     */
    public function test()
    {
        $this->assertTrue(true);
    }
}
