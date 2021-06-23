<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $lastChecksId = DB::table('url_checks')
            ->select(DB::raw('url_id, MAX(id) as last_check_id'))
            ->groupBy('url_id')
            ->pluck('last_check_id')
            ->all();

        $lastChecks = DB::table('url_checks')
            ->whereIn('id', $lastChecksId)
            ->get()
            ->keyBy('url_id');

        $urls = DB::table('urls')
            ->oldest()
            ->paginate();

        return view('url.index', compact('urls', 'lastChecks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->input('url');
        $validator = Validator::make($data, [
            'name' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('welcome')
                ->withErrors($validator)
                ->withInput();
        }

        $parsedUrl = parse_url($data['name']);
        $normalizedUrl = "{$parsedUrl['scheme']}://{$parsedUrl['host']}";

        $url = DB::table('urls')
            ->where('name', $normalizedUrl)
            ->first();

        if (is_null($url)) {
            $id = DB::table('urls')->insertGetId([
                    'name' => $normalizedUrl,
                    'created_at' => Carbon::now()->toString(),
                    'updated_at' => Carbon::now()->toString()
            ]);
            flash(__('messages.The page has been added successfully'))->success();
        } else {
            $id = $url->id;
            flash(__('messages.The page has already been added'))->success();
        }

        return redirect()->route('urls.show', ['url' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request, int $id)
    {
        $url = DB::table('urls')->find($id);

        abort_unless($url, 404);

        $urlChecks = DB::table('url_checks')
            ->where('url_id', $id)
            ->latest()
            ->paginate();

        return view('url.show', compact('url', 'urlChecks'));
    }
}
