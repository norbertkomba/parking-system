<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WebController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function delete_data(Request $request)
    {
        try {
            if ($request->ajax()) {
                if (Schema::hasTable($request->table)) {
                    DB::table($request->table)->where('id',$request->data)->delete();
                    return response()->json(JsonResponse::HTTP_OK);
                }
                return response()->json(JsonResponse::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function change_status($table,$data,$column,$status)
    {
        try {
            if (Schema::hasTable($table)) {
                DB::table($table)->where('id',$data)->update([$column=>$status]);
                return response()->json(JsonResponse::HTTP_OK);
            }

            return response()->json(JsonResponse::HTTP_NOT_FOUND);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
