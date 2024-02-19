<?php

use PHPUnit\Framework\TestCase;
use App\HotelsMange\HotelManager;
use App\HotelsMange\Room;

class HotelManagerTest extends TestCase
{
    public function testFindCheapestRoomByKind()
    {
        // Set up test data
        $rooms = [
            new Room('DBL-RM', 100, 'Hotel A'),
            new Room('DBL-RM', 110, 'Hotel B'),
            new Room('SNG-RM', 90, 'Hotel C'),
          

        ];

        // Create HotelManager instance
        $hotelManager = new HotelManager($rooms);

        // Call the method being tested
        $cheapestRooms = $hotelManager->findCheapestRoomByKind();

        // Assertions
        $this->assertCount(2, $cheapestRooms); // Check number of unique room kinds
        $this->assertEquals('Hotel C', $cheapestRooms['SNG-RM']->getHotel()); // Check if [Hotel C] has the cheapest SNG-RM room
        $this->assertEquals('Hotel A', $cheapestRooms['DBL-RM']->getHotel()); // Check if [Hotel A] has the cheapest DBL-RM room
        $this->assertArrayHasKey('SNG-RM', $cheapestRooms); // Check if the cheapest [SNG-RM] room exists
        $this->assertArrayHasKey('DBL-RM', $cheapestRooms); // Check if the cheapest [DBL-RM] room exists
       
        
       
    }
}
