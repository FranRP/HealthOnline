<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Profession;
use App\City;
use App\Question;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();
        DB::table('assigned_roles')->truncate();

        $user = User::create([
        	'name' => 'admin',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('123123')
        ]);

        $user2 = User::create([
        	'name' => 'frankiwini',
        	'email' => 'frankiwini@gmail.com',
        	'password' => bcrypt('123123')
        ]);

        $user3 = User::create([
            'name' => 'Vicente de la Varga',
            'email' => 'vicente@gmail.com',
            'password' => bcrypt('123123'),
            'profession_id' => 1
        ]);

        $user4 = User::create([
            'name' => 'Camde',
            'email' => 'camde@gmail.com',
            'password' => bcrypt('123123'),
            'profession_id' => 2,
            'city_id' => 2
        ]);

        $role = Role::create([
        	'name' => 'admin',
        	'display_name' => 'Administrador',
        	'description' => 'Administrador de la consulta médica'
        ]);

        $role2 = Role::create([
        	'name' => 'usuario',
        	'display_name' => 'Usuario',
        	'description' => 'Usuario de la consulta médica'
        ]);

        $role3 = Role::create([
            'name' => 'profesional',
            'display_name' => 'Profesional',
            'description' => 'Profesional de la consulta médica'
        ]);

        $role4 = Role::create([
            'name' => 'clinica',
            'display_name' => 'Clinica',
            'description' => 'Clinica de la consulta médica'
        ]);

        $profession = Profession::create([
            'name' => 'traumatólogo',
            'display_name' => 'Traumatólogo',
            'description' => 'Especialista en lesiones del aparato locomotor'
        ]);

        $profession2 = Profession::create([
            'name' => 'fisioterapeuta',
            'display_name' => 'Fisioterapeuta',
            'description' => 'Especialista en el diagnóstico, prevención y tratamiento de múltiples dolencias patológicas haciéndo uso de técnicas terapéuticas'
        ]);

        $city = City::create([
            'name' => 'Granada',
            'comunidad' => 'Andalucía'
        ]);

        $city2 = City::create([
            'name' => 'Málaga',
            'comunidad' => 'Andalucía'
        ]);

        $city3 = City::create([
            'name' => 'Barcelona',
            'comunidad' => 'Cataluña'
        ]);

        $question = Question::create([
            'title' => '¿Tengo una tendinitis?',
            'body' => 'Hace tiempo que siento molestias en el brazo, y quisiera resolver esta duda',
            'user_id' => 2
        ]);

        $user->roles()->save($role);
        $user2->roles()->save($role2);
        $user3->roles()->save($role3);
        $user4->roles()->save($role4);
    }
}
