<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SportController extends Controller
{
    public function accueil() {
        return view('accueil');
    }

    public function apropos() {
        return view('apropos');
    }

    public function contact() {
        return view('contact');
    }

    public function index(Request $request) {
        $annee = $request->input('annee', null);
        $cookieNb = $request->cookie('nb', null);
        $sport = $request->input('sport',null);
        if (isset($sport)) {
            $sports = Sport::where('nom','like','%'.$sport.'%')->get();
        } elseif (!isset($annee)) {
            if (!isset($cookieNb)) {
                $sports = Sport::all();
                $annee = 'All';
                Cookie::expire('annee');
            } else {
                $sports = Sport::where('annee_ajout', $cookieNb)->get();
                $annee = $cookieNb;
                Cookie::queue('annee', $annee, 10);
            }
        } else {
            if ($annee == 'All') {
                $sports = Sport::all();
                Cookie::expire('annee');
            } else {
                $sports = Sport::where('annee_ajout', $annee)->get();
                Cookie::queue('annee', $annee, 10);
            }
        }
        $annees_ajout = Sport::distinct('annee_ajout')->pluck('annee_ajout');
        return view('sports.index', ['sports' => $sports, 'annee' => $annee, 'annees_ajout' => $annees_ajout, 'cookiesNb' => $cookieNb]);
    }

    public function create()
    {
        return view('sports.create');
    }

    public function store(Request $request) {
        $this->validate(
            $request,
            [
                'nom' => 'required',
                'description' => 'required',
                'annee_ajout' => 'required',
                'nb_disciplines' => 'required',
                'nb_epreuves' => 'required',
                'date_debut' => 'required',
                'date_fin' => 'required',
            ]
        );

        $sport = new Sport();

        $sport->nom = $request->nom;
        $sport->description = $request->description;
        $sport->annee_ajout = $request->annee_ajout;
        $sport->nb_disciplines = $request->nb_disciplines;
        $sport->nb_epreuves = $request->nb_epreuves;
        $sport->date_debut = $request->date_debut;
        $sport->date_fin = $request->date_fin;

        $sport->save();

        return redirect()->route('sports.show', ['sport' => $sport]);
    }

    public function show(Request $request, $id) {
        $action = $request->query('action', 'show');
        $sport = Sport::find($id);

        return view('sports.show', ['sport' => $sport, 'action' => $action]);
    }

    public function edit($sport)
    {
        $sport = Sport::find($sport);
        return view('sports.edit', ['sport' => $sport]);
    }

    public function update(Request $request, $id) {
        $sport = Sport::find($id);

        $this->validate(
            $request,
            [
                'nom' => 'required',
                'description' => 'required',
                'annee_ajout' => 'required',
                'nb_disciplines' => 'required',
                'nb_epreuves' => 'required',
                'date_debut' => 'required',
                'date_fin' => 'required',
            ]
        );
        $sport->nom = $request->nom;
        $sport->description = $request->description;
        $sport->annee_ajout = $request->annee_ajout;
        $sport->nb_disciplines = $request->nb_disciplines;
        $sport->nb_epreuves = $request->nb_epreuves;
        $sport->date_debut = $request->date_debut;
        $sport->date_fin = $request->date_fin;
        $sport->save();

        return redirect()->route('sports.show',['sport' => $sport]);
    }

    public function destroy(Request $request, $id) {
        $sport = Sport::find($id);
        if ($request->delete == 'valide') {
            $sport->delete();
            return redirect()->route('sports.index');
        }
        return redirect()->route('sports.show', $sport);
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
