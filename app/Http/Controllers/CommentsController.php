<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateCommentRequest $request)
	{
	 
	 if(\Auth::guest()){
		return redirect('auth/login');
	 }
		$comment = Comment::create($request->all());
		
		$comment->author = \Auth::user()->name;
		$comment->user_id = \Auth::user()->id;
		 
		$comment->upvotes= 0;
		
		$comment->save();

		return redirect('posts');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$comment = Comment::find($id);
		$comment->delete();
		
		return redirect('posts');
		
	}

}
