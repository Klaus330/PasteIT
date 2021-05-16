<?php


namespace app\controllers;


class CaptchaController extends Controller
{
    public static function genCaptcha(){
        $randomString = md5(rand());
        $captchaCode = substr($randomString, 0, 6);
        session()->setFlash("captcha_code", $captchaCode);

        $image = \imagecreatetruecolor(200, 38);
        $backgroundColor = \imagecolorallocate($image, 255,255,255);

        $textcolor = \imagecolorallocate($image, 0, 0, 0);
        $font = './fonts/Roboto.ttf';
        \imagefilledrectangle($image, 0, 0, 200, 38, $backgroundColor);


        $lineColor = imagecolorallocate($image, 64, 64, 64);
        for($i=0;$i<5;$i++){
            \imageline($image,0, rand()%38,200,rand()%38, $lineColor);
        }

        $pixelColor = imagecolorallocate($image, 0, 0, 255);
        for($i=0;$i<1000;$i++){
            \imagesetpixel($image,rand()%200,rand()%38, $pixelColor);
        }


        \imagettftext($image, 20, 0, 60, 28, $textcolor, $font, $captchaCode);

        $fileName = rand() . ".png";
        $path = app()::$ROOT_DIR . "/public/captcha/" . $fileName;

        \imagepng($image, $path);
        \imagedestroy($image);

        session()->setFlash("captcha_path", $path);

        return "/captcha/" . $fileName;
    }
}