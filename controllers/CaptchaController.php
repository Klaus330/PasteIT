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
        $textcolors[] = $textcolor;

        $textcolor = \imagecolorallocate($image, 10, 50, 233);
        $textcolors[] = $textcolor;

        $fonts = ['./fonts/Roboto.ttf','./fonts/Reggae.ttf'];
        \imagefilledrectangle($image, 0, 0, 200, 38, $backgroundColor);


        $lineColor = imagecolorallocate($image, 64, 64, 64);
        for($i=0;$i<5;$i++){
            \imageline($image,0, rand()%38,200,rand()%38, $lineColor);
        }

        $pixelColor = imagecolorallocate($image, 0, 0, 255);
        for($i=0;$i<1000;$i++){
            \imagesetpixel($image,rand()%200,rand()%38, $pixelColor);
        }


        for($i=0; $i<strlen($captchaCode);$i++){
            $letter_space = 170/strlen($captchaCode);
            $initial = 15;

            imagettftext($image, 20, rand(-15,15), $initial+$i*$letter_space,28,$textcolors[rand(0, 1)],$fonts[rand(0,1)],$captchaCode[$i]);
        }

        $fileName = rand() . ".png";
        $path = app()::$ROOT_DIR . "/public/captcha/" . $fileName;

        \imagepng($image, $path);
        \imagedestroy($image);

        session()->setFlash("captcha_path", $path);

        return "/captcha/" . $fileName;
    }
}