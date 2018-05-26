<?php

use App\Message;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::truncate();

        for ($x=1; $x < 51; $x++) {
        	Message::create([
        		'name' => "Usuario {$x}",
        		'email' => "usuario{$x}@gmail.com",
        		'mensaje' => "Este es el mensaje del usuario número {$x}",
        		'created_at' => Carbon::now()->subDays(100)->addDays($x)
        	]);
        }
        
    }
}
