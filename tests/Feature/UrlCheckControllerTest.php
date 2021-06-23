<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UrlCheckControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $urlData = [
            'name' => 'http://' . strtolower(Str::random(10)) . ".ru",
            'created_at' => Carbon::now()->toString(),
            'updated_at' => Carbon::now()->toString()
        ];

        $newUrlId = DB::table('urls')->insertGetId($urlData);

        $testHtml = file_get_contents(implode(DIRECTORY_SEPARATOR, [__DIR__, '..', "Fixtures", 'test.html']));

        if ($testHtml === false) {
            throw new \Exception("Cannot get content from fixture");
        }

        Http::fake([$urlData['name'] => Http::response($testHtml, 200)]);

        $expectedData = [
            'url_id' => $newUrlId,
            'status_code' => 200,
            'h1' => 'test_header',
            'keywords' => 'test_word',
            'description' => 'test_description'
        ];

        $response = $this->post(route('urls.checks.store', $newUrlId));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('url_checks', $expectedData);
    }
}
