<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace CodeMommy\Test;

use Exception;
use CodeMommy\DevelopPHP\PHPUnitBase;
use CodeMommy\WebPHP\Application;

/**
 * Class AutoloadPHPTest
 * @package CodeMommy\Test
 */
class AutoloadPHPTest extends PHPUnitBase
{
    /**
     * AutoloadPHPTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test File
     * @throws Exception
     */
    public function testFile()
    {
        $_SERVER['REQUEST_URI'] = '/AutoloadPHP/file';
        Application::start($this->getTestCasePath());
        $this->expectOutputRegex('/^AutoloadPHP->file<!DOCTYPE html>(.*)/');
    }

    /**
     * Test Directory
     * @throws Exception
     */
    public function testDirectory()
    {
        $_SERVER['REQUEST_URI'] = '/AutoloadPHP/directory';
        Application::start($this->getTestCasePath());
        $this->expectOutputRegex('/^AutoloadPHP->directory<!DOCTYPE html>(.*)/');
    }
}
