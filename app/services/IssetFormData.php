<?php

namespace app\services;

trait IssetFormData
{
    public function issetFormData(?array $post = null): bool
    {
        if (!empty($post)) {
            foreach ($post as $key => $value) {
                if (!isset($post[$key])) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }
}
