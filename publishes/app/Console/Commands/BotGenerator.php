<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class BotGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:bot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Buat Bot Telegram';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Nama BOT');
        $password = $this->ask('Password BOT');
        $token = $this->ask('Token BOT');

        $stud_name = Str::studly($name);
        $snake_name = Str::snake($name);

        $stub = file_get_contents(resource_path('stubs/BotController.stub'));

        $controller = str_replace(
            ['{{stud_name}}', '{{snake_name}}', '{{bot_token}}', '{{bot_password}}'],
            [$stud_name, $snake_name, $token, $password],
            $stub
        );

        if (!file_exists(app_path('Http/Controllers/Apps'))) {
            mkdir(app_path('Http/Controllers/Apps'), 0777, true);
        }

        file_put_contents(app_path('Http/Controllers/Apps/Bot' . $stud_name . 'Controller.php'), $controller);

        $api_routes = file_get_contents(base_path('routes/api.php'));
        $new_route = "Route::get('bot/" . $snake_name . "', 'Apps\Bot" . $stud_name . "Controller@index');" . "\r\n";
        $new_route .= "Route::post('bot/" . $snake_name . "/receiver', 'Apps\Bot" . $stud_name . "Controller@receiver')->name('bot.receiver." . $snake_name . "');";
        $new_routes = $api_routes . "\r\n" . $new_route;

        file_put_contents(base_path('routes/api.php'), $new_routes);
    }
}
