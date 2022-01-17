<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentsTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(InfractionsTableSeeder::class);
        $this->call(typeNamesTableSeeder::class);
        $this->call(typeDocumentsTableSeeder::class);
        $this->call(CampusTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EvidencesTableSeeder::class);
        $this->call(InspectorsTableSeeder::class);
        $this->call(CampusInspectorsTableSeeder::class);
        $this->call(UitTableSeeder::class);
        $this->call(TypeProofsSeeder::class);
    }
}
