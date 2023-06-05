<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class KriteriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Schema::disableForeignKeyConstraints();
        kriteria::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['name' => 'C1', 'keterangan' => 'Visi, Misi, Tujuan Dan Strategi'],
        ];

        foreach ($data as $value) {
            # code...
            Kriteria::insert([
                'name' => $value['name'],
                'keterangan' => $value['keterangan'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // DB::table('kriterias')->insert([
        //     'code' => '1',
        //     'deskripsi' => 'Visi, Misi, Tujuan Dan Strategi',
        // ]);
    }
}
