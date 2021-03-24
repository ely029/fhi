<?php

use App\Models\Role;
use App\Models\RoleAccess;
use App\Models\RoleRoute;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_deletable')->default(true);
            $table->timestamps();
        });

        Schema::create('role_accesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->string('route')->index();
            $table->timestamps();
        });

        // Seed
        $role = Role::forceCreate([
            'name' => 'Admin',
            'is_deletable' => false,
        ]);

        $role->accesses()->saveMany(RoleRoute::getActionName()->map(function ($route) {
            return new RoleAccess(['route' => $route]);
        }));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_accesses');
        Schema::dropIfExists('roles');
    }
}
