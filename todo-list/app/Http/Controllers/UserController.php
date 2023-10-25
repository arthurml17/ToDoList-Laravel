<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        if($users){
            return response()->json(['data' => $users, 'status' => true]);
        }else{
            return response()->json(['data' => 'No registered users', 'status' => true]);
        }
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
    public function store(Request $request)
    {
        //
        $data = $request->all();
        return response()->json(['data' => $request, 'status' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
