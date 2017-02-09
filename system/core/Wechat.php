<?php

/**
 * CodeMommy WebPHP
 * @author  Candison November <www.kandisheng.com>
 */

namespace CodeMommy\WebPHP;

use CodeMommy\WebPHP\Http;
use CodeMommy\WebPHP\Me;

class Wechat
{
//    public static function getAccessToken($app_id, $app_secret)
//    {
//        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $app_id . "&secret=" . $app_secret;
//        $result = Http::get($url);
//        $result_json = json_decode($result, true);
//        $token = $result_json["access_token"];
//        return $token;
//    }
//
//    public static function getJsapiTicket($access_token)
//    {
//        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $access_token . "&type=jsapi";
//        $result = Http::get($url);
//        $result_json = json_decode($result, true);
//        $ticket = $result_json["ticket"];
//        return $ticket;
//    }
//
//    public static function getJsConfig($app_id, $jsapi_ticket)
//    {
//        $return = array();
//        $return["appId"] = $app_id;
//        $return["timestamp"] = time();
//        $return["nonceStr"] = "AnyString";;
//        $return["url"] = Me::url();
//        $return["signature"] = sha1(sprintf("jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s", $jsapi_ticket, $return["nonceStr"], $return["timestamp"], $return["url"]));
//        return $return;
//    }
//
//    public static function saveMedia($access_token, $media_id, $save_path)
//    {
//        if (!is_dir($save_path)) {
//            mkdir($save_path, 0777, true);
//        }
//        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=" . $access_token . "&media_id=" . $media_id;
//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//        curl_setopt($ch, CURLOPT_NOBODY, 0);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        $curl_body = curl_exec($ch);
//        $curl_header = curl_getinfo($ch);
//        curl_close($ch);
//        if ($curl_header["content_type"] == "image/jpeg") {
//            $filename = $media_id . ".jpg";
//        } else {
//            $filename = $media_id;
//        }
//        $filecontent = $curl_body;
//        $local_file = fopen($save_path . $filename, "w");
//        if (false !== $local_file) {
//            if (false !== fwrite($local_file, $filecontent)) {
//                fclose($local_file);
//                return $filename;
//            }
//        }
//    }
//
//    public static function getOauth2Url($app_id, $redirect_uri, $is_get_information)
//    {
//        $redirect_uri = urlencode($redirect_uri);
//        $scope = "";
//        if ($is_get_information == true) {
//            $scope = "snsapi_userinfo";
//        } else {
//            $scope = "snsapi_base";
//        }
//        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $app_id . "&redirect_uri=" . $redirect_uri . "&response_type=code&scope=" . $scope . "&state=state#wechat_redirect";
//        return $url;
//    }
//
//    public static function getOauth2AccessToken($appid, $secret, $code)
//    {
//        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $appid . "&secret=" . $secret . "&code=" . $code . "&grant_type=authorization_code";
//        $result = Http::get($url);
//        $return = json_decode($result, true);
//        return $return;
//    }
//
//    public static function getOauth2Information($access_token, $openid)
//    {
//        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
//        $result = Http::get($url);
//        $return = json_decode($result, true);
//        return $return;
//    }
}