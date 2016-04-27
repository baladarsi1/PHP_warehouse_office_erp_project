<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('emails.auth.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{

		switch ($response = Password::remind(Input::only('email') , function($message) {
			$message->subject('Project Visa Password Reminder');
		}))
		{

			case Password::INVALID_USER:
				//return Redirect::back()->with('error', Lang::get($response));
				return Redirect::back()->withErrors(['error', Lang::get($response)]);

			case Password::REMINDER_SENT:
				//return Redirect::back()->with('status', Lang::get($response));
				//return Redirect::back()->withErrors(['status', Lang::get($response)]);
				//return Redirect::back()->withErrors(['error', Lang::get($response)]);
				return Redirect::back()->with('status', Lang::get($response));
		}


	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('emails.auth.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				//return Redirect::back()->with('error', Lang::get($response));
			return Redirect::back()->withErrors(['error', Lang::get($response)]);

			case Password::PASSWORD_RESET:
				//return Redirect::to('/');
				return Redirect::back()->with('status', Lang::get($response));
		}
	}

}
