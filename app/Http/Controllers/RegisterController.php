<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;




class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->renderViewerPage('register', 'Register');
    }
       public function submit(Request $request){
        $data = $request->all();
        $username = $data['name'];
        $data['user_type'] = 'user';
        $password = $data['password'];
        $data['password'] = bcrypt($password);
        $email = $data['email'];

        $newUser = User::createOrFirst([
            'name' => $username,
            'email' => $email,
            'user_type' => 'user',
            'password' => $data['password'],
        ]);
        $ud = UserDetail::createOrFirst([
                    'user_id'=>$newUser->id,
        'full_name'=>$newUser->name,
        'email'=>$newUser->email,
        'phone'=>9856457184,
        'address'=>"jtm",
        'city'=>"jtm"
        ]);

        // dd($newUser,$ud);

        if (!$newUser->wasRecentlyCreated) {
            return response()->json(['message' => 'Email already exists. Please use a different email.'], 400);
        }

        return response()->json(['message' => 'Registration successful!'], 200);

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
    }

    /**
     * Display the specified resource.
     */
    public function show(Register $register)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Register $register)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Register $register)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Register $register)
    {
        //
    }
}
