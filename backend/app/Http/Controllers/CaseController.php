<?php

namespace App\Http\Controllers;

class CaseController extends Controller
{

    public function index()
    {
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

        $jsonresult = csvToJson("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv");
        // return json_encode($jsonresult, JSON_PRETTY_PRINT);
        // return $jsonresult;

        $response = response($jsonresult, 200)->header('Content-Type', 'application/json');
        return $response;
    }

    public function statesall()
    {
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

        $jsonresult = csvToJson("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_state.csv");

        $response = response($jsonresult, 200)->header('Content-Type', 'application/json');
        return $response;
    }

    public function filterdate($date)
    {
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
            return $json;
        }

        $jsonresult = csvToJson("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_state.csv");

        $collect = collect($jsonresult);

        $filter = $collect->where('date', $date);
        return $filter;
    }
}
