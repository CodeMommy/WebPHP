<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

/**
 * Interface ApplicationInterface
 * @package CodeMommy\WebPHP
 */
interface ApplicationInterface
{
    /**
     * AutoloadInterface constructor.
     */
    public function __construct();

    /**
     * Get Path
     * @param string $path
     * @return mixed
     */
    public static function getPath($path = '');

    /**
     * Get Run Time Path
     * @param string $path
     * @return mixed
     */
    public static function getRunTimePath($path = '');

    /**
     * Start
     * @param string $applicationRoot
     * @return mixed
     */
    public static function start($applicationRoot = '');
}
