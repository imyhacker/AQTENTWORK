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
    public function cari(Request $req){
        $slugcatatan = $req->slugcatatan;
      $data = DataMikrotik::where('slugcatatan', $slugcatatan)->first();
      
      
        $ip = $data->ipmikrotik;
        $username = $data->usernamemikrotik;
        $password = $data->passwordmikrotik;
        $port = $data->portmikrotik;
        //$sc = $data->slugcatatan;
        

        $config = new Config([
            'host' => $ip, #103.158.121.51
            'user' => $username,
            'pass' => $password,
            'port' => $port,
        ]);
        $client = new Client($config);
        $query =
        (new Query('/ppp/active/print'));
         $response = $client->query($query)->read();
        //dd($response);
         return view('Dashboard/DATA/mikrotik', compact('response', 'slugcatatan'));
    }
    
    public function remotemodem(Request $req, $slugcatatan) {
        $data = DataMikrotik::where('slugcatatan', $slugcatatan)->first();
        $ipaddr = $req->ipaddr;
        $toport = $req->toport;
        
      

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


    public function restartkoneksi(Request $req, $slugcatatan, $idm) {
       
        $data = DataMikrotik::where('slugcatatan', $slugcatatan)->first();

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
            
            // Set the NAT rule
            $query = (new Query('/ppp/active/remove'))
            ->equal('number', $slugcatatan);
             
              
                
            $client->query($query)->read();

            return response()->json(['success' => true, 'message' => 'NAT rule updated successfully.']);
            // return redirect()->route('cari')->with('success', 'Berhasil Merubah Firewall Access');
        } catch (\Exception $e) {
           return response()->json(['success' => false, 'message' => $e->getMessage()]);
            // return redirect()->route('cari')->with('error', $e->getMessage());

        }
    }




    }

