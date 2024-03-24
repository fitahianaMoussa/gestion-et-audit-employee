<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditEmploye;

class AuditController extends Controller
{
    public function index()
    {
        // Récupérer tous les audits des employés
        $audits = AuditEmploye::all();

        // Calculer le nombre d'insertions, de modifications et de suppressions
        $insertions = $audits->where('action', 'ajout')->count();
        $modifications = $audits->where('action', 'modification')->count();
        $suppressions = $audits->where('action', 'suppression')->count();

        // Retourner la vue avec les données des audits
        return view('audit.index', compact('audits', 'insertions', 'modifications', 'suppressions'));
    }
}

