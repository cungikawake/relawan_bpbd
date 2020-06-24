<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(){
        $berita[1] = array(
            'id'   => 1,
            'judul' => 'testing berita 2',
            'image' => 'http://bpbd.baliprov.go.id/images/u3PrzvCZQJ8A2Nvx3Yb1.jpeg',
            'detail' => '<p>(1) Masyarakat di sekitar G. Agung dan pendaki/pengunjung/wisatawan agar tidak berada, tidak melakukan pendakian dan tidak melakukan aktivitas apapun di Zona Perkiraan Bahaya yaitu di seluruh area di dalam radius 4 km dari Kawah Puncak G. Agung. Zona Perkiraan Bahaya sifatnya dinamis dan terus dievaluasi dan dapat diubah sewaktu-waktu mengikuti perkembangan data pengamatan G. Agung yang paling aktual/terbaru.</p><br>
            <p>(2) Masyarakat yang bermukim dan beraktivitas di sekitar aliran-aliran sungai yang berhulu di Gunung Agung agar mewaspadai potensi ancaman bahaya sekunder berupa aliran lahar hujan yang dapat terjadi terutama pada musim hujan dan jika material erupsi masih terpapar di area puncak. Area landaan aliran lahar hujan mengikuti aliran-aliran sungai yang berhulu di Gunung Agung.</p>'
        );
        
        $berita[2] = array(
            'id'   => 2,
            'judul' => 'testing berita 2',
            'image' => 'http://bpbd.baliprov.go.id/images/u3PrzvCZQJ8A2Nvx3Yb1.jpeg',
            'detail' => '<p>(1) Masyarakat di sekitar G. Agung dan pendaki/pengunjung/wisatawan agar tidak berada, tidak melakukan pendakian dan tidak melakukan aktivitas apapun di Zona Perkiraan Bahaya yaitu di seluruh area di dalam radius 4 km dari Kawah Puncak G. Agung. Zona Perkiraan Bahaya sifatnya dinamis dan terus dievaluasi dan dapat diubah sewaktu-waktu mengikuti perkembangan data pengamatan G. Agung yang paling aktual/terbaru.</p><br>
            <p>(2) Masyarakat yang bermukim dan beraktivitas di sekitar aliran-aliran sungai yang berhulu di Gunung Agung agar mewaspadai potensi ancaman bahaya sekunder berupa aliran lahar hujan yang dapat terjadi terutama pada musim hujan dan jika material erupsi masih terpapar di area puncak. Area landaan aliran lahar hujan mengikuti aliran-aliran sungai yang berhulu di Gunung Agung.</p>'
        );
        

        return response()->json($berita, 200);
    }
}
