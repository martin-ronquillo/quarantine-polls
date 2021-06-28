<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result)
    {
    	$response = [
            'success'       => true,
            'data'          => $result
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    // public function sendError($error, $errorMessages = [], $code = 404)
    public function sendError($error, $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
            'code'    => $code
        ];


        // if(!empty($errorMessages)){
        //     $response['data'] = $errorMessages;
        // }


        return response()->json($response, $code);
    }
}