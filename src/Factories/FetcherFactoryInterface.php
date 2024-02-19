<?php
namespace App\Factories;

use App\FeatchData\APIDataFetcherInterface;
use App\FeatchData\JSONFileWriterInterface;

interface FetcherFactoryInterface
{
    public function createAPIDataFetcher(array $apiLinks): APIDataFetcherInterface;

    public function createJSONFileWriter(string $filePath): JSONFileWriterInterface;
}
