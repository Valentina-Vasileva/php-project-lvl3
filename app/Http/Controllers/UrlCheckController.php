<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class UrlCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $url = DB::table('urls')->find($id);

        if ($url === null) {
            abort(404);
        }
        try {
            $response = Http::get($url->name);

            $newUrl = DB::table('url_checks')->insertGetId(
                [
                    'url_id' => $id,
                    'created_at' => Carbon::now()->toString(),
                    'status_code' => $response->status(),
                    'updated_at' => Carbon::now()->toString()
                ]
            );

            return redirect()
                ->route('urls.show', ['url' => $id])
                ->with('status', 'Страница успешно проверена');
        } catch (\Exception $e) {
            return redirect()
                ->route('urls.show', ['url' => $id])
                ->withErrors("{$e->getMessage()}");
        }
    }
}
