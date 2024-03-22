<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use App\Models\User;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

class TalentController extends Controller
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

        $messages = [
            'nik.required' => 'Kolom nik wajib diisi.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'namaL.required' => 'nama lengkap belum terisi.',
            'namaP.required' => 'nama panggilan belum terisi.',
            'gender.required' => 'jenis kelamin belum terisi.',
            'noHP.required' => 'no WhatsApp belum terisi.',
            'alamat_KTP.required' => 'alamat ktp belum terisi.',
            'alamat_domisili.required' => 'alamat_domisili belum terisi.',
            'pendidikan_terakhir.required' => 'kolom pendidikan terakhir belum terisi.',
            'status_pekerjaan.required' => 'status pekerjaan belum terisi.',
            'jenis_pekerjaan_yang_diminati.required' => 'jenis pekerjaan yang diminati belum terisi.',
            'skill_1.required' => 'Tech Stack 1 belum terisi.',
            'skill_1_waktu.required' => 'Lama Pengalaman Kerja belum terisi.',
            'skill_2.required' => 'Tech Stack 2 belum terisi.',
            'skill_2_waktu.required' => 'Lama Pengalaman Kerja belum terisi.',
            'level.required' => 'tingkat anda belum terisi.',
            'waktu_assign.required' => 'waktu assign belum terisi.',
            'linkedin.required' => 'linkedin belum terisi.',
            'github.required' => 'github belum terisi.',
            'kodepos.required' => 'kodepos belum terisi.',
            'password.required' => 'password belum terisi.',
        ];
        
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'email' => 'required|email|max:255',
            'namaL' => 'required',
            'namaP' => 'required',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'noHP' => 'required|min:12|max:13',
            'alamat_KTP' => 'required',
            'alamat_domisili' => 'required',
            'pendidikan_terakhir' => 'required',
            'status_pekerjaan' => 'required',
            'jenis_pekerjaan_yang_diminati' => 'required|in:Freelance,Fulltime Remotely,Fulltime Onsite,Hybrid',
            'skill_1' => 'required',
            'skill_1_waktu' => 'required',
            'skill_2' => 'required',
            'skill_2_waktu' => 'required',
            'level' => 'required|in:Mid-Level,Senior,Junior,Rockstar',
            'waktu_assign' => 'required',
            'linkedin' => 'required',
            'github' => 'required',
            'cv' => 'required|mimes:jpeg,jpg,png,docx,doc,pdf',
            'hunter' => 'required',
            'password' => 'required|min:6|confirmed',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $user = Talent::create([
                'nik' => $request->nik,
                'email' => $request->email,
                'namaL' => $request->namaL,
                'namaP' => $request->namaP,
                'gender' => $request->gender,
                'noHP' => $request->noHP,
                'alamat_KTP' => $request->alamat_KTP,
                'alamat_domisili' => $request->alamat_domisili,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'status_pekerjaan' => $request->status_pekerjaan,
                'jenis_pekerjaan_yang_diminati' => $request->jenis_pekerjaan_yang_diminati,
                'skill_1' => $request->skill_1,
                'skill_1_waktu' => $request->skill_1_waktu,
                'skill_2' => $request->skill_2,
                'skill_2_waktu' => $request->skill_2_waktu,
                'level' => $request->level,
                'waktu_assign' => $request->waktu_assign,
                'linkedin' => $request->linkedin,
                'github' => $request->github,
                'cv' => $request->cv,
            'hunter' => $request->hunter,
            'password' => $request->password,
        ]);

        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
        ], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Talent $talent, $ID_referral)
    {
        $hunter = User::where('ID_referral', $ID_referral)->first();
        $data = json_decode($hunter, true);
        $huntid = $hunter->user;
        return response()->json([
            'user' => $data['namaL'],
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Talent $talent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Talent $talent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Talent $talent)
    {
        //
    }
}
// eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MTA2NDU1ODcsImV4cCI6MTcxMDY0OTE4NywibmJmIjoxNzEwNjQ1NTg3LCJqdGkiOiJxbFlHQ2NsbUFvQU05eXlQIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.FL9fINPhrEBrTqDS-zvR2F2hBxpN-ytgOABrplASbrA
// {
//     "nik" : "1234567890123456",
//     "email" : "kenzibadrika@gmail.com",
//     "namaL" : "kenzi Badrika",
//     "namaP" : "Kenzi",
//     "gender" : "L",
//     "noHP" : "085174337673",
//     "alamat_KTP" : "Cipaok",
//     "alamat_domisili" : "bandung",
//     "pendidikan_terakhir" : "sma",
//     "status_pekerjaan" : "magang",
//     "jenis_pekerjaan_yang_diminati" : "Freelance",
//     "skill_1" : "laravel",
//     "skill_1_waktu" : "1 tahun",
//     "skill_2" : "ReactJS",
//     "skill_2_waktu" : "2 bulan",
//     "level" : "Junior",
//     "waktu_assign" : "2024-03-17",
//     "linkedin" : "kenzi badrika",
//     "github" : "kenzi09",
//     "cv" : "hj.jpg",
//     "hunter_id" : "2",
//     "password" : "kenken12",
//     "password_confirmation" : "kenken12"
// }