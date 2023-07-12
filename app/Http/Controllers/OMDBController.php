<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class OMDBController extends Controller
{
    public function OMDB()
    { 
       //header('Access-Control-Allow-Origin: *'); //sets the header to be origin: which prevents CORS errors

       $qs = http_build_query(request()->query()); //this contructs the query string from the query parameters of the current request
       //http_build_query - is a php function that takes an associative array of query parameters and constructs a URL-encoded query string from it
        //http_build_query(request()->query()) -- this takes the query params of the current request and will convert it to a URL encoded query string

       $url = "http://www.omdbapi.com/?apikey=" . env('API_KEY') . '&' . $qs; //this forms the complete url for the request, you add the api key to the 
       //OMDB request and then append the query string which will have the other params of the request.
       
       $response = Http::get($url); //get request to the url we constructed this will fetch data from the api
        
       if($response->status() === 200){ //handles the api response, if it is good will send the json data if not then will throw 500 error.
        return response()->json($response->json(), 200); //This creates a JSON response with the data recieved from the api, the response will include the JSON data from
        //$response object, if 200 then successful.
       }
       
       return response()->json(['error' => 'Error occurred'], 500);
    }
}
