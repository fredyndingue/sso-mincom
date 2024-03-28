<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    //get data
    public function index()
    {
        $post = array(array(
            "name" => "Andy",
            "mail" => "andy@gmail.com"),
            array(
                "name" => "Alex",
                "mail" => "alex@gmail.com"),
            array(
                    "name" => "Lise",
                    "mail" => "lise@gmail.com")
        );  // déclaration d'un tableau de post
            echo json_encode($post);
        
    }
}

?>