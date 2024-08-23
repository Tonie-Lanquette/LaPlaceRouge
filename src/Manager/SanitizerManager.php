<?php

namespace App\Manager;


class SanitizerManager
{

    public function sanitize($value): string
    {

        return htmlspecialchars(trim($value));
    }
}
