<?php

namespace Tests\Feature;

use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UrlControllerTest extends TestCase
{
    private $urlId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->urlId = DB::table('urls')->insertGetId([
                'name' => 'http://' . strtolower(Str::random(10)) . ".ru",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
        ]);
    }
    /**
     * Test of urls index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    /**
     * Test of urls store.
     *
     * @return void
     */
    public function testStore()
    {
        $data = ['url' => ['name' => 'https://' . Str::random(10) . ".com"]];
        $response = $this->post(route('urls.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('urls', $data['url']);
    }

    /**
     * Test of urls show.
     *
     * @return void
     */
    public function testShow()
    {
        $response = $this->get(route('urls.show', ['url' => $this->urlId]));
        $response->assertOk();
    }
}
