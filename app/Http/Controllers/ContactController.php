<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller {
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
    {
        return view('contact');
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	  public function store(ContactFormRequest $request)
	  {

	    \Mail::send('emails.contact',
		    array(
		        'name' => $request->get('name'),
		        'email' => $request->get('email'),
		        'user_message' => $request->get('message')
		    ), function($message)
		{
		    $message->from('k.setiya91@gmail.com');
		    $message->to('k.setiya91@gmail.com', 'Admin')->subject('UpNote Contactform');
		});
	    return \Redirect::route('contact')->withFlashmessage('Thanks for contacting us!');
	
	  }

	 

}
