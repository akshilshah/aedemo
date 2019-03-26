<?php
// error reporting to 0 when put in production
error_reporting(0);

// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get the address from "FORM DATA" 
$address = urlencode($_POST['address']);
// TODO: add raw data post : NOT ADDED as I don't think it was necessary at this point
// check if the address is empty
if(empty($address)) {
    // set response code - 404 Not found
    http_response_code(404);
    // return message
    echo json_encode(
        array("message" => "Please enter address")
    );
} else {
    // request google api 
    $request = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=" . $address . "&key=AIzaSyBqeBP7gdpfsw1hxbuv10eLUbMC-OgFqtM");
    $json = json_decode($request, true); // store the fetched data
    
    $data = array(); // store the required formated data
    foreach ($json['results']['0']['address_components'] as $element) {
        $data[implode(' ', $element['types'])] = $element['long_name'];
    }
    // check if the address is fetched
    if(!empty($data)) {
        $returndata = array(
            'street' => $data['street_number'] . ' ' .$data['route'],
            'city' => $data['locality political'],
            'state' => $data['administrative_area_level_1 political'],
            'country' => $data['country political'],
            'postcode' => $data['postal_code']
        );
        // set response code - 200 OK
        http_response_code(200);
        // return message
        echo json_encode($returndata);
    }
    else {
        // set response code - 404 Not found
        http_response_code(404);
        // return message
        echo json_encode(
            array("message" => "Address not found")
        );
    }
}


?>


