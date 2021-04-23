<?php


class HighlightSeeder implements \app\core\Seeder
{

    public function run()
    {
        $syntax = new \app\models\Syntax();

        $syntax->name = "C++";
        $syntax->save();

        $syntax->name = "Javascript";
        $syntax->save();


        $syntax->name = "Java";
        $syntax->save();


        $syntax->name = "Python";
        $syntax->save();
    }
}