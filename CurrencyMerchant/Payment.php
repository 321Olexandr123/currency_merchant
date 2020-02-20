<?php


use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class Payment
{
    /**
     * @param string $bearer
     * @param float $amount
     * @param string $return_url
     * @param string $reference_id
     * @param string $callback_url
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public static function invoices(string $bearer, float $amount, string $return_url, string $reference_id, string $callback_url)
    {
        $client = new NativeHttpClient();

        $response = $client->request('POST', 'http://uapay.crpt.trading/payment/invoices', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $bearer
            ],
            'json' => [
                'amount' => $amount,
                'return_url' => $return_url,
                'reference_id' => $reference_id,
                'callback_url' => $callback_url
            ]
        ]);
        return $response->toArray();
    }
}