<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class AsetController extends Controller
{
    public function bank()
    {
        $bank = Bank::all();
        return response()->json([
            'message' => $bank
        ], 201);
    }

    public function provinsi()
    {
        $provinces = Province::all();
        // $regencies = Regency::all();
        // $provinces = 'ACEH';
        // $provinces = Province::where('name', 'ACEH')->first();
        // $regencies = $provinces->regencies;
        return response()->json([
            'message' => $provinces
        ], 201);
    }

    public function kota(Request $request)
    {
        $provinces = Province::where('name', $request->provinsi)->first();
        $regencies = $provinces->regencies;
        return response()->json([
            'message' => $regencies
        ], 201);
    }

    public function kecamatan(Request $request)
    {
        // $regency = Regency::where('name', $request->kota)->first();
        $regencies = Regency::where('name', 'LIKE', $request->kota)->first();
        $districts = $regencies->districts;
        return response()->json([
            'message' => $districts
        ], 201);
    }

    public function desa(Request $request)
    {
        $regency = District::where('name', $request->kecamatan)->first();
        $villages = $regency->villages;
        return response()->json([
            'message' => $villages
        ], 201);
    }
}
