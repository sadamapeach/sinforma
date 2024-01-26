<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\Mentor;
use App\Models\Admin;
use App\Models\SKL;
use App\Models\Absen;
use App\Models\Progress;
use App\Models\Nilai;
use App\Models\User;
use App\Models\GeneratedAbsen;
use App\Models\GeneratedProgress;
use Carbon\Carbon;
use PDF;

class MahasiswaController extends Controller
{
    public function index(Request $request) 
    {
        $user = Auth::user();

        if($user->mahasiswa) {
            $id_mhs = $request->user()->mahasiswa->id_mhs;
            $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
                ->leftJoin('mentor', 'mahasiswa.nip_mentor', '=', 'mentor.nip')
                ->where('mahasiswa.id_mhs', $id_mhs)
                ->select(
                    'mahasiswa.nama',
                    'mahasiswa.jurusan',
                    'mahasiswa.instansi',
                    'mahasiswa.no_telepon',
                    'mahasiswa.email',
                    'mahasiswa.mulai_magang',
                    'mahasiswa.selesai_magang',
                    'mahasiswa.status',
                    'mentor.nama as mentor_nama',
                )
                ->first();

            $skl = SKL::join('mahasiswa', 'skl.id_mhs', '=', 'mahasiswa.id_mhs')
                ->where('skl.id_mhs', $id_mhs)
                ->select(
                    'skl.file_skl'
                )
                ->first();

            return view('mahasiswa.dashboard', compact('mahasiswa', 'skl'));
        }
    }

    public function form(Request $request) 
    {
        $user = Auth::user();
        $id_mhs = $request->user()->mahasiswa->id_mhs;
        $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
                        ->where('id_mhs', $id_mhs)
                        ->select('mahasiswa.nama', 'mahasiswa.id_mhs', 'mahasiswa.jurusan', 'mahasiswa.instansi')
                        ->first();
        return view('mahasiswa.form', compact('mahasiswa', 'user'));
    }

    public function store(Request $request) 
    {
        $user = $request->user();

        $validated = $request->validate([
            'alamat' => 'required',
            'no_telepon' => 'required|numeric',
            'email' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // dd('sss');

        DB::beginTransaction();

        try {
            if($request->has('foto')) {
                $imageName = $request->file('foto')->store('images', 'public');
                $validated['foto'] = $imageName;

                $user->update([
                    'foto' => $validated['foto']
                ]);
            }

            // Update data mahasiswa
            // Kiri database | Kanan id/name di form
            Mahasiswa::where('id_user', $user->id)->update([
                'alamat' => $validated['alamat'],
                'no_telepon' => $validated['no_telepon'],
                'email' => $validated['email'],
            ]);

            Mahasiswa::where('id_user', $user->id)->update([
                'check_profil' => 1,
            ]);

            DB::commit();

            return redirect()->route('dashboard_mahasiswa')->with('success', 'Data berhasil diinputkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('form_mahasiswa')->with('error', 'Gagal mengupdate data!');
        }
    }

    public function profile(Request $request) 
    {
        $user = Auth::user();

        $id_mhs = $request->user()->mahasiswa->id_mhs;
        $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->where('mahasiswa.id_mhs', $id_mhs)
            ->select(
                'mahasiswa.nama',
                'mahasiswa.jurusan',
                'mahasiswa.instansi',
                'mahasiswa.id_mhs',
                'mahasiswa.no_telepon',
                'mahasiswa.email',
                'mahasiswa.alamat',
                'users.username as username',
            )
            ->first();

        return view('mahasiswa.profile', compact('mahasiswa'));
    }

    public function edit_profile(Request $request) 
    {
        $user = $request->user();
        $id_mhs = $request->user()->mahasiswa->id_mhs;
        $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->where('mahasiswa.id_mhs', $id_mhs)
            ->select(
                'mahasiswa.nama',
                'mahasiswa.jurusan',
                'mahasiswa.instansi',
                'mahasiswa.id_mhs',
                'mahasiswa.no_telepon',
                'mahasiswa.email',
                'mahasiswa.alamat',
                'users.username as username',
            )
            ->first();

        return view('mahasiswa.edit_profile', compact('mahasiswa', 'user'));
    }

    public function update_profile(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();
    
        $validated = $request->validate([
            'username' => 'required',
            'no_telepon' => 'required|numeric',
            'email' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);
    
        if ($request->has('foto')) {
            $fotoPath = $request->file('foto')->store('images', 'public');
            $validated['foto'] = $fotoPath;
            $user->foto = $validated['foto'];
        }
    
        $user->username = $request->username;
        $mahasiswa->no_telepon = $request->no_telepon;
        $mahasiswa->email = $request->email;
        $mahasiswa->alamat = $request->alamat;
    
        $userChanged = $user->isDirty();
        $mahasiswaChanged = $mahasiswa->isDirty();
    
        if ($mahasiswa->save() && $user->save()) {
            if ($userChanged || $mahasiswaChanged) {
                return redirect()->back()->with('success', 'Personal information updated successfully!');
            } else {
                return redirect()->back()->with('info', 'No changes made.');
            }
        } else {
            return redirect()->back()->with('info', 'Failed to update personal information.');
        }
    }     
    
    public function change_password(Request $request)
    {
        // Check old password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error1', 'Password lama salah!');
        }

        // Check new password and configuration
        if ($request->new_password != $request->config_password) {
            return back()->with('error2', 'Konfigurasi password salah!');
        }

        User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('status', 'Password berhasil diperbarui!');
    }

    public function presensi(Request $request) 
    {
        $user = Auth::user();
        $user->load('mahasiswa');
        $mahasiswa = $user->mahasiswa;

        $generate_absen = GeneratedAbsen::orderBy('mulai_absen', 'desc')->get();
        
        return view('mahasiswa.presensi', compact('generate_absen', 'mahasiswa'));
    }
    

    public function add_presensi($id_absen) 
    {
        $user = auth()->user();
        $user->load('mahasiswa');
        $mahasiswa = $user->mahasiswa;
    
        $absen = Absen::where('id_mhs', $mahasiswa->id_mhs)
            ->where('id_absen', $id_absen)
            ->first();

        $generate_absen = GeneratedAbsen::where('id_absen', $id_absen)
            ->select(
                'generate_absen.sesi',
            )
            ->first();
    
        return view('mahasiswa.add_presensi', compact('generate_absen', 'absen', 'mahasiswa', 'id_absen'));
    }   

    public function store_presensi(Request $request, $id_absen)
    {
        try {
            $tanggal = $request->input('tanggal');
            $user = Auth::user();
            $user->load('mahasiswa');
            $mahasiswa = $user->mahasiswa;

            $validated = $request->validate([
                'keterangan' => 'required',
                'foto' => 'required|mimes:jpg,jpeg,png,pdf|max:10240',
            ]);

            if ($request->has('foto')) {
                $fotoPath = $request->file('foto')->store('absen', 'public');
                $validated['foto'] = $fotoPath;
            }

            $validated['id_mhs'] = $mahasiswa->id_mhs;
            $validated['id_absen'] = $id_absen;
            $validated['tanggal'] = $tanggal;
            
            Absen::create($validated);
    
            return redirect()->route('presensi_mahasiswa')->with('success', 'Presensi berhasil!');
        } catch (\Exception $e) {
            return redirect()->route('presensi_mahasiswa')->with('error', 'Gagal melakukan presensi: ' . $e->getMessage());
        }
    }          

    public function progress(Request $request)
    {
        $user = Auth::user();
        $user->load('mahasiswa');
        $mahasiswa = $user->mahasiswa;

        $generate_progress = GeneratedProgress::orderBy('mulai_submit', 'desc')->get();

        return view('mahasiswa.progress', compact('generate_progress', 'mahasiswa'));
    }

    public function add_progress($id_progress)
    {
        $user = auth()->user();
        $user->load('mahasiswa');
        $mahasiswa = $user->mahasiswa;

        $progress = Progress::where('id_mhs', $mahasiswa->id_mhs)
            ->where('id_progress', $id_progress)
            ->first();

        $generate_progress = GeneratedProgress::where('id_progress', $id_progress)
            ->select(
                'generate_progress.mulai_submit',
                'generate_progress.selesai_submit',
            )
            ->first();

        return view('mahasiswa.add_progress', compact('progress', 'mahasiswa', 'id_progress', 'generate_progress'));
    }

    // public function store_progress(Request $request, $id_progress)
    // {
    //     dd('aa');
    //     try {
    //         $request->validate([
    //             'deskripsi' => 'required',
    //             'scan_file' => 'required|mimes:pdf|max:10240',
    //         ]);
        
    //         $fileProgressPath = $request->scan_file->store('progress', 'public');
        
    //         $user = $request->user();
        
    //         // Mendapatkan data mahasiswa berdasarkan id_user
    //         $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();
        
    //         if ($mahasiswa === null) {
    //             return redirect()->route('progress_mahasiswa')->with('error', 'Pengguna tidak terkait dengan seorang mahasiswa.');
    //         }
        
    //         // Simpan progress dengan mengisi kolom nip_admin dan nip_mentor langsung
    //         $progress = new Progress();
    //         $progress->id_mhs = $mahasiswa->id_mhs;
    //         $progress->nip_mentor = $mahasiswa->nip_mentor;
    //         $progress->nip_admin = $mahasiswa->nip_admin; 
    //         $progress->deskripsi = $request->deskripsi;
    //         $progress->scan_file = $fileProgressPath;
    //         $progress->save();
        
    //         return redirect()->route('progress_mahasiswa')->with('success', 'Progress berhasil dikirim!');
    //     } catch (\Exception $e) {
    //         dd($e->getMessage());
    //     }
    // }

    public function store_progress(Request $request, $id_progress)
    {
        // dd('aa');
        try {
            $tanggal = $request->input('tanggal');
            $user = Auth::user();
            $user->load('mahasiswa');
            $mahasiswa = $user->mahasiswa;

            // dd('aa');

            $validated = $request->validate([
                'deskripsi' => 'required',
                'scan_file' => 'required|mimes:pdf|max:10240',
            ]);

            if ($request->has('scan_file')) {
                $filePath = $request->file('scan_file')->store('progress', 'public');
                $validated['scan_file'] = $filePath;
            }

            $validated['id_mhs'] = $mahasiswa->id_mhs;
            $validated['id_progress'] = $id_progress;
            $validated['tanggal'] = $tanggal;

            // dd($validated);

            Progress::create($validated);

            return redirect()->route('progress_mahasiswa')->with('success', 'Progress berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->route('progress_mahasiswa')->with('error', 'Gagal mengirim progress: ' . $e->getMessage());
        }
    }

    public function cetak_nilai() 
    {
        $user = Auth::user();
        $id_mhs = $user->mahasiswa->id_mhs;
        $mahasiswa = Mahasiswa::join('users', 'mahasiswa.id_user', '=', 'users.id')
            ->where('mahasiswa.id_mhs', $id_mhs)
            ->select(
                'mahasiswa.nama',
                'mahasiswa.jurusan',
                'mahasiswa.instansi',
                'mahasiswa.id_mhs',
            )
            ->first();

        $nilai = Nilai::where('id_mhs', $id_mhs)->first();

        $criteria = [
            'Kedisiplinan dan Etika',
            'Kemampuan Berkomunikasi dan Bekerja Sama',
            'Pemahaman terhadap Permasalahan',
            'Pengetahuan Teoritis dan Praktik',
            'Rata-rata',
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('mahasiswa.cetak_nilai', compact('criteria', 'nilai', 'mahasiswa'));
        return $pdf->stream('cetak_nilai.pdf');
    }
}