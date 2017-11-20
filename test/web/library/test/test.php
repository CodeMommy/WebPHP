<?php

/**
 * CodeMommy WebPHP
 * @author Candison November <www.kandisheng.com>
 */

use CodeMommy\CookiePHP\Cookie;
use CodeMommy\CachePHP\Cache;
use CodeMommy\ConfigPHP\Config;
use CodeMommy\IsPHP\Is;
use CodeMommy\RequestPHP\Request;
use CodeMommy\ResponsePHP\Response;
use CodeMommy\ClientPHP\Client;
use CodeMommy\ServerPHP\Server;
use CodeMommy\SessionPHP\Session;
use CodeMommy\ConvertPHP\Convert;
use CodeMommy\ImagePHP\Image;

use CodeMommy\WebPHP\Controller;
use CodeMommy\WebPHP\Debug;
use CodeMommy\WebPHP\Database;
use CodeMommy\WebPHP\DateTime;
use CodeMommy\WebPHP\Log;
use CodeMommy\WebPHP\Mail;
use CodeMommy\WebPHP\View;
use CodeMommy\WebPHP\Environment;

use Model\Demo;

/**
 * Class Test
 * @package Controller
 */
class Test
{
    public function view()
    {
        $data = array();
        $data['root'] = Request::root();
        return View::render('test', $data);
    }

    public function library()
    {
        new HelloWorld();
    }

    public function request()
    {
        echo 'Root: ' . Request::root() . '<br>';
        echo 'URL: ' . Request::url() . '<br>';
        echo 'Domain: ' . Request::domain() . '<br>';
        echo 'Scheme: ' . Request::scheme() . '<br>';
        echo 'Path: ' . Request::path() . '<br>';
        echo 'Query: ' . Request::query() . '<br>';
    }

    public function server()
    {
        Server::information();
    }

    public function time()
    {
        $result = DateTime::now()->toDateTimeString();
        Debug::show($result);
    }

    public function database()
    {
        $database = new Database();
        $result = $database::table('book')->get();
        Debug::show($result);
    }

    public function databasePaginate()
    {
        $database = new Database();
        $result = $database::table('book')->paginate(2);
        echo $result->render();
    }

    public function model()
    {
        $result = Demo::all();
        Debug::show($result);
    }

    public function redirect()
    {
        return Response::redirect('http://www.microsoft.com');
    }

    public function cookie()
    {
        Cookie::set('hello', 'world');
        echo Cookie::get('hello');
    }

    public function session()
    {
        echo Session::set('hello', 'world');
        echo Session::get('hello');
        echo Session::isExist('hello');
        echo Session::clear();
    }

    public function showPage()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        return View::render('demo', $data);
    }

    public function showJSON()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        return Response::json($data);
    }

    public function input()
    {
        echo Request::inputGet('hello', 'default');;
    }

    public function debug()
    {
        Debug::show('hello');
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        Debug::show($data);
    }

    public function config()
    {
        echo Config::get('database.mysql.host');
    }

    public function client()
    {
        Debug::show(Client::system());
        Debug::show(Client::browser());
        Debug::show(Client::equipment());
        Debug::show(Client::ip());
        Debug::show(Client::language());
        Debug::show(Client::isWeChat());
    }

    public function is()
    {
        Debug::show(Is::email('demo@demo.com'));
        Debug::show(Is::email('demo'));
        Debug::show(Is::chinaCellPhoneNumber('15555555555'));
        Debug::show(Is::chinaCellPhoneNumber('1555555555'));
    }

    public function convert()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        echo Convert::arrayToJSON($data);
    }

    public function log()
    {
        $log = new Log('Demo', APPLICATION_ROOT . '/_runtime/log/log.log');
        $log->debug('Yes');
    }

    public function mail()
    {
        $mail = new Mail('', 25, '', '');
        $result = $mail->send('', '', '', '', '', '');
        Debug::show($result);
    }

    public function cache()
    {
        Cache::writeValue('cache', 'test', 10);
        echo Cache::readValue('cache');
    }

//    protected function redis()
//    {
//        $redis = new Redis();
//        $redis->set('cache', 'test', 10);
//        echo $redis->get('cache');
//    }

    public function upload()
    {
        Request::inputFile('file', 'static/upload/');
    }
}
