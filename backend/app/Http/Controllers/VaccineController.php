<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaccineController extends Controller
{
    public function showtotal()
    {
        function csvToJson($fname)
        {
            if (!($fp = fopen($fname, 'r'))) {
                die("Can't open file...");
            }
            $key = fgetcsv($fp, "1024", ",");
            $json = array();
            while ($row = fgetcsv($fp, "1024", ",")) {
                $json[] = array_combine($key, $row);
            }
            fclose($fp);
            return json_encode($json, JSON_PRETTY_PRINT);
        }

        $jsonresult = csvToJson("https://raw.githubusercontent.com/CITF-Malaysia/citf-public/main/vaccination/vax_malaysia.csv");

        $response = response($jsonresult, 200)->header('Content-Type', 'application/json');
        return $response;
    }

    public function showState($date)
    {
        function csvToJson($fname)
        {
            if (!($fp = fopen($fname, 'r'))) {
                die("Can't open file...");
            }
            $key = fgetcsv($fp, "1024", ",");
            $json = array();
            while ($row = fgetcsv($fp, "1024", ",")) {
                $json[] = array_combine($key, $row);
            }
            fclose($fp);
            return json_decode(json_encode($json));
        }

        $jsonresult = csvToJson("https://raw.githubusercontent.com/CITF-Malaysia/citf-public/main/vaccination/vax_state.csv");

        $collect = collect($jsonresult);

        $filter = array_values($collect->where('date', $date)->toArray());
        $response = response(json_encode($filter, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
        return $response;
    }

    public function showbyState($state)
    {
        function csvToJson($fname)
        {
            if (!($fp = fopen($fname, 'r'))) {
                die("Can't open file...");
            }
            $key = fgetcsv($fp, "1024", ",");
            $json = array();
            while ($row = fgetcsv($fp, "1024", ",")) {
                $json[] = array_combine($key, $row);
            }
            fclose($fp);
            return json_decode(json_encode($json));
        }

        $jsonresult = csvToJson("https://raw.githubusercontent.com/CITF-Malaysia/citf-public/main/vaccination/vax_state.csv");

        $collect = collect($jsonresult);

        $filter = array_values($collect->where('state', $state)->toArray());
        $response = response(json_encode($filter, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
        return $response;
    }
}
