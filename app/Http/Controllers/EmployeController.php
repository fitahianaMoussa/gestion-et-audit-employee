<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\AuditEmploye;
use Illuminate\Support\Facades\DB;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::paginate(10);
        return view('employes.index', compact('employes'));
    }

    public function create()
    {
        return view('employes.create');
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        
        // Création d'un nouvel employé
        $employe = new Employe();
        $employe->matricule = $request->matricule;
        $employe->nom = $request->nom;
        $employe->salaire = $request->salaire;
        $employe->save();
        
        // Enregistrement de l'audit
        $this->audit('ajout', $employe);

        return redirect()->route('employes.index')->with('success', 'Employé ajouté avec succès');
    }

    public function edit($id)
    {
        $employe = Employe::findOrFail($id);
        return view('employes.edit', compact('employe'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        
        $employe = Employe::findOrFail($id);
        $employe->matricule = $request->matricule;
        $employe->nom = $request->nom;
        $employe->salaire = $request->salaire;
        $employe->save();

        // Enregistrement de l'audit
        $this->audit('modification', $employe);

        return redirect()->route('employes.index')->with('success', 'Employé mis à jour avec succès');
    }

    public function destroy($id)
    {
        $employe = Employe::findOrFail($id);
        $employe->delete();

        // Enregistrement de l'audit
        $this->audit('suppression', $employe);

        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès');
    }

    private function audit($action, Employe $employe)
    {
        $audit = new AuditEmploye();
        $audit->action = $action;
        $audit->date_mise_a_jour = now();
        $audit->employe_id = $employe->id;
        $audit->nom = $employe->nom;
        $audit->salaire_ancien = $employe->getOriginal('salaire');
        $audit->salaire_nouv = $employe->salaire;
        $audit->user = auth()->user()->name; // Vous devez ajuster cette ligne en fonction de votre système d'authentification
        $audit->save();
    }
}

