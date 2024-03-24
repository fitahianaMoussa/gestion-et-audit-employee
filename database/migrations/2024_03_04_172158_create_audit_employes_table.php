<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditEmployesTable extends Migration
{
    public function up()
    {
        Schema::create('audit_employes', function (Blueprint $table) {
            $table->id();
            $table->string('action'); // Action effectuée (ajout, modification, suppression)
            $table->dateTime('date_mise_a_jour');
            $table->unsignedBigInteger('employe_id'); // Référence à l'employé concerné
            $table->string('nom');
            $table->decimal('salaire_ancien', 10, 2)->nullable();
            $table->decimal('salaire_nouv', 10, 2)->nullable();
            $table->string('user'); // Utilisateur ayant effectué l'action
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_employes');
    }
}
