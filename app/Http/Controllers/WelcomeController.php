<?php

namespace App\Http\Controllers;

use App\Models\FichierModel;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $fichiers = FichierModel::all(); 
        return view("welcome", compact('fichiers'));
    }
}
