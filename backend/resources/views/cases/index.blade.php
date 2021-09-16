<?php
header("Access-Control-Allow-Origin: *");
header('Content-type: text/javascript');

function csvToJson($fname)
{
    // open csv file
    if (!($fp = fopen($fname, 'r'))) {
        die("Can't open file...");
    }

    //read csv headers
    $key = fgetcsv($fp, "1024", ",");

    // parse csv rows into array
    $json = array();
    while ($row = fgetcsv($fp, "1024", ",")) {
        $json[] = array_combine($key, $row);
    }

    // release file handle
    fclose($fp);

    // encode array to json
    return json_encode($json, JSON_PRETTY_PRINT);
}


print_r(csvToJson("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv"));
