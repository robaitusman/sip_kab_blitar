<?php

namespace App\Charts;

use App\Models\HargaProdusen;
use ArielMejiaDev\LarapexCharts\LineChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class HargaProdusenChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(){
        $data = HargaProdusen::with('kecamatan')->orderBy('tanggal', 'desc')->take(7)->get();

		$labels = $data->map(function($item) {
            return $item->tanggal . "|" . ($item->kecamatan?->nama ?? '');
        });

        return $this->chart->barChart()
        // ->setTitle('Harga Produsen Terakhir')
        // ->setSubtitle('Data Produsen Terakhir')
        ->addData('Beras Premium', $data->pluck('beras_premium')->toArray())
        ->addData('Beras Medium', $data->pluck('beras_medium')->toArray())
        ->addData('GKP Petani', $data->pluck('gkp_petani')->toArray())
        ->addData('GKG Penggilingan', $data->pluck('gkg_penggilingan')->toArray())
        ->addData('Jagung Pipilan Kering', $data->pluck('jagung_pipilan_kering')->toArray())
        ->addData('Ubi Kayu', $data->pluck('ubi_kayu')->toArray())
        ->addData('Ubi Jalar', $data->pluck('ubi_jalar')->toArray())
        ->addData('Kedelai Lokal Kering', $data->pluck('kedelai_lokal_kering')->toArray())
        ->addData('Cabe Besar', $data->pluck('cabe_besar')->toArray())
        ->addData('Cabe Rawit Merah', $data->pluck('cabe_rawit_merah')->toArray())
        ->addData('Cabe Keriting', $data->pluck('cabe_keriting')->toArray())
        ->addData('Bawang Merah', $data->pluck('bawang_merah')->toArray())
        ->addData('Daging Ayam', $data->pluck('daging_ayam')->toArray())
        ->addData('Daging Sapi', $data->pluck('daging_sapi')->toArray())
        ->addData('Telur Ayam Ras', $data->pluck('telur_ayam_ras')->toArray())
        ->addData('Pisang', $data->pluck('pisang')->toArray())
        ->addData('Jeruk', $data->pluck('jeruk')->toArray())
        ->setXAxis($labels->toArray())
        ->setGrid(true) 
        ->setHeight(500);
    }

        

    
	

 }

