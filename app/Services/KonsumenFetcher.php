<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Http;

class KonsumenFetcher
{
	/**
	 * Ambil dan parsing data konsumen.
	 */
	public static function fetch(): array
	{
		$url = 'https://siskaperbapo.jatimprov.go.id/harga/tabel.nodesign/';

		$response = Http::withHeaders([
			'accept' => '*/*',
			'content-type' => 'application/x-www-form-urlencoded; charset=UTF-8',
			'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36',
			'x-requested-with' => 'XMLHttpRequest',
		])->asForm()->post($url, [
			'tanggal' => now()->format('Y-m-d'),
			'kabkota' => 'blitarkab',
		]);

		if (! $response->successful()) {
			return [];
		}

		$dom = new DOMDocument();
		libxml_use_internal_errors(true);
		$dom->loadHTML($response->body());
		libxml_clear_errors();

		$xpath = new DOMXPath($dom);
		$rows = $xpath->query("//table[contains(@class, 'table')]/tr");

		if (! $rows || $rows->length === 0) {
			return [];
		}

		$excludeItems = [
			'Semen Gresik',
			'Semen Tiga Roda',
			'Semen Padang',
			'Semen Tonasa',
			'Semen Bosowa',
			'Semen Dynamix',
			'KAYU BALOK MERANTI (4 X 10)',
			'Papan Meranti (4m X 3cm X 20mm)',
			'TRIPLEK (6MM)',
			'Besi Beton 6 mm (12/9m)',
			'Besi Beton 8 mm (12/9m)',
			'Besi Beton 10 mm (12/9m)',
			'Besi Beton 12 mm (12/9m)',
			'Paku Ukuran 10Cm',
			'Paku Ukuran 2 Cm',
			'Paku Ukuran 3Cm',
			'Paku Ukuran 4Cm',
			'Paku Ukuran 5Cm',
			'Paku Ukuran 7Cm',
			'GAS ELPIGI 3 Kg',
			'Pupuk KCL Non Subsidi',
			'Pupuk NPK Non Subsidi',
			'Pupuk SP 35 Non Subsidi',
			'Pupuk Urea Non Subsidi',
			'Pupuk ZA Non Subsidi',
		];

		$data = [];

		foreach ($rows as $row) {
			$cols = $row->getElementsByTagName('td');

			if ($cols->length < 7) {
				continue;
			}

			$namaBahanPokok = trim($cols->item(1)->nodeValue);

			if (strpos($namaBahanPokok, '- ') === false) {
				continue;
			}

			$namaBahanPokok = str_replace('- ', '', $namaBahanPokok);

			if (in_array($namaBahanPokok, $excludeItems)) {
				continue;
			}

			$data[] = [
				'no' => trim($cols->item(0)->nodeValue),
				'nama_bahan_pokok' => $namaBahanPokok,
				'satuan' => trim($cols->item(2)->nodeValue),
				'harga_kemarin' => trim($cols->item(3)->nodeValue),
				'harga_sekarang' => trim($cols->item(4)->nodeValue),
				'perubahan_rp' => trim($cols->item(5)->nodeValue),
				'perubahan_persen' => trim($cols->item(6)->nodeValue),
			];
		}

		return $data;
	}
}
