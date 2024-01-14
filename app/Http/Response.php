<?php

namespace App\Http;

class Response
{
    public static function json(mixed $data, int $code = 200, string $status = "success"): \Illuminate\Http\JsonResponse
    {
        $data = [
            "status" => $code !== 200 ? "error" : "success",
            "data" => $data
        ];

        return response()->json($data, $code);
    }
}
