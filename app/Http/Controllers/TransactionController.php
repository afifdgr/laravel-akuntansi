<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
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
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
