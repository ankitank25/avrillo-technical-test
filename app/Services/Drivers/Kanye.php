<?php

namespace App\Services\Drivers;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Manager;

/**
 *
 */
class Kanye extends Manager
{
    /**
     * @var string|mixed
     */
    private string $apiUrl;
    /**
     * @var string|mixed|null
     */
    private string|null $apiToken;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->apiUrl = $this->config->get('services.kanye.api_url', 'https://api.kanye.rest');
        $this->apiToken = $this->config->get('services.kanye.api_token');
    }

    /**
     * Get default driver
     * @return string
     */
    public function getDefaultDriver(): string
    {
        return 'kanye';
    }

    /**
     * Make api call
     * @return bool|string
     */
    public function make(): bool | string
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->apiToken,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    /**
     * get quote from the api response
     * @return string
     */
    public function getQuote(): string
    {
        $response = $this->make();

        $response = json_decode($response, true);
        if (is_array($response) && isset($response['quote'])) {
            return $response['quote'];
        }

        return "";
    }

    /**
     * get number of quotes
     * @param $limit
     * @return array
     */
    public function getQuotes(int $page = 1, int $limit = 5): array
    {
        $cacheKey = 'quote-' . $limit . ' - ' . $page;
        return Cache::rememberForever($cacheKey, function() use ($limit) {
            $quotes = [];
            for ($i = 1; $i <= $limit; $i++) {
                $quotes[] = $this->getQuote();
            }
            return $quotes;
        });
    }
}
