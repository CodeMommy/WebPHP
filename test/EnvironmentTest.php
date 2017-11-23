<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

declare(strict_types=1);

namespace Test;

use PHPUnit\Framework\TestCase;
use CodeMommy\WebPHP\Environment;

/**
 * Class EnvironmentTest
 * @package Test
 */
class EnvironmentTest extends TestCase
{
    /**
     * Environment File
     * @var string
     */
    private $environmentFile = __DIR__ . '/environment.yaml';

    /**
     * Environment File Not Exist
     * @var string
     */
    private $environmentFileNotExist = __DIR__ . '/environment.no.yaml';

    /**
     * EnvironmentTest constructor.
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
        new Environment();
        $this->assertEquals(true, true);
    }

    /**
     * Test Set File
     */
    public function testSetFile()
    {
        $this->assertEquals(Environment::setFile($this->environmentFile), true);
    }

    /**
     * Test Get
     */
    public function testGet()
    {
        // Create Environment File
        file_put_contents($this->environmentFile, '');
        file_put_contents($this->environmentFile, 'application:', FILE_APPEND);
        file_put_contents($this->environmentFile, PHP_EOL, FILE_APPEND);
        file_put_contents($this->environmentFile, '  hello: world', FILE_APPEND);
        // Set File
        Environment::setFile($this->environmentFileNotExist);
        // Environment File Not Exist
        $this->assertEquals(Environment::get('application.hello', 'default'), 'default');
        // Set File
        Environment::setFile($this->environmentFile);
        // Can Not Get
        $this->assertEquals(Environment::get('application.world'), null);
        $this->assertEquals(Environment::get('application.world', 'default'), 'default');
        // Get From File
        $this->assertEquals(Environment::get('application.hello', 'default'), 'world');
        // Get From Cache
        $this->assertEquals(Environment::get('application.hello', 'default'), 'world');
        // Set File
        Environment::setFile($this->environmentFileNotExist);
        // Get From Cache Although Environment File Not Exist
        $this->assertEquals(Environment::get('application.hello', 'default'), 'world');
        // Delete Environment File
        if (is_file($this->environmentFile)) {
            unlink($this->environmentFile);
        }
    }
}
