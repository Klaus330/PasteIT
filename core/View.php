<?php


namespace app\core;


class View
{
    protected string $title;

    /**
     * View constructor.
     * @param string $title
     */
    public function __construct()
    {
        $this->title = Application::$config['app_title'];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    public function renderView($view, $params = [])
    {
        $viewContent  = $this->renderOnlyView($view, $params);

        return $this->renderContent($viewContent);
    }

    public function layoutContent()
    {
        $layout = Application::$app->layout;
        if(Application::$app->controller){
            $layout = Application::$app->controller->getLayout();
        }

        ob_start();
        include Application::$ROOT_DIR."/resources/views/layouts/{$layout}.view.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params = []){

        foreach($params as $key => $value){
            $$key = $value;
        }

        ob_start();
        include Application::$ROOT_DIR."/resources/views/{$view}.view.php";
        return ob_get_clean();
    }

    public function renderPartial($partial, $params = []){
        return $this->renderOnlyView("/partials/{$partial}", $params);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        $nav = $this->renderPartial('nav');
        $footer = $this->renderPartial('footer');
        $layoutContent = str_replace('{{content}}', $viewContent, $layoutContent);
        $layoutContent = str_replace('{{nav}}', $nav, $layoutContent);

        return str_replace('{{footer}}', $footer, $layoutContent);
    }
}