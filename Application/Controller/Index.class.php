<?php

use LuckyPHP\Core\Controller;
use LuckyPHP\Core\View;
use LuckyPHP\Core\Router;
use LuckyPHP\Core\Session;
use LuckyPHP\Core\Input;
use LuckyPHP\Core\Debug;
use LuckyPHP\Core\Client;
use LuckyPHP\Core\Configure;
use LuckyPHP\Core\Convert;
use LuckyPHP\Core\Validate;
use LuckyPHP\Core\Database;
use LuckyPHP\Core\Cookie;

class IndexController extends Controller
{
    public function index()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'LuckyPHP';
        View::showPage('Index/index.html', $data);
    }

    public function redirect()
    {
        Router::redirect('http://www.microsoft.com');
    }

    public function setSession()
    {
        echo Session::set('hello', 'world');
    }

    public function getSession()
    {
        echo Session::get('hello');
    }

    public function isExistSession()
    {
        echo Session::isExist('hello');
    }

    public function clearSession()
    {
        echo Session::clear();
    }

    public function showPage()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        View::showPage('Index/showPage.html', $data);
    }

    public function showJSON()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        View::showJSON($data);
    }

    public function input()
    {
        echo Input::get('hello', 'default');;
    }

    public function debug()
    {
        Debug::show('hello');
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        Debug::show($data);
    }

    public function configure()
    {
        echo Configure::get('hello');
    }

    public function client()
    {
        Debug::show(Client::system());
        Debug::show(Client::browser());
        Debug::show(Client::equipment());
        Debug::show(Client::ip());
        Debug::show(Client::language());
        Debug::show(Client::isWeixin());
    }

    public function validate()
    {
        Debug::show(Validate::email('demo@demo.com'));
        Debug::show(Validate::email('demo'));
        Debug::show(Validate::mobilephone('15555555555'));
        Debug::show(Validate::mobilephone('1555555555'));
    }

    public function convert()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        echo Convert::arrayToJSON($data);
    }

    public function image()
    {
        // Image::compression();
    }

    public function weixin()
    {
        // Weixin::compression();
    }

    public function mysql()
    {
        Database::init();
        $book = Database::dispense('book');
        $book->title = 'Hello';
        $id = Database::store($book);
        Debug::show(R::findAll('book'));
    }

    public function cookie()
    {
        Cookie::set('hello', 'world');
        echo Cookie::get('hello');
    }

    public function vendor()
    {
        new HelloWorld();
    }
}