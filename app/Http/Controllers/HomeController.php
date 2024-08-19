<?php

namespace App\Http\Controllers;

use App\Models\DataMikrotik;
use App\Models\DataOLT;
use RouterOS\Client;
use RouterOS\Config;
use \RouterOS\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Dashboard/index');
    }
    public function postmikrotik(Request $req){
        $ipmikrotik = $req->ipmikrotik;
        $username = $req->usernamemikrotik;
        $password = $req->passwordmikrotik;
        $port = $req->portmikrotik;
        $catatan = $req->catatan;

        $data = DataMikrotik::create([
            'ipmikrotik' => $ipmikrotik,
            'usernamemikrotik' => $username,
            'passwordmikrotik' => $password,
            'portmikrotik' => $port,
            'catatan' => $catatan,
            'slugcatatan' => Str::slug($catatan, "_")
        ]);
        return redirect()->back();
    }
    public function postolt(Request $req){
        $ipolt = $req->ipolt;
        $catatan = $req->catatan;

        $data = DataOLT::create([
            'ipolt' => $ipolt,
            'catatan' => $catatan,
            'slugcatatan' => Str::slug($catatan, "_")
        ]);
        return redirect()->back();
    }
    public function carimikrotik(){
        
        $dm = DataMikrotik::all();
       //dd($dm);
        return view('Dashboard/DATA/carimikrotik', compact('dm'));
    }
    public function cariolt(){
        $do = DataOLT::all();
       //dd($dm);
        return view('Dashboard/DATA/cariolt', compact('do'));
    }
    public function caridataolt(Request $req){
        $slugcatatan = $req->slugcatatan;
      $data = DataOLT::where('slugcatatan', $slugcatatan)->first();
      //dd($slugcatatan);
    return view('Dashboard/DATA/olt', compact('data'));
    }
   public function cari(Request $req) {
    // Ambil data slugcatatan dari request GET
    $slugcatatan = $req->input('slugcatatan');

    // Cari data MikroTik berdasarkan slugcatatan
    $data = DataMikrotik::where('slugcatatan', $slugcatatan)->first();

    // Periksa apakah data ditemukan
    if (!$data) {
        return redirect()->back()->with('error', 'Mikrotik tidak ditemukan.');
    }

    // Ambil data koneksi MikroTik
    $ip = $data->ipmikrotik;
    $username = $data->usernamemikrotik;
    $password = $data->passwordmikrotik;
    $port = $data->portmikrotik;

    // Konfigurasi koneksi MikroTik
    $config = new Config([
        'host' => $ip,
        'user' => $username,
        'pass' => $password,
        'port' => $port,
    ]);

    try {
        // Buat client dan query untuk mendapatkan daftar PPPoE aktif
        $client = new Client($config);
        $query = (new Query('/ppp/active/print'));
        $response = $client->query($query)->read();

        // Tampilkan hasil ke view dengan data yang ditemukan
        return view('Dashboard/DATA/mikrotik', compact('response', 'slugcatatan'));
    } catch (\Exception $e) {
        // Jika ada kesalahan, kembalikan pesan error
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghubungkan ke MikroTik: ' . $e->getMessage());
    }
}

    public function remotemodem(Request $req, $slugcatatan) {
        $data = DataMikrotik::where('slugcatatan', $slugcatatan)->first();
        $ipaddr = $req->input('ipaddr'); // Use input method to get the form value
        $toport = $req->toport;
        
dd($ipaddr);
        $ip = $data->ipmikrotik;
        $username = $data->usernamemikrotik;
        $password = $data->passwordmikrotik;
        $port = $data->portmikrotik;
        
        try {
            // Connect to MikroTik
            $client = new Client([
            'host' => $ip, #103.158.121.51
            'user' => $username,
            'pass' => $password,
            'port' => $port,
            ]);
            
            // Find the existing rule by comment
            $query = (new Query('/ip/firewall/nat/print'))
                ->where('comment', 'Remote-web');
            $response = $client->query($query)->read();

            if (empty($response)) {
                return response()->json(['success' => false, 'message' => 'NAT rule not found.']);
            }

            $ruleId = $response[0]['.id'];

            // Set the NAT rule
            $query = (new Query('/ip/firewall/nat/set'))
                ->equal('.id', $ruleId)
                ->equal('action', 'dst-nat')
                ->equal('chain', 'dstnat')
                ->equal('comment', 'Remote-web')
                ->equal('dst-address-list', 'ippublic')
                ->equal('dst-port', '4190')
                ->equal('protocol', 'tcp')
                ->equal('to-addresses', $ipaddr)
                ->equal('to-ports', $toport);

            $client->query($query)->read();

            return response()->json(['success' => true, 'message' => 'NAT rule updated successfully.']);
            // return redirect()->route('cari')->with('success', 'Berhasil Merubah Firewall Access');
        } catch (\Exception $e) {
           return response()->json(['success' => false, 'message' => $e->getMessage()]);
            // return redirect()->route('cari')->with('error', $e->getMessage());

        }
    }

    public function restartkoneksi(Request $req, $slugcatatan, $name) {
        // Ambil data MikroTik berdasarkan slugcatatan
        $data = DataMikrotik::where('slugcatatan', $slugcatatan)->first();
    
        // Periksa apakah data ditemukan
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Data MikroTik tidak ditemukan.']);
        }
    
        // Ambil data koneksi MikroTik
        $ip = $data->ipmikrotik;
        $username = $data->usernamemikrotik;
        $password = $data->passwordmikrotik;
        $port = $data->portmikrotik;
    
        try {
            // Hubungkan ke MikroTik
            $client = new Client([
                'host' => $ip,
                'user' => $username,
                'pass' => $password,
                'port' => $port,
            ]);
    
            // Langkah 1: Cari koneksi PPPoE aktif berdasarkan 'name'
            $query = (new Query('/ppp/active/print'))
                ->where('name', $name); // Menentukan nama pengguna PPPoE
    
            // Eksekusi query untuk mendapatkan detail koneksi
            $pppActiveConnections = $client->query($query)->read();
    
            // Periksa apakah ada koneksi yang ditemukan
            if (count($pppActiveConnections) > 0) {
                $pppId = $pppActiveConnections[0]['.id'];
    
                // Langkah 2: Hapus koneksi PPPoE yang aktif menggunakan '.id'
                $removeQuery = (new Query('/ppp/active/remove'))
                    ->equal('.id', $pppId);  // Gunakan .id dari koneksi yang ditemukan
    
                // Eksekusi query untuk menghapus koneksi
                $result = $client->query($removeQuery)->read();
    
                if (!isset($result['!trap'])) {
                    return response()->json(['success' => true, 'message' => 'Koneksi PPPoE berhasil dihapus.']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Gagal menghapus koneksi PPPoE: ' . $result['!trap'][0]['message']]);
                }
            } else {
                return response()->json(['success' => false, 'message' => "Koneksi PPPoE dengan nama '$name' tidak ditemukan."]);
            }
        } catch (\Exception $e) {
            // Tangani exception dan kembalikan pesan error
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    




    }

