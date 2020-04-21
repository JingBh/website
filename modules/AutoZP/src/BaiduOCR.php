<?php
namespace JingBh\AutoZP;

use GuzzleHttp\Client;

class BaiduOCR
{
    /**
     * 调用数字识别接口
     *
     * @param string $image Base64URLEncode后的图片
     * @return array 接口返回内容
     * @throws \Throwable
     */
    public static function numbers($image) {
        $token = self::getToken();
        $client = self::httpClient();
        $response = $client->post("rest/2.0/ocr/v1/numbers", [
            "query" => [
                "access_token" => $token
            ],
            "form_params" => [
                "image" => $image,
                "recognize_granularity" => "big",
                "detect_direction" => "false"
            ]
        ]);
        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }

    /**
     * 获取认证秘钥
     *
     * @param string|null $api_key
     * @param string|null $secret_key
     * @return string Access Token
     * @throws \Throwable 当认证失败时报错
     */
    protected static function getToken($api_key=null, $secret_key=null) {
        if (blank($api_key)) $api_key = config("jingbh.baidu_aip.api_key");
        if (blank($secret_key)) $secret_key = config("jingbh.baidu_aip.secret_key");

        $client = self::httpClient();
        $response = $client->post("oauth/2.0/token", [
            "query" => [
                "grant_type" => "client_credentials",
                "client_id" => $api_key,
                "client_secret" => $secret_key
            ]
        ]);
        $body = json_decode($response->getBody()->getContents());
        // throw_if(property_exists($body, "error"), "BaiduAPIRequestError: [{$body->error}] {$body->error_description}");
        return $body->access_token;
    }

    protected static function httpClient() {
        return new Client([
            "base_uri" => "https://aip.baidubce.com/",
            "headers" => [
                "User-Agent" => "Mozilla/5.0 JWS AutoZPBot"
            ]
        ]);
    }
}
