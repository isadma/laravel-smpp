<?php
declare(strict_types=1);

namespace Isadma\LaravelSmpp;

use Isadma\LaravelSmpp\Transport\Socket;

class SmppService
{
    public static function send(string $recipient, string $message): void
    {
        $ip       = config('smpp.ip');
        $port     = (int) config('smpp.port');
        $from     = config('smpp.from');
        $username = config('smpp.username');
        $password = config('smpp.password');
        $timeout  = (int) config('smpp.timeout', 10000); // optional default

        $transport = new Socket([$ip], $port);
        $transport->debug = false;
        $transport->setRecvTimeout($timeout);

        $smpp = new Client($transport);

        $smpp->bindTransceiver($username, $password);

        $fromAddress = new Address($from, Smpp::TON_ALPHANUMERIC);
        $toAddress   = new Address($recipient, Smpp::TON_INTERNATIONAL, Smpp::NPI_E164);

        $smpp->sendSMS($fromAddress, $toAddress, $message, null, Smpp::DATA_CODING_UCS2);

        $smpp->close();
    }
}