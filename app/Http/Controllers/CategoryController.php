<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Eloquent
        // $data = Category::all();
        $data = Category::with('user')->get();
        return response()->view('cms.categories.index', ['categories' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //SELECT * FROM users;
        //DB::table('users')->get();
        //User::all();
        $data = User::all();
        return response()->view('cms.categories.create', ['users' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $request->validate([]);
        $validator = Validator($request->all(), [
            'title' => 'required|string|max:30',
            'user_id' => 'required|numeric|exists:users,id',
            // 'active' => 'nullable|string|in:on',
            'active' => 'required|boolean',
        ]);

        if (!$validator->fails()) {
            $category = new Category();
            $category->title = $request->input('title');
            $category->user_id = $request->input('user_id');
            // $category->active = $request->has('active');
            $category->active = $request->input('active');
            $saved = $category->save();
            if ($saved) {
                //Success
                return response()->json(['message' => 'Category saved successfully', 'icon' => 'success'], Response::HTTP_CREATED);
            } else {
                //Save failed!
                return response()->json(['message' => 'Failed to save category', 'icon' => 'error'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            //Validation error
            return response()->json(['message' => $validator->getMessageBag()->first(), 'icon' => 'error'], Response::HTTP_BAD_REQUEST);
        }
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
        //
        $category = Category::findOrFail($id);
        $users = User::all();
        return response()->view('cms.categories.edit', ['category' => $category, 'users' => $users]);
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
        $validator = Validator($request->all(), [
            'user_id' => 'required|numeric|exists:users,id',
            'title' => 'required|string|max:45',
            'active' => 'required|boolean'
        ]);

        if (!$validator->fails()) {
            $category =  Category::findOrFail($id);
            $category->user_id = $request->input('user_id');
            $category->title = $request->input('title');
            $category->active = $request->input('active');
            $saved = $category->save();
            return response()->json(
                ['message' => $saved ? "Category updated successfully" : "Failed to update category"],
                $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //DELETE FROM categories WHERE id = 1;
        $deleted = Category::destroy($id);
        return response()->json(
            ['message' => $deleted ? "Category deleted successfully" : "Failed to delete category"],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
