<?php

namespace App\Http\Controllers;

use App\Models\DataMikrotik;
use App\Models\DataOLT;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function postmikrotik(Request $req)
    {
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

        Alert::success('Berhasil', 'Data MikroTik berhasil disimpan!');
        return redirect()->back();
    }

    public function postolt(Request $req)
    {
        $ipolt = $req->ipolt;
        $catatan = $req->catatan;

        $data = DataOLT::create([
            'ipolt' => $ipolt,
            'catatan' => $catatan,
            'slugcatatan' => Str::slug($catatan, "_")
        ]);

        Alert::success('Berhasil', 'Data OLT berhasil disimpan!');
        return redirect()->back();
    }

    public function carimikrotik()
    {
        $dm = DataMikrotik::all();
        return view('Dashboard/DATA/carimikrotik', compact('dm'));
    }

    public function cariolt()
    {
        $do = DataOLT::all();
        return view('Dashboard/DATA/cariolt', compact('do'));
    }

    public function caridataolt(Request $req)
    {
        $slugcatatan = $req->slugcatatan;
        $data = DataOLT::where('slugcatatan', $slugcatatan)->first();
        return view('Dashboard/DATA/olt', compact('data'));
    }

    public function cari(Request $req)
    {
        $slugcatatan = $req->input('slugcatatan');
        $data = DataMikrotik::where('slugcatatan', $slugcatatan)->first();

        if (!$data) {
            Alert::error('Error', 'Mikrotik tidak ditemukan.');
            return redirect()->back();
        }

        $ip = $data->ipmikrotik;
        $username = $data->usernamemikrotik;
        $password = $data->passwordmikrotik;
        $port = $data->portmikrotik;

        $config = new Config([
            'host' => $ip,
            'user' => $username,
            'pass' => $password,
            'port' => $port,
        ]);

        try {
            $client = new Client($config);
            $query = (new Query('/ppp/active/print'));
            $response = $client->query($query)->read();

            return view('Dashboard/DATA/mikrotik', compact('response', 'slugcatatan'));
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghubungkan ke MikroTik: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    // public function remotemodem(Request $req, $slugcatatan)
    // {
    //     $data = DataMikrotik::where('slugcatatan', $slugcatatan)->first();
    //     $ipaddr = $req->input('ipaddr');
    //     $toport = $req->toport;

    //     $ip = $data->ipmikrotik;
    //     $username = $data->usernamemikrotik;
    //     $password = $data->passwordmikrotik;
    //     $port = $data->portmikrotik;

    //     try {
    //         $client = new Client([
    //             'host' => $ip,
    //             'user' => $username,
    //             'pass' => $password,
    //             'port' => $port,
    //         ]);

    //         $query = (new Query('/ip/firewall/nat/print'))
    //             ->where('comment', 'Remote-web');
    //         $response = $client->query($query)->read();

    //         if (empty($response)) {
    //             Alert::error('Error', 'NAT rule tidak ditemukan.');
    //             return response()->json(['success' => false, 'message' => 'NAT rule not found.']);
    //         }

    //         $ruleId = $response[0]['.id'];

    //         $query = (new Query('/ip/firewall/nat/set'))
    //             ->equal('.id', $ruleId)
    //             ->equal('action', 'dst-nat')
    //             ->equal('chain', 'dstnat')
    //             ->equal('comment', 'Remote-web')
    //             ->equal('dst-address-list', 'ippublic')
    //             ->equal('dst-port', '4190')
    //             ->equal('protocol', 'tcp')
    //             ->equal('to-addresses', $ipaddr)
    //             ->equal('to-ports', $toport);

    //         $client->query($query)->read();

    //         Alert::success('Berhasil', 'NAT rule berhasil diperbarui!');
    //         return response()->json(['success' => TRUE, 'message' => 'NAT rule updated successfully.']);
    //     } catch (\Exception $e) {
    //         Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
    //         return response()->json(['success' => false, 'message' => $e->getMessage()]);
    //     }
    // }

    public function remotemodem(Request $req, $slugcatatan)
    {
        $data = DataMikrotik::where('slugcatatan', $slugcatatan)->first();
        $ipaddr = $req->input('ipaddr');
        $toport = $req->toport;
    
        $ip = $data->ipmikrotik;
        $username = $data->usernamemikrotik;
        $password = $data->passwordmikrotik;
        $port = $data->portmikrotik;
    
        try {
            $client = new Client([
                'host' => $ip,
                'user' => $username,
                'pass' => $password,
                'port' => $port,
            ]);
    
            $query = (new Query('/ip/firewall/nat/print'))
                ->where('comment', 'Remote-web');
            $response = $client->query($query)->read();
    
            if (empty($response)) {
                return response()->json(['success' => false, 'message' => 'NAT rule not found.']);
            }
    
            $ruleId = $response[0]['.id'];
    
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
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
    

    // public function restartkoneksi(Request $req, $slugcatatan, $name)
    // {
    //     $data = DataMikrotik::where('slugcatatan', $slugcatatan)->first();

    //     if (!$data) {
    //         Alert::error('Gagal', 'Data MikroTik tidak ditemukan.');
    //         return response()->json(['success' => false, 'message' => 'Data MikroTik tidak ditemukan.']);
    //     }

    //     $ip = $data->ipmikrotik;
    //     $username = $data->usernamemikrotik;
    //     $password = $data->passwordmikrotik;
    //     $port = $data->portmikrotik;

    //     try {
    //         $client = new Client([
    //             'host' => $ip,
    //             'user' => $username,
    //             'pass' => $password,
    //             'port' => $port,
    //         ]);

    //         $query = (new Query('/ppp/active/print'))
    //             ->where('name', $name);

    //         $pppActiveConnections = $client->query($query)->read();

    //         if (count($pppActiveConnections) > 0) {
    //             $pppId = $pppActiveConnections[0]['.id'];

    //             $removeQuery = (new Query('/ppp/active/remove'))
    //                 ->equal('.id', $pppId);

    //             $result = $client->query($removeQuery)->read();

    //             if (!isset($result['!trap'])) {
    //                 Alert::success('Berhasil', 'Koneksi PPPoE berhasil dihapus!');
    //                 return response()->json(['success' => true, 'message' => 'Koneksi PPPoE berhasil dihapus.']);
    //             } else {
    //                 Alert::error('Gagal', 'Gagal menghapus koneksi PPPoE: ' . $result['!trap'][0]['message']);
    //                 return response()->json(['success' => false, 'message' => 'Gagal menghapus koneksi PPPoE: ' . $result['!trap'][0]['message']]);
    //             }
    //         } else {
    //             Alert::error('Gagal', "Koneksi PPPoE dengan nama '$name' tidak ditemukan.");
    //             return response()->json(['success' => false, 'message' => "Koneksi PPPoE dengan nama '$name' tidak ditemukan."]);
    //         }
    //     } catch (\Exception $e) {
    //         Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
    //         return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    //     }
    // }

    public function restartkoneksi(Request $req, $slugcatatan, $name)
{
    $data = DataMikrotik::where('slugcatatan', $slugcatatan)->first();

    if (!$data) {
        return response()->json(['success' => false, 'message' => 'Data MikroTik tidak ditemukan.']);
    }

    $ip = $data->ipmikrotik;
    $username = $data->usernamemikrotik;
    $password = $data->passwordmikrotik;
    $port = $data->portmikrotik;

    try {
        $client = new Client([
            'host' => $ip,
            'user' => $username,
            'pass' => $password,
            'port' => $port,
        ]);

        $query = (new Query('/ppp/active/print'))
            ->where('name', $name);

        $pppActiveConnections = $client->query($query)->read();

        if (count($pppActiveConnections) > 0) {
            $pppId = $pppActiveConnections[0]['.id'];

            $removeQuery = (new Query('/ppp/active/remove'))
                ->equal('.id', $pppId);

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
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}

}
