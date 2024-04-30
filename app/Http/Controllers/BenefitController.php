<?php

namespace App\Http\Controllers;

use App\Http\Resources\BenefitResource;
use Illuminate\Http\Request;
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

        $filters = collect($filtersData['data'])->keyBy('id_programa');
        //dd($filters); // 147 - 146 - 130

        $benefitsByYear = collect($benefitsData['data'])->groupBy(function ($item) {
            return substr($item['fecha'], 0, 4);
        })->map(function ($benefits, $year) use ($filters) {
            $filteredBenefits = $benefits->filter(function ($benefit) use ($filters) {
                $filter = $filters->get($benefit['id_programa']);

                return $benefit['monto'] >= $filter['min'] && $benefit['monto'] <= $filter['max'];
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
