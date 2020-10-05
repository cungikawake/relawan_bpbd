<?php

use Illuminate\Database\Seeder;
use App\Models\Kategori;
class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoris = ['Longsor', 'Banjir', 'Hujan', 'Banjir', 'Gempa Bumi', 'Cuaca Ekstrim', 'Kebakaran Rumah/Gedung', 'Kebarakaran Hutan/Lahan', 'Kekeringan', 'Gunung_Api', 'Virus'];
        for ($i=0; $i <= count($kategoris); $i++) {
            foreach ($kategoris as $kategori) {
                $data = new Kategori;
                $data->nama_kategori = $kategori;
                $data->gambar = '';
                $data->save();
                $i+=1;
            }
        }
    }
}
