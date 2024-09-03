<?php

namespace App\Http\Controllers;

use App\Models\Borrow_records;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use App\Models\Book;
use App\Services\BorrowService;
use App\Http\Requests\BorrowRequest;
class BorrowRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $borrowService;
/**
     * constractor to inject BorrowServic class
     * @param BorrowService $borrowService
     */ 
    public function __construct(BorrowService $borrowService)
    {
        $this->borrowService = $borrowService;
    }
    /**
     * index all borrowrecords
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $borrowRecords = $this->borrowService->getBorrowRecords();
        return response()->json(['data' => $borrowRecords], 200);
    }

    public function show($id)
    {
        $borrowRecord = $this->borrowService->getBorrowRecords();
        return response()->json(['data' => $borrowRecord], 200);
    }
    /**
     * Store to the database
     * @param BorrowRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(BorrowRequest $request)
    {
        $borrowRecord = $this->borrowService->createBorrowRecord($request->validated());
        return response()->json(['data' => $borrowRecord, 'message' => 'تمت إضافة سجل الاستعارة بنجاح.'], 201);
    }
    /**
     *update the borrowrecord
     * @param mixed $id
     * @paramBorrowRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update($id,BorrowRequest $request)
    {
        $borrowRecord = $this->borrowService->updateBorrowRecord($id, $request->validated());
        return response()->json(['data' => $borrowRecord, 'message' => 'تم تحديث سجل الاستعارة بنجاح.'], 200);
    }

    public function destroy($id)
    {
        $borrowRecord = $this->borrowService->deleteBorrowRecord($id);
        return response()->json(['data' => $borrowRecord, 'message' => 'تم حذف سجل الاستعارة بنجاح.'], 200);
    }
}