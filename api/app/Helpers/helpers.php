<?php
use Carbon\Carbon;

class Helpers 
{
    public static function collection($data, $code = null, $message = null)
    {
        $code = $code ?? 200;
        $collection = new \stdClass();
        $collection->data = $data;
        $collection->message = $message ?? "";
        return response()->json($collection, $code);
    }
}