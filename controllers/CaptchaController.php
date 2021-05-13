<?php


namespace app\controllers;


use app\core\Application;

class CaptchaController extends Controller
{
    public static function getCaptcha()
    {

        $randomString = md5(rand());
        $captchaCode = substr($randomString, 0, 6);
        $_SESSION['captcha_code'] = $captchaCode;


        $image = \imagecreatetruecolor(200, 38);
        $backgroundColor = \imagecolorallocate($image, 244, 33, 44);

        $textcolor = \imagecolorallocate($image, 0, 0, 0);
        $font = Application::$ROOT_DIR . '/public/fonts/Roboto.ttf';
        \imagefilledrectangle($image, 0, 0, 200, 38, $backgroundColor);
        \imagettftext($image, 20, 0, 60, 28, $textcolor, $font, $captchaCode);


        $fileName = rand() . ".png";
        $path = Application::$ROOT_DIR . "/public/captcha/" . $fileName;
        \imagepng($image, $path);

        return "/captcha/" . $fileName;
    }
}