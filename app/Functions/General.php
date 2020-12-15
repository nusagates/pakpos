<?php
if (!function_exists('api_response')) {
    function api_response($code = 205, $data = [], $message = "")
    {
        return response()->json(["code"=>$code, "data"=>$data, "message"=>$message]);
    }
}
