<?php
// This trait is only functional with the same structure of the app
namespace app\services;

trait Response
{
    public function render(string $view, ?array $viewData = null): void
    {
        if (!empty($viewData)) {
            extract($viewData);
        }
        $viewFile = __DIR__ . "/../views/$view.php";
        require_once $viewFile;
    }
}