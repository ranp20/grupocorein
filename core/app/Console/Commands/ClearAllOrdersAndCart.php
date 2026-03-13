<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearAllOrdersAndCart extends Command{
    protected $signature = 'clearallordersandcart';
    protected $description = 'Vaciar las tablas de órdenes y carritos y restablecer los autoincrements a 1';

    public function __construct(){
        parent::__construct();
    }

    public function handle(){
        // Nombres de las tablas que se van a vaciar y restablecer.
        $tables = [
            'tbl_temp_carts',
            'orders',
            'track_orders',
            'transactions',
            'wishlists',
            'tbl_applycoupons',
            'notifications',
            'tbl_complaints_books'
        ];

        // Iterar sobre cada tabla para truncar y restablecer autoincrement.
        foreach ($tables as $table) {
            DB::statement("TRUNCATE TABLE {$table}");
            DB::statement("ALTER TABLE {$table} AUTO_INCREMENT = 1");
        }
        // Dando formato de salida a los nombres de las tablas en el mensaje en consola
        // $formattedTables = array_map(fn($tbls) => "- {$tbls}", $tables); // USANDO ARROW FUNCTION, NOTA: ALGUNAS ADMINISTRADORES DE ARCHIVOS LO DETECTARÁN COMO ERROR, REQUIERE PROBAR PRIMERAMENTE...
        $formattedTables = array_map(function($tbls) {
            return "- {$tbls}";
        }, $tables);
        $message = "Todos los registros de:\n" . implode("\n", $formattedTables) . "\nhan sido vaciados y los autoincrements restablecidos a 1.";
        $this->info($message);
    }
}
