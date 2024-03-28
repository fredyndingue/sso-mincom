<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    //get data
    public function index()
    {
    $post = array(array(
        "name" => "123",
        "mail" => "ab12@gmail.com"),
        array(
            "name" => "fake",
            "mail" => "fake23@gmail.com"),
        array(
                "name" => "Lisa13",
                "mail" => "lisa03@gmail.com")
    );  // déclaration d'un tableau de post
        echo json_encode($post);//convertir les valeurs du tableau en fichier json
    }
}
