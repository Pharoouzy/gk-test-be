<?php


namespace App\Helpers;


trait RequestHelper {

    protected function response($message, $data = [], $status_code = 200) {
        $general_data = !empty($data) ? array_merge(['message' => $message], ['data' => $data]) : ['message' => $message];

        return response()->json($general_data, $status_code);
    }
}
