<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
		 'title' => 'required|min:3',
		 'body' => 'required|min:10',
		 'coverpic' => 'image|mimes:jpeg,bmp,png|min:5|max:5000'
		];
	}

}
