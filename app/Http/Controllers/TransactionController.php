<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::orderBy('time', 'DESC')->get();
        $response = [
            'message' => 'List transaction order by time',
            'data' => $transaction
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'amount' => ['required', 'numeric'],
            'type' => ['required', 'in:expense,revenue']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $transaction = Transaction::create($request->all());
            $response = [
                'message' => 'Transaction Created',
                'data' => $transaction
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'amount' => ['required', 'numeric'],
            'type' => ['required', 'in:expense,revenue']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $transaction->update($request->all());
            $response = [
                'message' => 'Transaction Updated',
                'data' => $transaction
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo,
            ]);
        }
    }

    public function destroy($id)
    {
        //
    }
}
