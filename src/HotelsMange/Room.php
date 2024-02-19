<?php

namespace APP\HotelsMange;

class Room {
    
    private $code;
    private $price;
    private $hotel;

    public function __construct( $code, $price,$hotel) {
       
        $this->code = $code;
        $this->price = $price;
        $this->hotel = $hotel;

    }

   

    public function getCode() {
        return $this->code;
    }

    public function getPrice() {
        return $this->price;
    }
    public function getHotel() {
        return $this->hotel;
    }
}
