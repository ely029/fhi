<?php

use App\Models\Role;
use App\Models\RoleAccess;
use App\Models\RoleRoute;
use Carbon\Carbon;
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
            $table->boolean('is_for_admin')->default(true);
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

        // Seed roles
        $role = Role::forceCreate([
            'name' => 'Admin',
            'is_deletable' => false,
        ]);

        DB::table('roles')->insert([
            [
                'name' => 'Health Care Worker',
                'is_deletable' => false,
                'is_for_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Regional Secretariat',
                'is_deletable' => false,
                'is_for_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Regional TB-MAC',
                'is_deletable' => false,
                'is_for_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Regional TB-MAC-Chair',
                'is_deletable' => false,
                'is_for_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'National TB-MAC',
                'is_deletable' => false,
                'is_for_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'National TB-MAC-Chair',
                'is_deletable' => false,
                'is_for_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
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
