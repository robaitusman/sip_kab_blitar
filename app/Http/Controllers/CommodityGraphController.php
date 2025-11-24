<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CommodityGraphController extends Controller
{
    public function index($commodity)
    {
        // Validate the commodity name
        $validCommodities = [
            'gkp_petani',
            'gkg_penggilingan',
            'beras_premium',
            'beras_medium',
            'jagung_pipilan_kering',
            'ubi_kayu',
            'ubi_jalar',
            'kedelai_lokal_kering',
            'cabe_besar',
            'cabe_rawit_merah',
            'cabe_keriting',
            'bawang_merah',
            'daging_ayam',
            'daging_sapi',
            'telur_ayam_ras',
            'pisang',
            'jeruk'
        ];

        if (!in_array($commodity, $validCommodities)) {
            return abort(404); // Not found
        }

        // Fetch weekly averages for the specified commodity
        $data = DB::table('harga_produsen')
            ->select(DB::raw('YEAR(tanggal) as year, WEEK(tanggal, 1) as week, ROUND(AVG(' . $commodity . ')) as avg_commodity'))
            ->groupBy('year', 'week')
            ->orderBy('year', 'asc')
            ->orderBy('week', 'asc')
            ->get();

        $weeks = $data->pluck('week')->toArray();
        $averages = $data->pluck('avg_commodity')->toArray();

        // Create the chart
        $chart = (new LarapexChart)->lineChart()
            ->setTitle('Grafik Harga ' . ucfirst(str_replace('_', ' ', $commodity)))
            ->setXAxis($weeks)
            ->addData('Harga ' . ucfirst(str_replace('_', ' ', $commodity)), $averages)
            ->setColors(['#FF5733'])
            ->setMarkers(['#FF5733'], 5, 10);

        return view('custom.commodity_graph', compact('chart', 'commodity'));
    }
}
