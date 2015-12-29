<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace Controller;

use LuckyPHP\Controller;
use LuckyPHP\View;
use LuckyPHP\Route;
use LuckyPHP\Session;
use LuckyPHP\Input;
use LuckyPHP\Debug;
use LuckyPHP\Client;
use LuckyPHP\Configure;
use LuckyPHP\Convert;
use LuckyPHP\Validate;
use LuckyPHP\Database;
use LuckyPHP\Cookie;
use LuckyPHP\DateTime;
use LuckyPHP\URL;

use Model\Book;

class TestController extends Controller
{

    public function index()
    {
        $action = Input::get('action', '');
        $string = sprintf('This is a LuckyPHP test: %s', $action);
        echo sprintf('<title>%s</title>', $string);
        echo sprintf('<h3>%s</h3>', $string);
        $this->$action();
    }

    protected function redirect()
    {
        return Route::redirect('http://www.microsoft.com');
    }

    protected function setSession()
    {
        echo Session::set('hello', 'world');
    }

    protected function getSession()
    {
        echo Session::get('hello');
    }

    protected function isExistSession()
    {
        echo Session::isExist('hello');
    }

    protected function clearSession()
    {
        echo Session::clear();
    }

    protected function showPage()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        return View::html('index/showPage.html', $data);
    }

    protected function showJSON()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        return View::json($data);
    }

    protected function input()
    {
        echo Input::get('hello', 'default');;
    }

    protected function debug()
    {
        Debug::show('hello');
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        Debug::show($data);
    }

    protected function configure()
    {
        echo Configure::get('database', 'mysql.host');
    }

    protected function client()
    {
        Debug::show(Client::system());
        Debug::show(Client::browser());
        Debug::show(Client::equipment());
        Debug::show(Client::ip());
        Debug::show(Client::language());
        Debug::show(Client::isWeixin());
    }

    protected function validate()
    {
        Debug::show(Validate::email('demo@demo.com'));
        Debug::show(Validate::email('demo'));
        Debug::show(Validate::mobilephone('15555555555'));
        Debug::show(Validate::mobilephone('1555555555'));
    }

    protected function convert()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        echo Convert::arrayToJSON($data);
    }

    protected function image()
    {
        // Image::compression();
    }

    protected function weixin()
    {
        // Weixin::compression();
    }

    protected function cookie()
    {
        Cookie::set('hello', 'world');
        echo Cookie::get('hello');
    }

    protected function library()
    {
        new HelloWorld();
    }

    protected function time()
    {
        $result = DateTime::now()->toDateTimeString();
        Debug::show($result);
    }

    protected function mysql()
    {
        $database = new Database();
        $result = $database::table('book')->get();
        Debug::show($result);
    }

    protected function paginate()
    {
        $database = new Database();
        $result = $database::table('book')->paginate(2);
        echo $result->render();
    }

    protected function model()
    {
        $result = Book::all();
        Debug::show($result);
    }

}