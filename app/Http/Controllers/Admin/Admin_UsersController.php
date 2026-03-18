<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;


class Admin_UsersController extends Controller
{
    public function index()
    {
        $listOfUsers = User::where("user_type", "user")->get();

        return $this->renderAdminViewPage(
            'Administrator.UsersManagement.index',
            'Users Management',
            ['ListOfUsers' => $listOfUsers]
        );
    }

public function store(Request $request)
{
    $request->validate([
        "name" => "required",
        "email" => "required|email|unique:users",
        "password" => "required|min:6"
    ]);

    $user = User::create([
        "name" => $request->name,
        "email" => $request->email,
        "password" => bcrypt($request->password),
        "user_type" => "user"
    ]);

    return response()->json($user);
}

public function edit($id)
{
    return response()->json(User::findOrFail($id));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        "name" => "required",
        "email" => "required|email|unique:users,email,".$id,
    ]);

    $user->update([
        "name" => $request->name,
        "email" => $request->email
    ]);

    return response()->json($user);
}

public function destroy($id)
{
    User::findOrFail($id)->delete();
    return response()->json(["success" => true]);
}

}
