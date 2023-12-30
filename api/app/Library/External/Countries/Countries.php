<?php
namespace App\Library\External\Countries;

use App\Library\Http\HttpManager;

class Countries
{
    public function countryList()
    {
        $http = new HttpManager();
        $http->setBaseUrl("https://restcountries.com/v3.1/");

        $fields=["name","cca2"];
        $countryList = $http->get("independent",["fields"=>implode(",",$fields),"status"=>true]);
        return $countryList->result;
    }
}
