<?php

namespace App\Services;

use Illuminate\Support\Manager;

class QuoteManager extends Manager
{
    public function getDefaultDriver()
    {
        return $this->config->get('quote.provider', 'kanye');
    }
}