<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Modules\User\Entities\User;


class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //get if default user exists
        $defaultuser = User::where('email','sunmoontech@test.com')
            ->first();

        //create default user for postman
        if( !$defaultuser ){
            User::insert([
                'name' => 'sunmoontech',
                'password' => bcrypt('test1234'),
                'email' => 'sunmoontech@test.com',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

    }
}
