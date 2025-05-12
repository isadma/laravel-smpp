<?php

namespace Isadma\LaravelSmpp;

use Smpp\SMPP;
use Smpp\SmppClient;
use Smpp\SmppAddress;
use Smpp\Transport\SocketTransport;

class SmppService
{
    protected SmppClient $client;
    protected SocketTransport $transport;
    protected string $from;

    public function __construct()
    {
        $this->from = config('smpp.from');

        $this->transport = new SocketTransport([config('smpp.ip')], config('smpp.port', 2775));
        $this->transport->setRecvTimeout(10_000);
        $this->transport->open();

        $this->client = new SmppClient($this->transport);
        $this->client->debug = false;

        $this->client->bindTransmitter(
            config('smpp.username'),
            config('smpp.password')
        );
    }

    /**
     * Send an SMS message.
     *
     * @param string $to Recipient phone number with country code without plus
     * @param string $message Text content of the SMS
     * @return bool True if sent successfully
     * @throws \RuntimeException On failure
     */
    public function sendMessage(string $to, string $message): bool
    {
        try {
            $sourceAddr = new SmppAddress($this->from, SMPP::TON_ALPHANUMERIC);
            $destAddr   = new SmppAddress($to, SMPP::TON_INTERNATIONAL, SMPP::NPI_E164);

            $this->client->sendSMS(
                $sourceAddr,
                $destAddr,
                $message,
                null,
                [
                    'receipted_message_id' => uniqid(),
                    'registered_delivery_flag' => SMPP::REG_DELIVERY_SMSC_BOTH,
                ]
            );

            return true;
        } catch (\Exception $e) {
            throw new \RuntimeException(
                'Failed to send SMPP message: ' . $e->getMessage(),
                0,
                $e
            );
        } finally {
            $this->client->close();
        }
    }
}
