<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearSessions extends Command{
    protected $signature = 'session:flush';
    protected $description = 'Eliminar todas las sessiones de usuario';

    public function __construct(){
        parent::__construct();
    }

    public function handle(){
        // Elimina todas las sesiones que existen desde hace 0 minutos
        DB::table('sessions')->truncate();
        $this->info('Todas las sesiones del usuario han sido eliminadas.');
    }
}
