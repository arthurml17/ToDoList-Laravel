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
        if(isset($data['name']) && isset($data['email']) && isset($data['email'])){
            
            if(count(User::where('email', $data['email'])->get()) > 0){
                return response()->json(['data' => 'Already exists an account with that email', 'status' => true], 200);
            }else{
                $user = User::create($data);
                if($user){
                    return response()->json(['data' => 'User added successfully', 'status' => true], 200);
                }else{
                    return response()->json(['data' => 'Failed to add User', 'status' => false], 500);
                }
            }
        }else{
            return response()->json(['data' => 'Invalid parameters', 'status' => false], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['data' => 'User don\'t exist', 'status' => true], 200);
        }else{
            return response()->json(['data' => $user, 'status' => true], 200);
        }
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
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['data' => 'User don\'t exist', 'status' => true], 200);
        }else{
            $user->delete();
            return response()->json(['data' => 'User deleted successfully', 'status' => true], 200);
        }
    }
}
