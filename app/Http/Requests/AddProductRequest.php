<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Request;

class AddProductRequest extends Request
{

    use ApiRequestsTrait;
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

            'slug' => 'required',
            'detail'  => 'required|min:3',
            'featured_image'  => 'image|mimes:jpg,png,gif',
            'other_image.*'  => 'image|mimes:jpg,png,gif',
            //'status'  => 'boolean',
        ];
    }

    public function response(array $errors)
    {
        $response = $this->validationApiError($errors);
        return Response::json($response, 422);
    }
}
