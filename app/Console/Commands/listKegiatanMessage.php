<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RelawanBencana;

class listKegiatanMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kegiatan:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim pesan konfirmasi kegiatan ke relawan';

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
     * @return mixed
     */
    public function handle()
    {
        \Log::info([
            'kegiatan:message' => true
        ]);

        $datas = RelawanBencana::where('email_status', 0)->where('status_join', '>', 0)->orderBy('tgl_join', 'asc')->get();
        foreach($datas as $data){
            $userkey = "xxxxxx";
            $passkey = "xxxxxx";
            $telepon = $data->relawan->tlp;
            $message = "";

            if($data->status_join == 1){
                $message .= "Halo ".$data->relawan->nama_lengkap.", Anda diterima untuk bergabung pada kegiatan penanganan bencana ".$data->bencana->judul_bencana.".";


            }else if($data->status_join == 2){
                $message .= "Halo ".$data->relawan->nama_lengkap.", Anda belum diterima untuk bergabung pada kegiatan penanganan bencana ".$data->bencana->judul_bencana.".";
                
                if(count($data->relawan->bencanaDetail($data->bencana->tgl_mulai, $data->bencana->tgl_selesai))) {
                    $message .= " Dikarenakan anda sudah bergabung dalam kegiatan ".$data->relawan->bencanaDetail($data->bencana->tgl_mulai, $data->bencana->tgl_selesai)->first()->judul_bencana.".";
                }else{ 
                    $message .= " Dikarenakan Jumlah peserta sudah melebihi quota kegiatan.";
                }
                
            }

            if($message != ""){
                // $url = "https://reguler.zenziva.net/apps/smsapi.php";
                // $curlHandle = curl_init();
                // curl_setopt($curlHandle, CURLOPT_URL, $url);
                // curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
                // curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                // curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
                // curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
                // curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
                // curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
                // curl_setopt($curlHandle, CURLOPT_POST, 1);
                // $results = curl_exec($curlHandle);
                // curl_close($curlHandle);

                // \Log::info([
                //     'zenziva-smsapi' => true,
                //     'results' => $results
                // ]);

                // $data->email_status = 1;
                // $data->save();

                // echo $message." ".$telepon."<br> <br>";
                
                \Log::info([
                    'kegiatan:message' => true,
                    'RelawanBencana ID' => $data->id
                ]);
            }
        }

    }
}
