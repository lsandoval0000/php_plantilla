<?php
namespace App\Utiles;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class Instalador{
    private static $minPHPVersion = "7.1.3";

    public static function verificarRequerimientos()
    {
        $requerimientos = array();

        if (phpversion() < self::$minPHPVersion) {
            $requerimientos[] = 'Versión mínima de PHP 7.1.3 requerida.';
        }
		
        if (ini_get('safe_mode')) {
            $requerimientos[] = 'Modo seguro necesita ser deshabilitado!';
        }

        if (ini_get('register_globals')) {
            $requerimientos[] = 'La característica Register Globals necsita estar deshabilitada!';
        }

        if (ini_get('magic_quotes_gpc')) {
            $requerimientos[] = 'La característica Magic Quotes necesita estar deshabilitada!';
        }

        if (!ini_get('file_uploads')) {
            $requerimientos[] = 'La característica File Uploads necesita estar habilitada!';
        }

        if (!class_exists('PDO')) {
            $requerimientos[] = 'MySQL PDO necsita estar habilitada!';
        }

        if (!extension_loaded('openssl')) {
            $requerimientos[] = 'La extensión OpenSSL necesita estar cargada!';
        }

        if (!extension_loaded('tokenizer')) {
            $requerimientos[] = 'La extensión Tokenizer necesota estar cargada!';
        }

        if (!extension_loaded('mbstring')) {
            $requerimientos[] = 'La extensión mbstring necesota estar cargada!';
        }

        if (!extension_loaded('curl')) {
            $requerimientos[] = 'La extensión cURL necesota estar cargada!';
        }

        if (!extension_loaded('xml')) {
            $requerimientos[] = 'La extensión XML necesota estar cargada!';
        }

        if (!extension_loaded('zip')) {
            $requerimientos[] = 'La extensión ZIP necesota estar cargada!';
        }

        if (!is_writable(base_path('storage/app'))) {
            $requerimientos[] = 'El directorio storage/app necesita tener permisos de escritura!';
        }

        if (!is_writable(base_path('storage/framework'))) {
            $requerimientos[] = 'El directorio storage/framework necesita tener permisos de escritura!';
        }

        if (!is_writable(base_path('storage/logs'))) {
            $requerimientos[] = 'El directorio storage/logs necesita tener permisos de escritura!';
        }

        return $requerimientos;
    }

    public static function createDbTables($host, $database, $username, $password)
    {
        if (!static::isDbValid($host, $database, $username, $password)) {
            return false;
        }

        static::saveDbVariables($host, 3306, $database, $username, $password);

        set_time_limit(300); // 5 minutos

        Artisan::call('migrate:refresh', ['--force' => true]);

        Artisan::call('db:seed', ['--force' => true]);

        return true;
    }

    public static function isDbValid($host, $database, $username, $password)
    {
        Config::set('database.connections.install_test', [
            'host'      => $host,
            'port'      => env('DB_PORT', '3306'),
            'database'  => $database,
            'username'  => $username,
            'password'  => $password,
            'driver'    => env('DB_CONNECTION', 'mysql'),
            'charset'   => env('DB_CHARSET', 'utf8mb4'),
        ]);

        try {
            DB::connection('install_test')->getPdo();
        } catch (\Exception $e) {;
            return false;
        }

        DB::purge('install_test');

        return true;
    }

    public static function saveDbVariables($host, $port, $database, $username, $password)
    {
        $prefix = strtolower(str_random(3) . '_');

        static::updateEnv([
            'DB_HOST'       =>  $host,
            'DB_PORT'       =>  $port,
            'DB_DATABASE'   =>  $database,
            'DB_USERNAME'   =>  $username,
            'DB_PASSWORD'   =>  $password,
            //'DB_PREFIX'     =>  $prefix,
        ]);

        $con = env('DB_CONNECTION', 'mysql');

        $db = Config::get('database.connections.' . $con);

        $db['host'] = $host;
        $db['database'] = $database;
        $db['username'] = $username;
        $db['password'] = $password;
        //$db['prefix'] = $prefix;

        Config::set('database.connections.' . $con, $db);

        DB::purge($con);
        DB::reconnect($con);
    }

    public static function createUser($first_name, $last_name, $email, $dni, $password)
    {
        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'dni' => $dni,
            'password' => $password,
			'estado' => 'Activo',
        ]);

        $rol = Roles::where('name','Administrador')->first();
        
        $user->assignRole($rol);

    }

    public static function updateSettings($data)
    {
        static::updateEnv($data);
    }

    public static function finalTouches()
    {
        static::updateEnv([
            'APP_LOCALE'    =>  session('locale'),
            'APP_INSTALLED' =>  'true',
            'APP_DEBUG'     =>  'false',
            'APP_URL'     =>  url(''),
        ]);
        /*
        try {
            File::move(base_path('robots.txt.dist'), base_path('robots.txt'));
        } catch (\Exception $e) {
            
        }*/
    }

    public static function updateEnv($data)
    {
        if (empty($data) || !is_array($data) || !is_file(base_path('.env'))) {
            return false;
        }

        $env = file_get_contents(base_path('.env'));

        $env = explode("\n", $env);

        foreach ($data as $data_key => $data_value) {
            foreach ($env as $env_key => $env_value) {
                $entry = explode('=', $env_value, 2);

                if ($entry[0] == $data_key) {
                    $env[$env_key] = $data_key . '=' . $data_value;
                } else {
                    $env[$env_key] = $env_value;
                }
            }
        }

        $env = implode("\n", $env);

        file_put_contents(base_path('.env'), $env);

        return true;
    }
}