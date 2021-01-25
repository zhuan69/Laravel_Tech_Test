<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CustomMigrationOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ordered_migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Costume Migration Order Execute';

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
        $migrations = [
            '2021_01_22_120841_create_users_table.php',
            '2021_01_22_121214_create_product_table.php',
            '2021_01_26_014625_create_topup_history.php',
            '2021_01_22_121224_create_order_table.php',
            '2021_01_22_121238_create_payment_table.php',
        ];
        foreach ($migrations as $migrate) {
            $basePath = 'database/migrations/';
            $migrationName = trim($migrate);
            $pathName = $basePath . $migrationName;
            $this->call('migrate:refresh', ['--path' => $pathName]);
        }
    }
}
