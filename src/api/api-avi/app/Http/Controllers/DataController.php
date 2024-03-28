<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
     //get data
     public function index()
     {
         $post = array(array(
             "name" => "Romuald",
             "mail" => "romuald12@gmail.com"),
             array(
                 "name" => "ivan",
                 "mail" => "ivanna1@gmail.com"),
             array(
                     "name" => "Luc",
                     "mail" => "luc12@gmail.com")
         );  // déclaration d'un tableau de post
             echo json_encode($post);
         
     }
}
