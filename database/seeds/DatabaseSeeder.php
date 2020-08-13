<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        Schema::disableForeignKeyConstraints();
        $this->truncateMultiple([
            'cache',
            'failed_jobs',
            'ledgers',
            'jobs',
            'sessions',
            'states',
            'countries',
        ]);
        Schema::enableForeignKeyConstraints();

        $this->call(AuthTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);

        Model::reguard();
    }
}
