<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\rand;
use Illuminate\Support\random;
use Carbon\Carbon;

class HunterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hunter $hunter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hunter $hunter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hunter $hunter)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function history(Request $request)
    {
        $tanggal = Carbon::now()->format('Y-m-d H:i');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function login(Request $request)
    {
        $gmail = $request->email;
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email atau Password yang Anda masukkan tidak valid.'], 401);
        }

        $history = User::where('email', $gmail)->first();
        $data = json_decode($history, true);

        History::create([
            'hunter' => $data['namaL'],
            'hunter_email' => $data['email'],
        ]);


        return response()->json([
            'message' => 'Login Berhasil!',
            'token' => $token,
            'type' => 'bearer',
            'expires_in' => 0
        ]);

        $this->history($event->request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function show(User $user)
    {
        // Tampilkan data user
        // return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function register(Request $request)
    {

        $messages = [
            'nik.required' => 'Kolom nik wajib diisi.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'namaL.required' => 'nama lengkap belum terisi.',
            'namaP.required' => 'nama panggilan belum terisi.',
            'gender.required' => 'jenis kelamin belum terisi.',
            'noHP.required' => 'no WhatsApp belum terisi.',
            'ig.required' => 'instagram belum terisi.',
            'nama_perusahaan_saat_ini.required' => 'kolom nama perusahaan belum terisi.',
            'bidang_pekerjaan.required' => 'kolom bidang pekerjaan belum terisi.',
            'rekening.required' => 'rekening belum terisi.',
            'nama_bank.required' => 'nama bank belum terisi.',
            'atas_nama_rekening.required' => 'atas nama rekening belum terisi.',
            'provinsi.required' => 'provinsi belum terisi.',
            'kota.required' => 'kota belum terisi.',
            'kecamatan.required' => 'kecamatan belum terisi.',
            'desa.required' => 'desa belum terisi.',
            'jalan.required' => 'jalan belum terisi.',
            'kodepos.required' => 'kodepos belum terisi.',
            'password.required' => 'password belum terisi.',
        ];

        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:users,nik',
            'email' => 'required|email|max:255|unique:users,email',
            'namaL' => 'required',
            'namaP' => 'required',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'noHP' => 'required|numeric|min:11',
            'ig' => 'required',
            'nama_perusahaan_saat_ini' => 'required',
            'bidang_pekerjaan' => 'required',
            'rekening' => 'required|min:10',
            'nama_bank' => 'required',
            'atas_nama_rekening' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'jalan' => 'required',
            'kodepos' => 'required|numeric|min:5',
            'password' => 'required|min:6|confirmed',
            'ID_referral' => '',
        ], $messages);

        $email = $request->email;

        $email_first_3_letters = substr($email, 0, 3);

        static $randomNumber;

                for ($i = 0; $i<6; $i++) 
            {
                $num = mt_rand(0,9);
                $randomNumber = $randomNumber . $num;
            }

        $ID_referral = $email_first_3_letters . $randomNumber;

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $nama_bank = $request->nama_bank;
        $rekening = $request->rekening;
        $atas_nama_rekening = $request->atas_nama_rekening;
        
        $bank = $nama_bank . '-' . $rekening . '( ' . $atas_nama_rekening . ' )';

        $provinsi = $request->provinsi;
        $kota = 'kota/kab ' . $request->kota;
        $kecamatan = 'kec ' . $request->kecamatan;
        $desa = 'desa ' . $request->desa;
        $jalan = $request->jalan;
        $kodepos = $request->kodepos;
        
        $alamat = implode(", ", [$jalan, $desa, $kecamatan, $kota, $provinsi, $kodepos]);

        // $alammat = $jalan . ' ' . $


        $user = User::create([
            'nik' => $request->nik,
            'email' => $request->email,
            'namaL' => $request->namaL,
            'namaP' => $request->namaP,
            'gender' => $request->gender,
            'alamat' => $alamat,
            'noHP' => $request->noHP,
            'ig' => $request->ig,
            'nama_perusahaan_saat_ini' => $request->nama_perusahaan_saat_ini,
            'bidang_pekerjaan' => $request->bidang_pekerjaan,
            'rekening' => $bank,
            'password' => $request->password,
            'ID_referral' => $ID_referral,
        ]);

        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
        ], 201);

    }
}
// {
//     "nik" : "1234567890123456",
//     "email" : "kenzibadrika@gmail.com",
//     "namaL" : "kenzi Badrika",
//     "namaP" : "Kenzi",
//     "gender" : "L",
//     "noHP" : "085174337673",
//     "ig" : "kenzbdr_",
//     "nama_perusahaan_saat_ini" : "next",
//     "bidang_pekerjaan" : "web dev",
//     "rekening" : "1234567890",
//     "nama_bank" : "BRI",
//     "atas_nama_rekening" : "KENZI BADRIKA",
//     "kota" : "bogor",
//     "provinsi" : "jawa barat", 
//     "kecamatan" : "ciawi", 
//     "desa" : "cileungsi", 
//     "jalan" : "cipaok", 
//     "kodepos" : "16720", 
//     "password" : "kenken12", 
//     "password_confirmation" : "kenken12"
// }