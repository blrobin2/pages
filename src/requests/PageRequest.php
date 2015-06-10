<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PageRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        if(\Auth::user()) {
            return true;
        } else {
            return false;
        }
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
            'link' => 'required|alpha_dash',
            'body' => 'required',
            'hidden' => 'boolean',
		];
	}

}
