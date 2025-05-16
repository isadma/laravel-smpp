<?php
declare(strict_types=1);

namespace Isadma\LaravelSmpp;

use Isadma\LaravelSmpp\Transport\Socket;

class SmppService
{
    public static function send(string $recipient, string $message): void
    {
        $ip       = env('SMPP_IP');
        $port     = (int) env('SMPP_PORT');
        $from     = env('SMPP_FROM', '0764');
        $username = env('SMPP_USERNAME');
        $password = env('SMPP_PASSWORD');
        $timeout  = (int) env('SMPP_TIMEOUT', 10000);

        $transport = new Socket([$ip], $port);
        $transport->debug = false;
        $transport->setRecvTimeout($timeout);
        $transport->open();
        $smpp = new Client($transport);

        $smpp->bindTransceiver($username, $password);

        $fromAddress = new Address($from, Smpp::TON_ALPHANUMERIC);
        $toAddress   = new Address($recipient, Smpp::TON_INTERNATIONAL, Smpp::NPI_E164);

        $smpp->sendSMS($fromAddress, $toAddress, $message, null, Smpp::DATA_CODING_UCS2);

        $smpp->close();
    }
}