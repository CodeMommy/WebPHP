<?php

/*
 * @author   Candison November (www.kandisheng.com)
 * @location Nanjing China
 */

use LuckyPHP\Controller;
use LuckyPHP\Output;
use LuckyPHP\Session;
use LuckyPHP\Input;
use LuckyPHP\Debug;
use LuckyPHP\Client;
use LuckyPHP\Config;
use LuckyPHP\Convert;
use LuckyPHP\Is;
use LuckyPHP\Database;
use LuckyPHP\DateTime;
use LuckyPHP\Me;
use LuckyPHP\Log;
use LuckyPHP\Mail;
use LuckyPHP\Cache;
use LuckyPHP\Redis;
use CodeMommy\Cookie;

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

    protected function library()
    {
        new HelloWorld();
    }

    protected function me()
    {
        echo 'Root: ' . Me::root() . '<br>';
        echo 'URL: ' . Me::url() . '<br>';
        echo 'Domain: ' . Me::domain() . '<br>';
        echo 'Scheme: ' . Me::scheme() . '<br>';
        echo 'Path: ' . Me::path() . '<br>';
        echo 'Query: ' . Me::query() . '<br>';
    }

    protected function time()
    {
        $result = DateTime::now()->toDateTimeString();
        Debug::show($result);
    }

    protected function database()
    {
        $database = new Database();
        $result = $database::table('book')->get();
        Debug::show($result);
    }

    protected function databasePaginate()
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

    protected function redirect()
    {
        return Output::redirect('http://www.microsoft.com');
    }

    protected function cookie()
    {
        Cookie::set('hello', 'world');
        echo Cookie::get('hello');
    }

    protected function session()
    {
        echo Session::set('hello', 'world');
        echo Session::get('hello');
        echo Session::isExist('hello');
        echo Session::clear();
    }

    protected function showPage()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        return Output::template('index/start.html', $data);
    }

    protected function showJSON()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        return Output::json($data);
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

    protected function config()
    {
        echo Config::get('database.mysql.host');
    }

    protected function client()
    {
        Debug::show(Client::system());
        Debug::show(Client::browser());
        Debug::show(Client::equipment());
        Debug::show(Client::ip());
        Debug::show(Client::language());
        Debug::show(Client::isWeChat());
    }

    protected function is()
    {
        Debug::show(Is::email('demo@demo.com'));
        Debug::show(Is::email('demo'));
        Debug::show(Is::chinaMobilephoneNumber('15555555555'));
        Debug::show(Is::chinaMobilephoneNumber('1555555555'));
    }

    protected function convert()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        echo Convert::arrayToJSON($data);
    }

    protected function log()
    {
        $log = new Log('Demo',APPLICATION_ROOT.'/cache/log/log.log');
        $log->debug('Yes');
    }

    protected function mail()
    {
        $mail = new Mail('', 25, '', '');
        $result = $mail->send('', '', '', '', '','');
        Debug::show($result);
    }

    protected function cache()
    {
        Cache::set('cache', 'test', 10);
        echo Cache::get('cache');
    }

    protected function redis()
    {
        $redis = new Redis();
        $redis->set('cache', 'test', 10);
        echo $redis->get('cache');
    }

    protected function upload()
    {
        Input::file('file', 'static/upload/');
    }
}