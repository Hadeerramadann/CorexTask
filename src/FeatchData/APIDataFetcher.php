<?php

namespace App\FeatchData;

class APIDataFetcher implements APIDataFetcherInterface {
    private $api_links;

    public function __construct($api_links) {
        $this->api_links = $api_links;
    }

    public function fetchData() : array{
        $all_data = array();

        foreach ($this->api_links as $api_link) {
            $json_data = file_get_contents($api_link);

            if ($json_data === FALSE) {
                
                continue;
            }

            $data = json_decode($json_data, true);

            if ($data === NULL) {
               
                continue;
            }

            $all_data[] = $data;
        }

        return $all_data;
    }
}
