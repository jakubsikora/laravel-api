<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response as IlluminateResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller {

    /**
     * [$statusCode description]
     * @var [type]
     */
    protected $statusCode = Response::HTTP_OK;

    /**
     * [getStatusCode description]
     * @return [type] [description]
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * [setStatusCode description]
     * @param [type] $statusCode [description]
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * [respondUnauthorized description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondUnauthorized($message = 'Unauthorized!')
    {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)
                    ->respondWithError($message);
    }

    /**
     * [respondNotFound description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)
                    ->respondWithError($message);
    }

    /**
     * [respondUnprocessableEntity description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondUnprocessableEntity($message = 'UnprocessableEntity!')
    {
        return $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
                    ->respondWithError($message);
    }

    /**
     * [respondNotFound description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
                    ->respondWithError($message);
    }

    /**
     * [respondCreated description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondCreated($message)
    {
        return $this->setStatusCode(Response::HTTP_CREATED)
                    ->respond(['message' => $message]);
    }

    /**
     * [respond description]
     * @param  [type] $data    [description]
     * @param  array  $headers [description]
     * @return [type]          [description]
     */
    public function respond($data, $headers = [])
    {
        return IlluminateResponse::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * [respondWithError description]
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }
}