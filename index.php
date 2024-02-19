<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Container;
use App\HotelsMange\HotelManager;
use App\HotelsMange\Room;
use App\Routes\Api;
use App\Factories\FetcherFactory;


$fetcherFactory = new FetcherFactory();
$router = new Api($fetcherFactory);

$route = $_GET['route'] ?? '';
$response = $router->dispatch($route);
// echo $response."<br>";
$decodedData = json_decode(file_get_contents(__DIR__ . '/hotels.json'), true);

if ($decodedData === null) {

    echo "Error decoding JSON data\n";
} else {

    $roomsData = [];

    foreach ($decodedData as $hotels) {
        foreach ($hotels as $hotel) {
            // Check if $hotel is an array and contains the 'name' key
            if (is_array($hotel) && array_key_exists('name', $hotel)) {
                $hotelName = $hotel['name'];

                foreach ($hotel['rooms'] as $room) {
                    $room['hotel'] = $hotelName;
                    $roomsData[] = $room;
                }
            } else {

                echo "Warning: Invalid hotel entry" . PHP_EOL;
            }
        }
    }

    // var_dump( $roomsData);
}

$container = new Container();
$container->add('rooms', function () use ($roomsData) {

    $rooms = [];

    foreach ($roomsData as $roomData) {
        $price = floatval($roomData['total'] ?? $roomData['totalPrice'] ?? 0);
        $rooms[] = new Room($roomData['code'], $price, $roomData['hotel']);
    }

    return $rooms;
});

$rooms = $container->get('rooms');
if ($rooms instanceof Closure) {

    $rooms = $rooms();
}

$hotelManager = new HotelManager($rooms);

$cheapestRooms = $hotelManager->findCheapestRoomByKind();

// Output cheapest room information for each kind
foreach ($cheapestRooms as $kind => $cheapestRoom) {
    if ($cheapestRoom) {
        echo "Cheapest [$kind]<br> Hotel Name: {$cheapestRoom->getHotel()}, Total Price with tax: {$cheapestRoom->getPrice()}<br>------------------------<br>";
    } else {
        echo "No $kind room found.\n";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Corex Task</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<!-- <div id="Response"></div> -->

<script>
$(document).ready(function(){
    $.ajax({
        url: "index.php",
        type: "GET",
        data: {
            route: "/FeatchData"
        },
        success: function(response) {
            $("#Response").html(response);
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
});
</script>

</body>
</html>
