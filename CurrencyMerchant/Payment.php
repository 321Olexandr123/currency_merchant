<?php

namespace CurrencyMerchant\CurrencyMerchant;

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
     * @param string $currency
     * @param string $payment_system
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public static function invoices(string $bearer, float $amount, string $return_url, string $reference_id, string $callback_url, string $currency, string $payment_system)
    {
        $client = new NativeHttpClient();

        $response = $client->request('POST', 'https://curm.crpt.trading/payment/invoices', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $bearer
            ],
            'json' => [
                'amount' => $amount,
                'return_url' => $return_url,
                'reference_id' => $reference_id,
                'callback_url' => $callback_url,
                'currency' => $currency,
                'payment_system' => strtoupper($payment_system)
            ]
        ]);
        return $response->toArray();
    }

    /**
     * @param string $bearer
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public static function getBalance(string $bearer)
    {
        $client = new NativeHttpClient();
        $response = $client->request('GET', 'https://curm.crpt.trading/total/balance', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $bearer
            ],
        ]);
        return $response->toArray();
    }
}