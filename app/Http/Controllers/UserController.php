<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Query On Database - Table (Users);
        //1: Eloquent (Model)
        // $data = User::all();
        $data = User::withCount('categories')->get();
        // $data = User::where('id', '>', 5)->get();

        //2: Query Builder
        // $data = DB::table('users')->get();

        //3: SQL
        // $data = DB::select('SELECT * FROM users');
        return response()->view('cms.users.index', ['users' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->all()
        //970599123123
        $request->validate([
            'user_name' => 'required|string|min:3|max:20',
            'user_email' => 'required|string|email|unique:users,email',
            'user_mobile' => 'required|numeric|digits:12',
            'user_address' => 'nullable|string|max:100',
            'user_password' => [
                'required', 'string',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->mixedCase()
                    ->uncompromised()
            ]
        ]);

        //1: Eloquent
        $user = new User();
        $user->name = $request->input('user_name');
        $user->email = $request->input('user_email');
        $user->mobile = $request->input('user_mobile');
        $user->address = $request->input('user_address');
        $user->password = Hash::make($request->input('user_password'));
        $saved = $user->save();

        //2: Query Builder
        // $saved = DB::table('users')->insert([
        //     'name' => $request->input('user_name'),
        //     'email' => $request->input('user_email'),
        //     'password' => Hash::make($request->input('user_password')),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        //3: SQL
        // $saved = DB::insert(
        //     'INSERT INTO users (name, email, password, created_at, updated_at) VALUES (?,?,?,?,?)',
        //     [
        //         $request->input('user_name'),
        //         $request->input('user_email'),
        //         Hash::make($request->input('user_password')),
        //         now(),
        //         now(),
        //     ]
        // );

        // return redirect()->back();
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //SQL: SELECT * FROM users WHERE id = 1;
        //Eloquent:
        // $user = User::find($id);
        // $user = User::findOrFail($id);

        //Query Builder:
        // $user = DB::table('users')->find($id);

        //SQL
        $user = DB::selectOne("SELECT * FROM users WHERE id = ?", [$id]);
        return response()->view('cms.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'user_name' => 'required|string|min:3|max:20',
            'user_email' => 'required|string|email|unique:users,email,' . $id,
            'user_address' => 'nullable|string|max:100',
            'user_password' => [
                'nullable', 'string',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->mixedCase()
                    ->uncompromised()
            ]
        ]);

        //Eloquent:
        // $user = User::find($id);
        $user = User::findOrFail($id);
        $user->name = $request->input('user_name');
        $user->email = $request->input('user_email');
        $user->address = $request->input('user_address');
        if ($request->has('user_password')) {
            $user->password = Hash::make($request->input('user_password'));
        }
        $saved = $user->save();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //Eloquent:
        // $user = User::find($id);
        // $user = User::findOrFail($id);
        // $deleted = $user->delete();

        //Eloquent
        // $deleted = User::destroy($id);
        // return redirect()->back();

        //Query Builder:
        //DELETE FROM users WHERE id = ?;
        // $deleted = DB::table('users')->where('id', '=', $id)->delete();
        //DELETE FROM users;
        // $deleted = DB::table('users')->delete();
        //DELETE FROM users WHERE id = ?;
        // $deleted = DB::table('users')->delete($id);
        // return redirect()->back();

        //SQL:
        $deleted = DB::delete('DELETE FROM users WHERE id = ?', [$id]);
        return redirect()->back();
    }
}
