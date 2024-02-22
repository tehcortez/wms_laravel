<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLineItemRequest;
use App\Http\Requests\UpdateLineItemRequest;
use App\Models\LineItem;

class LineItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLineItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LineItem $lineItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LineItem $lineItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLineItemRequest $request, LineItem $lineItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LineItem $lineItem)
    {
        //
    }
}
