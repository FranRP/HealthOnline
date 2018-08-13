<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Profession;
use App\City;
use App\Question;
use App\Inbox;

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
            'profession_id' => 3
        ]);

        $user4 = User::create([
            'name' => 'Camde',
            'email' => 'camde@gmail.com',
            'password' => bcrypt('123123'),
            'profession_id' => 6,
            'city_id' => 2
        ]);

        $user5 = User::create([
            'name' => 'Agaz',
            'email' => 'agaz@gmail.com',
            'password' => bcrypt('123123'),
            'profession_id' => 1,
            'city_id' => 1
        ]);
        $user6 = User::create([
            'name' => 'Luis',
            'email' => 'luis@gmail.com',
            'password' => bcrypt('123123'),
            'profession_id' => 8,
            'city_id' => 4
        ]);
        $user7 = User::create([
            'name' => 'Fisioplacido',
            'email' => 'fisio@gmail.com',
            'password' => bcrypt('123123'),
            'profession_id' => 4,
            'city_id' => 7
        ]);
        $user8 = User::create([
            'name' => 'Carlos',
            'email' => 'carlos@gmail.com',
            'password' => bcrypt('123123'),
            'profession_id' => 2,
            'city_id' => 3
        ]);
        $user9 = User::create([
            'name' => 'Pedro',
            'email' => 'pedro@gmail.com',
            'password' => bcrypt('123123')
        ]);
        $user10 = User::create([
            'name' => 'Antonio',
            'email' => 'antonio@gmail.com',
            'password' => bcrypt('123123')
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
        
        $profession3 = Profession::create([
            'name' => 'odontólogo',
            'display_name' => 'Odontólogo',
            'description' => 'Especialista de la salud que se encarga del diagnóstico, tratamiento y prevención de las enfermedades del aparato estomatognático'
        ]);
        
        $profession4 = Profession::create([
            'name' => 'ginecólogo',
            'display_name' => 'Ginecólogo',
            'description' => 'Especialista médica y quirúrgica que trata las enfermedades del sistema reproductor femenino'
        ]);
        
        $profession5 = Profession::create([
            'name' => 'oftalmólogo',
            'display_name' => 'Oftalmólogo',
            'description' => 'Especialista médico que estudia las enfermedades de ojo y su tratamiento, incluyendo el globo ocular, su musculatura, el sistema lagrimal y los párpados'
        ]);
        
        $profession6 = Profession::create([
            'name' => 'dermatólogo',
            'display_name' => 'Dermatólogo',
            'description' => 'Especialista médica encargada del estudio de la estructura y función de la piel'
        ]);
        
        $profession7 = Profession::create([
            'name' => 'angiologo',
            'display_name' => 'Angiologo',
            'description' => 'Especialista médico que se encarga del estudio de los vasos del sistema circulatorio (venas y arterias) y del sistema linfático'
        ]);
        
        $profession8 = Profession::create([
            'name' => 'urólogo',
            'display_name' => 'Urólogo',
            'description' => 'Especialista médico-quirúrgico que se ocupa del estudio, diagnóstico y tratamiento de las patologías que afectan al aparato urinario, glándulas suprarrenales y retroperitoneo de los hombres y el aparato reproductor masculino'
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
        
        $city4 = City::create([
            'name' => 'Sevilla',
            'comunidad' => 'Andalucía'
        ]);
        
        $city5 = City::create([
            'name' => 'Cádiz',
            'comunidad' => 'Andalucía'
        ]);
        
        $city6 = City::create([
            'name' => 'Madrid',
            'comunidad' => 'Madrid'
        ]);
        
        $city7 = City::create([
            'name' => 'A Coruña',
            'comunidad' => 'Galicia'
        ]);
        
        $city8 = City::create([
            'name' => 'Lugo',
            'comunidad' => 'Galicia'
        ]);
        
        $city9 = City::create([
            'name' => 'Ourense',
            'comunidad' => 'Galicia'
        ]);
        
        $city10 = City::create([
            'name' => 'Vigo',
            'comunidad' => 'Galicia'
        ]);
        
        $city11 = City::create([
            'name' => 'Álava',
            'comunidad' => 'País Vasco'
        ]);
        
        $city12 = City::create([
            'name' => 'Vizcaya',
            'comunidad' => 'País Vasco'
        ]);
        
        $city13 = City::create([
            'name' => 'Guipúzcoa',
            'comunidad' => 'País Vasco'
        ]);
        
        $city14 = City::create([
            'name' => 'Valencia',
            'comunidad' => 'Comunidad Valenciana'
        ]);
        
        $city15 = City::create([
            'name' => 'Lérida',
            'comunidad' => 'Cataluña'
        ]);

        $question = Question::create([
            'title' => '¿Tengo una tendinitis?',
            'body' => 'Hace tiempo que siento molestias en el brazo, y quisiera saber más al respecto. He ido a diferentes profesionales, sin embargo, todos me han recomendado simple reposo y evitar toda actividad física en la que se vea implicado el brazo. Pese a seguir sus recomendaciones, el dolor persiste y es cada vez más intenso, ¿alguna idea?',
            'user_id' => 2
        ]);

        $correo = Inbox::create([
            'user_id' => 4,
            'asunto' => 'Probando el asunto de una pregunta',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In semper lectus sit amet turpis malesuada, nec convallis eros molestie. Duis fringilla felis ultrices consequat feugiat. Mauris ultricies porttitor feugiat. Sed sollicitudin libero in nisi consequat, eget congue augue malesuada. Pellentesque cursus enim elit, ac lobortis nulla sodales non. Fusce vel turpis id nisi lobortis dignissim. Praesent eleifend nisi sit amet dui luctus ullamcorper. Vestibulum dictum nisi facilisis, aliquet justo lacinia, aliquet mi. Praesent commodo, risus non elementum congue, elit magna accumsan risus, id efficitur tortor leo ut mi. Duis cursus sit amet metus et cursus. Maecenas rhoncus rhoncus ligula sit amet dapibus. Ut mattis porttitor diam, quis molestie est vestibulum quis. Duis at tortor sit amet est cursus accumsan. Fusce imperdiet nulla sit amet erat posuere efficitur. Vestibulum tristique dolor vel felis viverra, non pretium leo iaculis. Etiam fermentum a turpis at sodales. Nam lacinia varius velit nec pulvinar. Aenean.',
            'destinatario' => 'frankiwini',
            'destId' => 2
        ]);

        $correo2 = Inbox::create([
            'user_id' => 3,
            'asunto' => 'Probando el asunto de una pregunta',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In semper lectus sit amet turpis malesuada, nec convallis eros molestie. Duis fringilla felis ultrices consequat feugiat. Mauris ultricies porttitor feugiat. Sed sollicitudin libero in nisi consequat, eget congue augue malesuada. Pellentesque cursus enim elit, ac lobortis nulla sodales non. Fusce vel turpis id nisi lobortis dignissim. Praesent eleifend nisi sit amet dui luctus ullamcorper. Vestibulum dictum nisi facilisis, aliquet justo lacinia, aliquet mi. Praesent commodo, risus non elementum congue, elit magna accumsan risus, id efficitur tortor leo ut mi. Duis cursus sit amet metus et cursus. Maecenas rhoncus rhoncus ligula sit amet dapibus. Ut mattis porttitor diam, quis molestie est vestibulum quis. Duis at tortor sit amet est cursus accumsan. Fusce imperdiet nulla sit amet erat posuere efficitur. Vestibulum tristique dolor vel felis viverra, non pretium leo iaculis. Etiam fermentum a turpis at sodales. Nam lacinia varius velit nec pulvinar. Aenean.',
            'destinatario' => 'frankiwini',
            'destId' => 2
        ]);

        $user->roles()->save($role);
        $user2->roles()->save($role2);
        $user3->roles()->save($role3);
        $user4->roles()->save($role4);
        $user5->roles()->save($role4);
        $user6->roles()->save($role4);
        $user7->roles()->save($role4);
        $user8->roles()->save($role4);
        $user9->roles()->save($role2);
        $user10->roles()->save($role2);
        

    }
}
