<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    public function run()
    {
        $clients = [
            [
                'id'             => 2,
                'name'           => 'Ghanem',
                'email'          => 'client@client.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
        ];

        User::insert($clients);
    }
}
