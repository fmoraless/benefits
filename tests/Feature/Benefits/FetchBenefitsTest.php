<?php

namespace Tests\Feature\Benefits;

use Tests\TestCase;

class FetchBenefitsTest extends TestCase
{
    /** @test */
    public function can_fetch_benefits_data()
    {
        $response = $this->get(route('benefits.index'));
        $response->assertStatus(200);

        $expectedJsonStructure = [
            'data' => [
                '*' => [
                    'year',
                    'num',
                    'totalByYear',
                    'beneficios' => [
                        '*' => [
                            'id_programa',
                            'monto',
                            'fecha_recepcion',
                            'fecha',
                            'ficha' => [
                                'id',
                                'nombre',
                                'id_programa',
                                'url',
                                'categoria',
                                'descripcion',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $response->assertJsonStructure($expectedJsonStructure);
    }
}
