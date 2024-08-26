<?php

namespace App\Http\Controllers;

use App\Models\DataMikrotik;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\YourModel; // Ganti dengan model yang sesuai

class DataController extends Controller
{
    public function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $data = DataMikrotik::all(); // Ganti dengan query yang sesuai

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('trx', function ($row) {
                    return $this->formatBytes($row->rx_byte); // Format data sesuai kebutuhan
                })
                ->editColumn('ttx', function ($row) {
                    return $this->formatBytes($row->tx_byte); // Format data sesuai kebutuhan
                })
                ->make(true);
        }
    }

    private function formatBytes($bytes)
    {
        if ($bytes >= 1024 * 1024 * 1024) {
            return number_format($bytes / (1024 * 1024 * 1024), 2) . ' GB';
        } elseif ($bytes >= 1024 * 1024) {
            return number_format($bytes / (1024 * 1024), 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return number_format($bytes, 2) . ' BPS';
        }
    }
}
