<?php

namespace App\Http\Requests;

use App\Trait\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiFormRequest extends FormRequest
{
    use ApiResponseTrait;
   public function failedValidation(Validator $validator)
   {
      throw new HttpResponseException(
        $this->errorResponse($validator->errors(),422)
      );
   }
}
