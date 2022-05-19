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

    public function errorRess($status, $message, $data = null){
        return response()->json([
            'status' => $status,
            'code'   => '500',
            'message'=> $message,
            'data'   => $data
        ]);
    }
}
