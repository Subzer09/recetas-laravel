<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Jose',
            'email' => 'jose@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://jose.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $user->perfil()->create();


        $user2 = User::create([
            'name' => 'Jimmy',
            'email' => 'jimmy@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://jimmy.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $user2->perfil()->create();

//        DB::table('users')->insert([
//            'name' => 'Jose',
//            'email' => 'jose@correo.com',
//            'password' => Hash::make('12345678'),
//            'url' => 'http://jose.com',
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s')
//        ]);



    }
}
