<?php

namespace App\Http\Controllers;

use App\Models\HttpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HttpRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('module.request.index');
        $response = Http::get('http://skutik.com');
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Client\Response
     */
    public function store(Request $request)
    {
        if (is_null($request->Url)) return api_response(201, [], 'URL is required');
        $body = [];
        $header = [];
        foreach ($request->Body as $item) {
            if (!is_null($item['key'])) {
                $body[$item['key']] = $item['value'];
            }
        }
        foreach ($request->Header as $item) {
            if (!is_null($item['key'])) {
                $header[$item['key']] = $item['value'];
            }
        }

        //return $header;
        //return $body;
        switch ($request->Method) {
            case 'get':
                return $response = Http::get($request->Url, $body);
            case 'post':
                if (empty($header)) {
                    return $response = Http::post($request->Url, $body);
                } else {
                    return Http::withHeaders($header)->post($request->Url, $body);
                }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\HttpRequest $httpRequest
     * @return \Illuminate\Http\Response
     */
    public function show(HttpRequest $httpRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\HttpRequest $httpRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(HttpRequest $httpRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HttpRequest $httpRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HttpRequest $httpRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\HttpRequest $httpRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(HttpRequest $httpRequest)
    {
        //
    }
}
