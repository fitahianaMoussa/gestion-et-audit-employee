<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAuditEmployeTriggersNew extends Migration
{
    public function up()
    {
        // Supprimer le déclencheur existant s'il existe
        DB::unprepared('DROP TRIGGER IF EXISTS audit_employe_trigger');
        DB::unprepared('DROP TRIGGER IF EXISTS audit_employe_trigger_update');
        DB::unprepared('DROP TRIGGER IF EXISTS audit_employe_trigger_delete');

        // Créer le déclencheur pour l'ajout d'un employé
        DB::unprepared('
            CREATE TRIGGER audit_employe_trigger AFTER INSERT ON employes
            FOR EACH ROW
            BEGIN
                INSERT INTO audit_employe (action, date_mise_a_jour, employe_id, nom, salaire_ancien, salaire_nouv, user, created_at, updated_at)
                VALUES ("ajout", NOW(), NEW.id, NEW.nom, NULL, NEW.salaire, "utilisateur", NOW(), NOW());
            END
        ');

        // Créer le déclencheur pour la modification d'un employé
        DB::unprepared('
            CREATE TRIGGER audit_employe_trigger_update AFTER UPDATE ON employes
            FOR EACH ROW
            BEGIN
                INSERT INTO audit_employe (action, date_mise_a_jour, employe_id, nom, salaire_ancien, salaire_nouv, user, created_at, updated_at)
                VALUES ("modification", NOW(), NEW.id, NEW.nom, OLD.salaire, NEW.salaire, "utilisateur", NOW(), NOW());
            END
        ');

        // Créer le déclencheur pour la suppression d'un employé
        DB::unprepared('
            CREATE TRIGGER audit_employe_trigger_delete AFTER DELETE ON employes
            FOR EACH ROW
            BEGIN
                INSERT INTO audit_employe (action, date_mise_a_jour, employe_id, nom, salaire_ancien, salaire_nouv, user, created_at, updated_at)
                VALUES ("suppression", NOW(), OLD.id, OLD.nom, OLD.salaire, NULL, "utilisateur", NOW(), NOW());
            END
        ');
    }

    public function down()
    {
        // Supprimer les déclencheurs lors du rollback
        DB::unprepared('DROP TRIGGER IF EXISTS audit_employe_trigger');
        DB::unprepared('DROP TRIGGER IF EXISTS audit_employe_trigger_update');
        DB::unprepared('DROP TRIGGER IF EXISTS audit_employe_trigger_delete');
    }
}
