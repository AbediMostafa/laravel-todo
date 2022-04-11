<?php

/**
 * Execute callback function inside try catch blocks
 * and return given error or success message
 */
if (!function_exists('tryCatch')) {
    function tryCatch($callBack, $error, $success, $additionalArray = []): \Illuminate\Http\JsonResponse
    {
        try {
            $callBack();
            $successArray = [
                'status' => 1,
                'msg' => $success
            ];

            return empty($additionalArray) ?
                response()->json($successArray) :
                response()->json(array_merge($successArray, $additionalArray));

        } catch (Exception $e) {

            return response()->json([
                'status' => 0,
                'msg' => $error
            ]);
        }

    }
}

/**
 * Return json success response
 */
if (!function_exists('successJson')) {
    function successJson($msg, $additional = []): \Illuminate\Http\JsonResponse
    {
        $successArray = [
            'status' => 1,
            'msg' => $msg
        ];

        return empty($additional) ?
            response()->json($successArray) :
            response()->json(array_merge($successArray, $additional));
    }
}

/**
 * Return json error response
 */
if (!function_exists('errorJson')) {
    function errorJson($msg): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 0,
            'msg' => $msg
        ]);
    }
}
