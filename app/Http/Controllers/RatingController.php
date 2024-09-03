<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Services\RatingService;
use Illuminate\Http\Response;

class RatingController extends Controller
{
    protected $ratingService;
/**
     * constractor to inject ratingService  class
     * @param RatingService $ratingService
     */ 
    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }
    /**
     * index all rating
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $ratings = $this->ratingService->getRatings();
        return response()->json(['data' => $ratings], Response::HTTP_OK);
    }
    /**
     * store rating
     * @param RatingRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(RatingRequest $request)
    {
        $data = $request->validated();
        $rating = $this->ratingService->createRating($data);
        return response()->json(['data' => $rating], Response::HTTP_CREATED);
    }
    /**
     * update the rating
     * @param RatingRequest $request
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(RatingRequest $request, $id)
    {
        $data = $request->validated();
        $rating = $this->ratingService->updateRating($id, $data);
        return response()->json(['data' => $rating], Response::HTTP_OK);
    }
    /**
     * delet the rating
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $rating = $this->ratingService->deleteRating($id);
        return response()->json(['data' => $rating], Response::HTTP_OK);
    }
}
