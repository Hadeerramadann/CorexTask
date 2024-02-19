<?php

namespace App\FeatchData;

class JSONFileWriter implements JSONFileWriterInterface {
    private $file_path;

    public function __construct($file_path) {
        $this->file_path = $file_path;
    }

    public function saveData($data): void {
        $json_encoded_data = json_encode($data, JSON_PRETTY_PRINT);

        if (file_put_contents($this->file_path, $json_encoded_data) === FALSE) {
           
            die('Error saving JSON data to file');
        }

        // echo 'All data saved to file: ' . $this->file_path;
    }

    
}
