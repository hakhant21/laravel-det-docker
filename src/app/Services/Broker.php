<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\Exceptions\MqttClientException;

class Broker
{
    private MqttClient $client;

    private ConnectionSettings $settings;

    public function __construct(array $configs)
    {
        $this->client = new MqttClient($configs['host'], $configs['port'], $configs['client_id']);

        $this->settings = (new ConnectionSettings())
                        ->setUsername($configs['username'])
                        ->setPassword($configs['password'])
                        ->setKeepAliveInterval($configs['keep_alive']);

        $this->client->connect($this->settings);
    }

    public function publish(string $topic, string $message): void
    {
        try {
            $this->client->publish($topic, $message, 0, false);

            echo 'Message sent to topic: ' . $topic . PHP_EOL;

            $this->client->disconnect();
        } catch (MqttClientException $e) {
            $this->client->disconnect();

            echo $e->getMessage();
        }
    }

    public function subscribe(string $topic, callable $callback): void
    {
        try {
            $this->client->subscribe($topic, $callback, 0);

            echo 'Subscribed to topic: ' . $topic . PHP_EOL;
        } catch (MqttClientException $e) {
            $this->client->disconnect();

            echo $e->getMessage();
        }
    }

    public function disconnect(): void
    {
        $this->client->disconnect();
    }

    public function loop(): void
    {
        $this->client->loop(true);
    }
}
