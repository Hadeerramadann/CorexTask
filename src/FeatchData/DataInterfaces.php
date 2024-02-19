<?php

namespace App\FeatchData;

interface APIDataFetcherInterface
{
    public function fetchData(): array;
}

interface JSONFileWriterInterface
{
    public function saveData(array $data): void;
}
