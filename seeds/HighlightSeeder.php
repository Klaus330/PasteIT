<?php


class HighlightSeeder implements \app\core\Seeder
{

    public function run()
    {
        $this->generateFromArray([
            'C++',
            'PHP',
            'Python',
            'JAVA',
            'Javascript',
            'HTML',
            'CSS',
            'SQL',
            'C'
        ]);
    }


    public function generateFromArray($arr)
    {
        foreach ($arr as $name){
            $syntax = new \app\models\Syntax();

            $syntax->name = $name;
            $syntax->save();
        }
    }


}