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
        $data = $benefitsResponse->json();

        $benefitsByYear = collect($data['data'])->groupBy(function ($item) {
            return substr($item['fecha'], 0, 4);
        })->map(function ($item, $key) {
            $total_anio = $item->sum('monto');
            return [
                'year' => (int)$key,
                'num' => $item->count(),
                'total' => $total_anio,
                'beneficios' => $item
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
