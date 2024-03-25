<?php

namespace app\services;

trait Response
{
    public function render(string $view, ?array $viewData = null): void
    {
        // if (!empty($viewData)) {
        //     foreach ($viewData as $key => $value) {
        //         ${$key} = $value;
        //     }
        // }
        if (!empty($viewData)) {
            extract($viewData);
        }
        $viewFile = __DIR__ . "/../views/$view.php";
        require_once $viewFile;
    }
}