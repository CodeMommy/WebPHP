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
 * Class ConfigPHPTest
 * @package CodeMommy\Test
 */
class ConfigPHPTest extends PHPUnitBase
{
    /**
     * ConfigPHPTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test Clear Cache
     * @throws Exception
     */
    public function testClearCache()
    {
        $_SERVER['REQUEST_URI'] = '/ConfigPHP/clearCache';
        Application::start($this->getTestCasePath());
        $this->expectOutputRegex('/^ConfigPHP->clearCache<!DOCTYPE html>(.*)/');
    }

    /**
     * Test Add Directory
     * @throws Exception
     */
    public function testAddDirectory()
    {
        $_SERVER['REQUEST_URI'] = '/ConfigPHP/addDirectory';
        Application::start($this->getTestCasePath());
        $this->expectOutputRegex('/^ConfigPHP->addDirectory<!DOCTYPE html>(.*)/');
    }

    /**
     * Test Get
     * @throws Exception
     */
    public function testGet()
    {
        $_SERVER['REQUEST_URI'] = '/ConfigPHP/get';
        Application::start($this->getTestCasePath());
        $this->expectOutputRegex('/^mysql<!DOCTYPE html>(.*)/');
    }
}
