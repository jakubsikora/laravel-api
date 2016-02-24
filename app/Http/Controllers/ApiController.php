<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller {

    /**
     * [$statusCode description]
     * @var [type]
     */
    protected $statusCode = 200;

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
        return $this->setStatusCode(401)->respondWithError($message);
    }

    /**
     * [respondNotFound description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * [respondNotFound description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * [respond description]
     * @param  [type] $data    [description]
     * @param  array  $headers [description]
     * @return [type]          [description]
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

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