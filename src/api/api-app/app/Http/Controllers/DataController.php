<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    //get data
    public function index()
    {
        $post = array(array(
            "name" => "Sam",
            "mail" => "sam12@gmail.com"),
            array(
                "name" => "wolf",
                "mail" => "wolf32@gmail.com"),
            array(
                    "name" => "Luc",
                    "mail" => "luc12@gmail.com")
        );  // déclaration d'un tableau de post
            echo json_encode($post);
        
    }
}
