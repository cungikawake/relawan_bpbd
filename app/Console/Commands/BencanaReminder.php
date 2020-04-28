<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Bencana;

class BencanaReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bencana:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengiriman pesan pengingat untuk bencana yang sedang berlangsung.';

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
        $userkey = env('ZENVIVA_USERKEY');
        $passkey = env('ZENVIVA_PASSKEY');
        $today = date('Y-m-d', strtotime('tomorrow'));
        // $today = "2020-04-20";
        $datas = Bencana::where('status_jenis', 1)
                    ->where('tgl_mulai', '=', $today)
                    ->get();

        \Log::info([
            'bencana:reminder' => true,
            'reminder date' => $today
        ]);
        
        foreach($datas as $data){

            foreach($data->joinRelawan() as $row){
                $telepon = $row->relawan->tlp;
            
                $message = "Halo ".$row->relawan->nama_lengkap."./n Mengingat besok pada tanggal ".$data->tgl_mulai.", merupakan dimulainya kegiatan ".$data->judul_bencana."./n Terima Kasih /n BPBD BALI";

                $url = "https://reguler.zenziva.net/apps/smsapi.php";
                $curlHandle = curl_init();
                curl_setopt($curlHandle, CURLOPT_URL, $url);
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
                curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
                curl_setopt($curlHandle, CURLOPT_POST, 1);
                $results = curl_exec($curlHandle);
                curl_close($curlHandle);

                \Log::info([
                    'zenziva-smsapi' => true,
                    'results' => $results,
                    'RelawanBencana ID' => $row->id,
                    'Bencana ID' => $data->id
                ]);
            }
        }
    }
}
