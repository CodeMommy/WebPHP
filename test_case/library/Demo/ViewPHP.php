<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

namespace Library\Demo;

use CodeMommy\ViewPHP\View;

/**
 * Class ViewPHP
 * @package Library\Demo
 */
class ViewPHP
{
    /**
     * ViewPHP constructor.
     */
    public function __construct()
    {
    }

    /**
     * Render
     */
    public function render()
    {
        $data = array();
        $data['title'] = 'View Render';
        return View::render('demoViewRender', $data);
    }
}
