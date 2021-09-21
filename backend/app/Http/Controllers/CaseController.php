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
            return json_decode(json_encode($json));
        }

        $jsonresult = csvToJson("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_state.csv");

        $collect = collect($jsonresult);

        $filter = array_values($collect->where('date', $date)->toArray());
        $response = response(json_encode($filter, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
        return $response;
    }

    public function death()
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

        $jsonresult = csvToJson("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/deaths_malaysia.csv");
        // return json_encode($jsonresult, JSON_PRETTY_PRINT);
        // return $jsonresult;

        $response = response($jsonresult, 200)->header('Content-Type', 'application/json');
        return $response;
    }

    public function deathstate($date)
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
            return json_decode(json_encode($json));
        }

        $jsonresult = csvToJson("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/deaths_state.csv");

        $collect = collect($jsonresult);

        $filter = array_values($collect->where('date', $date)->toArray());
        $response = response(json_encode($filter, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
        return $response;
    }

    public function newsfeed()
    {
        $url = "https://www.thestar.com.my/rss/News";
        $fileContents = file_get_contents($url);
        $fileContents = str_replace(array("\n", "\r", "\t"), "", $fileContents);
        $file1 = trim(str_replace("<img src=\"", "", $fileContents));
        $file2 = trim(str_replace(".jpg\" />", ".jpg", $file1));
        $file3 = trim(str_replace(".jpeg\" />", ".jpeg", $file2));
        $file4 = trim(str_replace("&#039;", "'", $file3));
        $file5 = trim(str_replace(".JPG\" />", ".JPG", $file4));
        $file6 = trim(str_replace('<div style="float: none; clear: both; width: 100%; position: relative; padding-bottom: 56.25%; padding-top: 25px; height: 0;"><iframe src="" frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe></div>', "", $file5));
        $json = simplexml_load_string($file6, "SimpleXMLElement", LIBXML_NOCDATA);
        $response = response(json_encode($json, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
        return $response;
        // print_r($json);
    }
}
