<?php

namespace App\Http\Controllers;

use App\Http\Resources\BenefitResource;
use Illuminate\Support\Facades\Http;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $benefitsResponse = Http::get('https://run.mocky.io/v3/399b4ce1-5f6e-4983-a9e8-e3fa39e1ea71');
        $benefitsData = $benefitsResponse->json();

        $filtersResponse = Http::get('https://run.mocky.io/v3/06b8dd68-7d6d-4857-85ff-b58e204acbf4');
        $filtersData = $filtersResponse->json();

        $dataSheet = Http::get('https://run.mocky.io/v3/c7a4777f-e383-4122-8a89-70f29a6830c0');
        $dataSheetData = $dataSheet->json();

        $filters = collect($filtersData['data'])->keyBy('id_programa');
        $dataSheets = collect($dataSheetData['data'])->keyBy('id');

        $benefitsByYear = collect($benefitsData['data'])->groupBy(function ($item) {
            return substr($item['fecha'], 0, 4);
        })->map(function ($benefits, $year) use ($filters, $dataSheets) {
            $filteredBenefits = $benefits->filter(function ($benefit) use ($filters) {
                $filter = $filters->get($benefit['id_programa']);

                return $benefit['monto'] >= $filter['min'] && $benefit['monto'] <= $filter['max'];
            })->map(function ($benefit) use ($filters, $dataSheets) {
                $filter = $filters->get($benefit['id_programa']);
                $ficha = $dataSheets->get($filter['ficha_id']);

                return array_merge($benefit, ['ficha' => $ficha]);
            });
            $totalByYear = $filteredBenefits->sum('monto');

            return [
                'year' => (int) $year,
                'num' => $filteredBenefits->count(),
                'totalByYear' => $totalByYear,
                'beneficios' => $filteredBenefits->values(),
            ];
        })->values();

        return BenefitResource::collection($benefitsByYear);
    }
}
