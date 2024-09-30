<?php

namespace Script;

set_time_limit(240);
ini_set('memory_limit', '256M');

require_once __DIR__ . '/../vendor/autoload.php';

use Script\Utils\AbstractScript;
use Script\Utils\Runner;

class ConnectionChecker extends AbstractScript
{
    private const MAX_DOWNLOAD_TIME = 240;

    /**
     * @return void
     */
    public function run(): void
    {
        $this->downloadFile();
    }

    /**
     * @return void
     */
    private function downloadFile(): void
    {
        $url = 'https://speedtest.selectel.ru/100MB';
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_TIMEOUT, self::MAX_DOWNLOAD_TIME);

        curl_exec($ch);

        $response = [
            'response_code' => curl_getinfo($ch, CURLINFO_RESPONSE_CODE),
            'total_time' => curl_getinfo($ch, CURLINFO_TOTAL_TIME),
        ];

        if ($response['response_code'] !== 200) {
            $this->logger->critical("Response code: {$response['response_code']}");
        } elseif ($response['total_time'] >= self::MAX_DOWNLOAD_TIME) {
            $this->logger->critical("Total time: {$response['total_time']}");
        }

        curl_close($ch);
    }
}

Runner::run(ConnectionChecker::class);