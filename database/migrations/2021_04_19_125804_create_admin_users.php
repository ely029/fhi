<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         $now = Carbon::now();
        if (! app()->environment('production'))
        {
            DB::table('users')->insert([
                [
                    'name' => 'Test Health Care Worker',
                    'email' => 'testhcw@etbmac.gov.ph',
                    'password' => bcrypt('password'),
                    'role_id' => 3,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'Test Regional Secretariat',
                    'email' => 'testrs@etbmac.gov.ph',
                    'password' => bcrypt('password'),
                    'role_id' => 4,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'Test Regional TB-Mac',
                    'email' => 'testrtbmac@etbmac.gov.ph',
                    'password' => bcrypt('password'),
                    'role_id' => 5,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'Test Regional TB-Mac Chair',
                    'email' => 'testrtbmacchair@etbmac.gov.ph',
                    'password' => bcrypt('password'),
                    'role_id' => 6,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'Test National TB-Mac',
                    'email' => 'testntbmac@etbmac.gov.ph',
                    'password' => bcrypt('password'),
                    'role_id' => 7,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'Test National TB-Mac Chair',
                    'email' => 'testntbmacchair@etbmac.gov.ph',
                    'password' => bcrypt('password'),
                    'role_id' => 8,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]);
            
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
