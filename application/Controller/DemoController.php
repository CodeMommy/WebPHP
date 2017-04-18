<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace Controller;

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

use Model\Demo;

use HelloWorld;

/**
 * Class DemoController
 * @package Controller
 */
class DemoController extends Controller
{
    /**
     * Homepage
     * @return bool
     */
    public function demo()
    {
        $data = array();
        $data['root'] = Request::root();
        return View::render('demo', $data);
    }

    /**
     * Test
     * @return mixed
     */
    public function test()
    {
        $action = Request::inputGet('action', '');
        $string = sprintf('This is a CodeMommy WebPHP test: %s', $action);
        echo sprintf('<title>%s</title>', $string);
        echo sprintf('<h3>%s</h3>', $string);
        return $this->$action();
    }

    protected function library()
    {
        new HelloWorld();
    }

    protected function request()
    {
        echo 'Root: ' . Request::root() . '<br>';
        echo 'URL: ' . Request::url() . '<br>';
        echo 'Domain: ' . Request::domain() . '<br>';
        echo 'Scheme: ' . Request::scheme() . '<br>';
        echo 'Path: ' . Request::path() . '<br>';
        echo 'Query: ' . Request::query() . '<br>';
    }

    protected function server()
    {
        Server::information();
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
        $result = Demo::all();
        Debug::show($result);
    }

    protected function redirect()
    {
        return Response::redirect('http://www.microsoft.com');
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
        return View::render('demo', $data);
    }

    protected function showJSON()
    {
        $data = array();
        $data['hello'] = 'Hello';
        $data['world'] = 'World';
        return Response::json($data);
    }

    protected function input()
    {
        echo Request::inputGet('hello', 'default');;
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
        Debug::show(Is::chinaCellPhoneNumber('15555555555'));
        Debug::show(Is::chinaCellPhoneNumber('1555555555'));
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
        $log = new Log('Demo', APPLICATION_ROOT . '/cache/log/log.log');
        $log->debug('Yes');
    }

    protected function mail()
    {
        $mail = new Mail('', 25, '', '');
        $result = $mail->send('', '', '', '', '', '');
        Debug::show($result);
    }

    protected function cache()
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

    protected function upload()
    {
        Request::inputFile('file', 'static/upload/');
    }
}