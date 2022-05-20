<?php
namespace App\Services;

class ResService{

    public function successRess($status, $message, $data = ''){
        return response()->json([
            'status' => $status,
            'code'   => '200',
            'message'=> $message,
            'data'   => $data

        ]);
    }

    public function errorRess($status, $message, $data = null, $code = 500){
        return response()->json([
            'status' => $status,
            'code'   => $code,
            'message'=> $message,
            'data'   => $data
        ]);
    }
}
