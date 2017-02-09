<?php

/**
 * CodeMommy Web for PHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\Web;

class Client
{
    public static function userAgent()
    {
        return isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    }

    public static function system()
    {
        $userAgent = strtolower(self::userAgent());
        if (preg_match('/win/i', $userAgent)) {
            return 'Windows';
        }
        if (preg_match('/mac/i', $userAgent)) {
            return 'MAC';
        }
        if (preg_match('/linux/i', $userAgent)) {
            return 'Linux';
        }
        if (preg_match('/unix/i', $userAgent)) {
            return 'Unix';
        }
        if (preg_match('/bsd/i', $userAgent)) {
            return 'BSD';
        }
        if (preg_match('/iphone/i', $userAgent)) {
            return 'iOS';
        }
        if (preg_match('/android/i', $userAgent)) {
            return 'Android';
        }
        if (preg_match('/ipad/i', $userAgent)) {
            return 'iOS';
        }
        return 'Unknown';
    }

    public static function browser()
    {
        $userAgent = strtolower(self::userAgent());
        if (preg_match('/MSIE/i', $userAgent)) {
            return 'MSIE';
        }
        if (preg_match('/Firefox/i', $userAgent)) {
            return 'Firefox';
        }
        if (preg_match('/Chrome/i', $userAgent)) {
            return 'Chrome';
        }
        if (preg_match('/Safari/i', $userAgent)) {
            return 'Safari';
        }
        if (preg_match('/Opera/i', $userAgent)) {
            return 'Opera';
        }
        return 'Unknown';
    }

    public static function equipment()
    {
        $userAgent = strtolower(self::userAgent());
        if (strpos($userAgent, 'windows nt')) {
            return 'PC';
        }
        if (strpos($userAgent, 'mac os')) {
            return 'PC';
        }
        if (strpos($userAgent, 'iphone')) {
            return 'Mobile';
        }
        if (strpos($userAgent, 'android')) {
            return 'Mobile';
        }
        if (strpos($userAgent, 'ipad')) {
            return 'Pad';
        }
        return 'Unknown';
    }

    public static function ip()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            return getenv('HTTP_CLIENT_IP');
        }
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            return getenv('HTTP_X_FORWARDED_FOR');
        }
        if (getenv('HTTP_X_FORWARDED')) {
            return getenv('HTTP_X_FORWARDED');
        }
        if (getenv('HTTP_FORWARDED_FOR')) {
            return getenv('HTTP_FORWARDED_FOR');
        }
        if (getenv('HTTP_FORWARDED')) {
            return getenv('HTTP_FORWARDED');
        }
        if ($_SERVER['REMOTE_ADDR']) {
            return $_SERVER['REMOTE_ADDR'];
        }
        return '';
    }

    public static function language()
    {
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);
            if (preg_match('/zh-cn/i', $language)) {
                return '简体中文';
            }
            if (preg_match('/zh/i', $language)) {
                return '繁體中文';
            }
        }
        return 'Unknown';
    }

    public static function isWeChat()
    {
        $userAgent = strtolower(self::userAgent());
        if (strpos($userAgent, 'micromessenger') === false) {
            return false;
        }
        return true;
    }
}