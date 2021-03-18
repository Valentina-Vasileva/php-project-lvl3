<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
            'name' => 'http://' . Str::random(10) . ".ru",
            'created_at' => Carbon::now()->toString(),
            'updated_at' => Carbon::now()->toString()
        ];

        $newUrlId = DB::table('urls')->insertGetId($urlData);

        $response = $this->post(route('urls.checks.store', ['url' => $newUrlId]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('url_checks', ['url_id' => $newUrlId]);
    }
}
