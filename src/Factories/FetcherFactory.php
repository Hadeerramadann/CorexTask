<?php

namespace App\Factories;

use App\FeatchData\APIDataFetcher;
use App\FeatchData\APIDataFetcherInterface;
use App\FeatchData\JSONFileWriter;
use App\FeatchData\JSONFileWriterInterface;

class FetcherFactory implements FetcherFactoryInterface
{
    public function createAPIDataFetcher(array $apiLinks): APIDataFetcherInterface
    {
        return new APIDataFetcher($apiLinks);
    }

    public function createJSONFileWriter(string $filePath): JSONFileWriterInterface
    {
        return new JSONFileWriter($filePath);
    }
}
