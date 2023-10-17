<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;

class SportController extends Controller
{
    public function index(Request $request)
    {
        $taches = Sport::all();
        $nom = $request->get("nom", '');
        $sports = [];
        if (empty($nom)) {
            $taches = Sport::all();
        } else {
            $taches = Sport::where('nom', '=', $nom)->get();
        }
        return view('sports.index', ['sports' => $sports]);
    }
}
