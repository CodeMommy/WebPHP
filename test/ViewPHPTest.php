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
 * Class ViewPHPTest
 * @package CodeMommy\Test
 */
class ViewPHPTest extends PHPUnitBase
{
    /**
     * ViewPHPTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Test Render
     * @throws Exception
     */
    public function testRender()
    {
        $_SERVER['REQUEST_URI'] = '/ViewPHP/render';
        Application::start($this->getTestCasePath());
        $this->expectOutputRegex('/^View Render(.*)/');
    }
}
