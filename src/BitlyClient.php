<?php

namespace BRamalho\LaravelBitlyClient;

use GuzzleHttp\Client;

class BitlyClient
{
    private $bitlyURL = 'http://api.bitly.com/v3/shorten';

    /**
     * @param $url
     * @return array
     * @throws InvalidCredentialsException
     * @throws UnableToGenerateURLException
     */
    public function generate($url)
    {
        $options = $this->getCredentials();
        $options['longUrl'] = $url;
        $options['format'] = 'json';

        $data = $this->getData($options);

        return $data;
    }

    /**
     * @return array
     * @throws InvalidCredentialsException
     */
    private function getCredentials()
    {
        $login = config('bitly.login');
        $apiKey = config('bitly.api_key');

        if (!$login || !$apiKey) {
            throw new InvalidCredentialsException();
        }

        return [
            'login' => $login,
            'apiKey' => $apiKey
        ];
    }

    /**
     * @param $options
     * @return array
     * @throws UnableToGenerateURLException
     */
    private function getData($options)
    {
        $client = new Client();

        $data = $client->get($this->bitlyURL . '?' . http_build_query($options));

        if ($data->getStatusCode() !== 200 || $data->getReasonPhrase() !== 'OK') {
            throw new UnableToGenerateURLException();
        }

        $result = json_decode($data->getBody()->getContents(), true);

        if ($result['status_code'] !== 200 || $result['status_txt'] !== 'OK') {
            throw new UnableToGenerateURLException();
        }

        return $result['data'];
    }
}
