<?php

namespace App\Routes;

use App\Factories\FetcherFactoryInterface;
class Api
{
    private $routes;


    public function __construct(FetcherFactoryInterface $fetcherFactory)
    {
        $this->fetcherFactory = $fetcherFactory;
        // $this->routes = [
        //     '/FeatchData' => 'ApiDataRequest',
        // ];

      
    }

    // Rest of the class remains the same
    public function dispatch($requestUri)
    {
        if ($requestUri === '/FeatchData') {  

            $api_links = array(
                'https://coresolutions.app/php_task/api/api_v1.php',
                'https://coresolutions.app/php_task/api/api_v2.php',
                'https://coresolutions.app/php_task/api/api_v3.php',
    
                // Add more api links as needed
            );
    
            $file_path = 'hotels.json';
    
            $data_fetcher = new APIDataFetcher($api_links);
    
            $all_data = $data_fetcher->fetchData();
    
            $file_writer = new JSONFileWriter($file_path);
    
            $file_writer->saveData($all_data);
            $response = ['message' => 'success save data'];
            return json_encode($response);

        }

        // if (array_key_exists($requestUri, $this->routes)) {
        //     $handlerFunction = $this->routes[$requestUri];
        //     $response = $this->$handlerFunction();
        //     return $response;
        // } else {
        //     http_response_code(404); // Not Found
        //     return json_encode(['error' => 'Route not found']);
        // }

       
    }

   

}
