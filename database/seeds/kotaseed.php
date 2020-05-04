<?php

use Illuminate\Database\Seeder;

class kotaseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Kota;
        $data->code = '51.01';
        $data->name = 'Jembrana';
        $data->save(); 

        $data = new Kota;
        $data->code = '51.02';
        $data->name = 'Tabanan';
        $data->save(); 
        
        $data = new Kota;
        $data->code = '51.03';
        $data->name = 'Badung';
        $data->save(); 
        
        $data = new Kota;
        $data->code = '51.04';
        $data->name = 'Gianyar';
        $data->save();
        
        $data = new Kota;
        $data->code = '51.05';
        $data->name = 'Klungkung';
        $data->save(); 
        
        $data = new Kota;
        $data->code = '51.06';
        $data->name = 'Bangli';
        $data->save(); 
        
        $data = new Kota;
        $data->code = '51.07';
        $data->name = 'Karangasem';
        $data->save(); 
        
        $data = new Kota;
        $data->code = '51.08';
        $data->name = 'Buleleng';
        $data->save(); 
        
        $data = new Kota;
        $data->code = '51.71';
        $data->name = 'Denpasar';
        $data->save();
    }
}
