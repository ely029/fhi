<?php

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

class CreateFirstUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $email = config('firewall.notifications.mail.to')[0];
        $password = App::isLocal() ? 'password' : Str::random(8);

        app('command.migrate')->getOutput()->writeln('<info>Password:</info> See laravel.log');

        Log::warning("Security vulnerability! Update the account with the password, then delete this file!", [$email => $password]);

        $now = Carbon::now();
        DB::table('users')->insert([
            [
                'name' => 'ThinkBIT Support',
                'first_name' => 'ThinkBIT',
                'last_name' => 'Support',
                'username' => 'thinkbitsupport',
                'email' => $email,
                'password' => bcrypt($password),
                'role_id' => Role::first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'first_name' => 'Super',
                'last_name' => 'admin',
                'username' => 'superadmin',
                'email' => 'superadmin@etbmac.gov.ph',
                'password' => bcrypt($password),
                'role_id' => Role::first()->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

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
        //
    }
}
