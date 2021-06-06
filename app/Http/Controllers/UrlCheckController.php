<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use DiDom\Document;

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

        if ($url === null) {
            abort(404);
        }
        try {
            $response = Http::get($url->name);
            $document = new Document($response->body());
            $h1 = optional($document->first('h1'))->text();
            $keywords = optional($document->first('meta[name=keywords]'))->getAttribute('content');
            $description = optional($document->first('meta[name=description]'))->getAttribute('content');
            $newUrl = DB::table('url_checks')->insertGetId(
                [
                    'url_id' => $id,
                    'created_at' => Carbon::now()->toString(),
                    'status_code' => $response->status(),
                    'h1' => $h1,
                    'keywords' => $keywords,
                    'description' => $description,
                    'updated_at' => Carbon::now()->toString()
                ]
            );
            return redirect()
                ->route('urls.show', ['url' => $id])
                ->with('status', __('messages.Page has been checked successfully'));
        } catch (\Exception $e) {
            return redirect()
                ->route('urls.show', ['url' => $id])
                ->withErrors("{$e->getMessage()}");
        }
    }
}
