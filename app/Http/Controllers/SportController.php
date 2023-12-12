<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\String\s;

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
        $reset = $request->query('reset', null);
        if(isset($reset)){
            Cookie::expire('annee');
            Cookie::expire('nom');
            Cookie::expire('debut');
            return redirect()->route('sports.index')
                ->with('type', 'success')
                ->with('text', 'Vos cookies ont été réinitialisés');
        }

        $debut = $request->query('debut');
        $annee = $request->query('annee');
        $cookieAnnee = $request->cookie('annee');
        $cookieNom = $request->cookie('nom');
        $cookieDebut = $request->cookie('debut');
        $nom = $request->input('nom');

        $sports = Sport::all();
        if (isset($debut)) {
            Cookie::queue('debut', $debut, 10);
        }
        if ($debut === 'none') {
            // DO NOTHING
        } elseif ($debut === 'asc') {
            $sports = $sports->sortBy('nom');
        } elseif ($debut === 'desc') {
            $sports = $sports->sortByDesc('nom');
        } elseif (isset($cookieDebut) && $cookieDebut === 'asc') {
            $sports = $sports->sortBy('nom');
        } elseif (isset($cookieDebut) && $cookieDebut === 'desc') {
            $sports = $sports->sortByDesc('nom');
        }

        if (isset($nom)) {
            Cookie::queue('nom', $nom, 10);
            $sportsNom = Sport::where('nom','like','%'.$nom.'%')->get();
            $sportsTmp = [];
            foreach ($sports as $sport) {
                foreach ($sportsNom as $sportNom) {
                    if ($sport == $sportNom) {
                        $sportsTmp[] = $sport;
                        break;
                    }
                }
            }
            $sports = $sportsTmp;
        } elseif (isset($cookieNom)) {
            Cookie::queue('nom', "", 10);
            $sportsNom = Sport::where('nom', 'like', '%' . $cookieNom . '%')->get();
            $sportsTmp = [];
            foreach ($sports as $sport) {
                foreach ($sportsNom as $sportNom) {
                    if ($sport == $sportNom) {
                        $sportsTmp[] = $sport;
                        break;
                    }
                }
            }
            $sports = $sportsTmp;
        }

        if (isset($annee)) {
            Cookie::queue('annee', $annee, 10);
            if ($annee !== 'All') {
                $sportsAnnee = Sport::where('annee_ajout', '=', $annee)->get();
                $sportsTmp = [];
                foreach ($sports as $sport) {
                    foreach ($sportsAnnee as $sportAnnee) {
                        if ($sport == $sportAnnee) {
                            $sportsTmp[] = $sport;
                            break;
                        }
                    }
                }
                $sports = $sportsTmp;
            }
        } elseif ($annee !== 'All' && isset($cookieAnnee) && $cookieAnnee !== 'All') {
            $sportsAnnee = Sport::where('annee_ajout', '=', $cookieAnnee)->get();
            $sportsTmp = [];
            foreach ($sports as $sport) {
                foreach ($sportsAnnee as $sportAnnee) {
                    if ($sport == $sportAnnee) {
                        $sportsTmp[] = $sport;
                        break;
                    }
                }
            }
            $sports = $sportsTmp;
        }

        $annees_ajout = Sport::distinct('annee_ajout')->pluck('annee_ajout');
        return view('sports.index', [
            'sports' => $sports,
            'annee' => $annee,
            'debut' => $debut,
            'nom' => $nom,
            'annees_ajout' => $annees_ajout,
            'cookieAnnee' => $cookieAnnee,
            'cookieNom' => $cookieNom,
            'cookieDebut' => $cookieDebut
        ]);

    }

    public function create()
    {
        return view('sports.create');
    }

    public function store(Request $request) {
        /*$this->validate(
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
        );*/

        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'description' => 'required',
            'annee_ajout' => 'required',
            'nb_disciplines' => 'required',
            'nb_epreuves' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('sports.create')
                ->withErrors($validator)
                ->withInput()
                ->with('type', 'error')
                ->with('msg', 'Formulaire incomplet');
        }

        $sport = new Sport();

        $sport->nom = $request->nom;
        $sport->description = $request->description;
        $sport->annee_ajout = $request->annee_ajout;
        $sport->nb_disciplines = $request->nb_disciplines;
        $sport->nb_epreuves = $request->nb_epreuves;
        $sport->date_debut = $request->date_debut;
        $sport->date_fin = $request->date_fin;

        $sport->save();

        return redirect()->route('sports.show', $sport)
            ->with('type', 'primary')
            ->with('msg', 'Sport ajoutée avec succès');
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

        /*$this->validate(
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
        );*/

        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'description' => 'required',
            'annee_ajout' => 'required',
            'nb_disciplines' => 'required',
            'nb_epreuves' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('sports.edit', $sport)
                ->withErrors($validator)
                ->withInput()
                ->with('type', 'error')
                ->with('msg', 'Formulaire incomplet');
        }

        $sport->nom = $request->nom;
        $sport->description = $request->description;
        $sport->annee_ajout = $request->annee_ajout;
        $sport->nb_disciplines = $request->nb_disciplines;
        $sport->nb_epreuves = $request->nb_epreuves;
        $sport->date_debut = $request->date_debut;
        $sport->date_fin = $request->date_fin;
        $sport->save();

        return redirect()->route('sports.show',['sport' => $sport])
            ->with('type', 'primary')
            ->with('msg', 'Sport modifié avec succès');
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
