<?php

namespace Modules\Seven\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Renderable
    {
        return view('seven::settings');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Renderable
    {
        return view('seven::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Renderable
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show(int $id): Renderable
    {
        return view('seven::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Renderable
    {
        return view('seven::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): Renderable
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): Renderable
    {
        //
    }
}
