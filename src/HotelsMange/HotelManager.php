<?php

namespace APP\HotelsMange;

class HotelManager
{
    private $rooms;

    public function __construct($rooms)
    {
        $this->rooms = $rooms;
    }

    public function findCheapestRoomByKind()
    {
        $cheapestRooms = [];
        $uniqueKinds = [];

        // Collect all unique room kinds
        foreach ($this->rooms as $room) {
            $uniqueKinds[$room->getCode()] = true;
        }

        // Find cheapest room for each kind
        foreach ($uniqueKinds as $kind => $value) {
            $cheapestRoom = null;
            $lowestPrice = PHP_INT_MAX;

            foreach ($this->rooms as $room) {
                if ($room->getCode() == $kind && $room->getPrice() < $lowestPrice) {
                    $cheapestRoom = $room;
                    $lowestPrice = $room->getPrice();
                }
            }

            // Add cheapest room for the kind to the result array
            $cheapestRooms[$kind] = $cheapestRoom;
        }

        return $cheapestRooms;
    }

}
