<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;

trait ResponseTrait
{
    /**
     * Status code of response
     *
     * @var int
     */
    protected $statusCode = 200;


    /**
     * Getter for statusCode
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Send custom data response
     *
     * @param $status
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendCustomResponse($status, $message)
    {

        return response()->json(collect($message)->merge(['status'=>$status]), $status);
    }

    /**
     * Send this response when api user provide fields that doesn't exist in our application
     *
     * @param $errors
     * @return mixed
     */
    public function sendUnknownFieldResponse($errors)
    {
        return response()->json((['status' => 400, 'error' => $errors]), 400);
    }

    /**
     * Send this response when api user provide filter that doesn't exist in our application
     *
     * @param $errors
     * @return mixed
     */
    public function sendInvalidFilterResponse($errors)
    {
        return response()->json((['status' => 400, 'error' => $errors]), 400);
    }

    /**
     * Send this response when api user provide incorrect data type for the field
     *
     * @param $errors
     * @return mixed
     */
    public function sendInvalidFieldResponse($errors)
    {
        return response()->json((['status' => 400, 'error' => $errors]), 400);
    }

    /**
     * Send this response when a api user try access a resource that they don't belong
     *
     * @return string
     */
    public function sendForbiddenResponse()
    {
        return response()->json(['status' => 403, 'error' => __('response.forbidden')], 403);
    }

    /**
     * Send 404 not found response
     *
     * @param string $message
     * @return string
     */
    public function sendNotFoundResponse($message = '')
    {
        if ($message === '') {
            $message = __('response.resource_not_found');
        }

        return response()->json(['status' => 404, 'error' => $message], 404);
    }

    /**
     * Send 401 Unauthorized response
     *
     * @param string $message
     * @return string
     */
    public function sendUnauthorizedResponse($message = '')
    {
        if ($message === '') {
            $message = __('response.unauthorised');
        }

        return response()->json(['status' => 401, 'error' => $message], 401);
    }

    /**
     * Send 500 Unauthorized response
     *
     * @param string $message
     * @return string
     */
    public function sendNotAddedResponse($message = '')
    {
        if ($message === '') {
            $message = __('response.resource_not_added');
        }

        return response()->json(['status' => 500, 'error' => $message], 500);
    }

    /**
     * Send empty data response
     *
     * @return string
     */
    public function sendEmptyDataResponse()
    {
        return response()->json(['data' => new \StdClass()]);
    }

    /**
     * validation
     * @param array $data
     * @param array $rules
     * @return \Illuminate\Http\JsonResponse
     */
    public function toValidate(array $data, array $rules)
    {
        //check if user has post and comments
        $validator = Validator::make($data, $rules);
        // Send failed response if validation fails
        if ($validator->fails()) {
            return $this->sendInvalidFieldResponse($validator->errors());
        }
    }
}
