<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SportController extends Controller
{
    public function index(Request $request) {
        $nb = $request->input('nb', null);
        $cookieNb = $request->cookie('nb', null);

        if (!isset($nb)) {
            if (!isset($cookieNb)) {
                $sports = Sport::all();
                $nb = 'All';
                Cookie::expire('nb');
            } else {
                $sports = Sport::where('nb_epreuves', $cookieNb)->get();
                $nb = $cookieNb;
                Cookie::queue('nb', $nb, 10);            }
        } else {
            if ($nb == 'All') {
                $sports = Sport::all();
                Cookie::expire('nb');
            } else {
                $sports = Sport::where('nb_epreuves', $nb)->get();
                Cookie::queue('nb', $nb, 10);
            }
        }
        $nb_epreuves = Sport::distinct('nb_epreuves')->pluck('nb_epreuves');
        return view('sports.index', ['sports' => $sports, 'nb' => $nb, 'nb_epreuves' => $nb_epreuves, 'cookiesNb' => $cookieNb]);
    }

    public function upload(Request $request, $id) {
        $sport = Sport::findOrFail($id);
        if ($request->hasFile('document') && $request->file('document')->isValid()) {
            $file = $request->file('document');
        } else {
            $msg = "Aucun fichier téléchargé";
            return redirect()->route('sports.show', [$sport->id])
                ->with('type', 'primary')
                ->with('msg', 'Smartphone non modifié ('. $msg . ')');
        }
        $nom = 'image';
        $now = time();
        $nom = sprintf("%s_%d.%s", $nom, $now, $file->extension());

        $file->storeAs('images', $nom);
        if (isset($sport->url_media)) {
            Log::info("Image supprimée : ". $sport->url_media);
            Storage::delete($sport->url_media);
        }
        $sport->url_media = 'images/'.$nom;
        $sport->save();
        //$file->store('docs');
        return redirect()->route('sports.show', [$sport->id])
            ->with('type', 'primary')
            ->with('msg', 'Tâche modifiée avec succès');
    }
}
