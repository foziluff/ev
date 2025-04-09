<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Station\GetStationsInRadiusRequest;
use App\Http\Requests\Station\SearchStationsRequest;
use App\Http\Requests\Station\StoreStationRequest;
use App\Http\Requests\Station\UpdateStationRequest;
use App\Services\StationService;
use Illuminate\Http\JsonResponse;

class StationController extends Controller
{
    public function __construct(
        readonly private StationService $stationService,
    ){
        parent::__construct();
    }

    /**
     * Display a listing of the resource in the radius.
     */
    public function getInRadius(GetStationsInRadiusRequest $request): JsonResponse
    {
        return response()->json($this->stationService->getInRadius($request->validated()));
    }

    /**
     * Display a listing of the resource in the radius.
     */
    public function search(SearchStationsRequest $request): JsonResponse
    {
        return response()->json($this->stationService->search($request->validated(), 20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStationRequest $request): JsonResponse
    {
        return response()->json($this->stationService->create($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->stationService->getOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStationRequest $request, int $id): JsonResponse
    {
        return response()->json($this->stationService->update($id, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->stationService->delete($id)
            ? response()->json(['message' => 'Successfully deleted!'])
            : response()->json(['message' => 'Not found!'], 404);
    }
}
