<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    public function newsfeed()
    {
        $url = "https://www.thestar.com.my/rss/News";
        $fileContents = file_get_contents($url);
        $fileContents = str_replace(array("\n", "\r", "\t", "[object Object]"), "", $fileContents);
        $file1 = trim(str_replace("<img src=\"", "", $fileContents));
        $file2 = trim(str_replace(".jpg\" />", ".jpg", $file1));
        $file3 = trim(str_replace(".jpeg\" />", ".jpeg", $file2));
        $file4 = trim(str_replace("&#039;", "'", $file3));
        $file5 = trim(str_replace(".JPG\" />", ".JPG", $file4));
        $file6 = trim(str_replace('<div style="float: none; clear: both; width: 100%; position: relative; padding-bottom: 56.25%; padding-top: 25px; height: 0;"><iframe src="" frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe></div>', "", $file5));
        $file7 = trim(str_replace(".png\" />", ".png", $file6));
        $json = simplexml_load_string($file7, "SimpleXMLElement", LIBXML_NOCDATA);
        $response = response(json_encode($json, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
        return $response;
        // print_r($json);
    }
}
