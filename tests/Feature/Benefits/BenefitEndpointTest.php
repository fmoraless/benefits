<?php

namespace Tests\Feature\Benefits;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BenefitEndpointTest extends TestCase
{
    protected $mockData;

    protected $invalidMockData;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockData = json_decode(file_get_contents('tests/MockData/benefitsResponse.json'));

        $this->invalidMockData = json_decode(file_get_contents('tests/MockData/benefitsInvalidResponse.json'));

    }

    /** @test */
    public function it_returns_data_from_benefits_endpoint()
    {
        $response = Http::get('https://run.mocky.io/v3/399b4ce1-5f6e-4983-a9e8-e3fa39e1ea71');

        $responseData = $response->json();
        $this->assertEquals(200, $responseData['code']);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertGreaterThan(0, count($responseData['data']));

    }

    /** @test */
    public function it_returns_data_from_filters_endpoint()
    {
        $response = Http::get('https://run.mocky.io/v3/06b8dd68-7d6d-4857-85ff-b58e204acbf4');

        $responseData = $response->json();
        $this->assertEquals(200, $responseData['code']);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertGreaterThan(0, count($responseData['data']));

    }

    /** @test */
    public function it_returns_data_from_data_sheet_endpoint()
    {
        $response = Http::get('https://run.mocky.io/v3/c7a4777f-e383-4122-8a89-70f29a6830c0');

        $responseData = $response->json();
        $this->assertEquals(200, $responseData['code']);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertGreaterThan(0, count($responseData['data']));

    }
}
