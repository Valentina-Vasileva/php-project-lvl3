<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use DiDom\Document;
use Illuminate\Http\Client\HttpClientException;
use GuzzleHttp\Exception\RequestException;

class UrlCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, int $id)
    {
        $url = DB::table('urls')->find($id);

        abort_unless($url, 404);

        try {
            $response = Http::get($url->name);
            $document = new Document($response->body());
            $h1 = optional($document->first('h1'))->text();
            $keywords = optional($document->first('meta[name=keywords]'))->getAttribute('content');
            $description = optional($document->first('meta[name=description]'))->getAttribute('content');

            DB::table('url_checks')->insert([
                    'url_id' => $id,
                    'created_at' => Carbon::now()->toString(),
                    'status_code' => $response->status(),
                    'h1' => $h1,
                    'keywords' => $keywords,
                    'description' => $description,
                    'updated_at' => Carbon::now()->toString()
            ]);

            flash(__('messages.Page has been checked successfully'))->success();
        } catch (HttpClientException | RequestException $e) {
            flash($e->getMessage())->error();
        }
        return redirect()->route('urls.show', ['url' => $id]);
    }
}
