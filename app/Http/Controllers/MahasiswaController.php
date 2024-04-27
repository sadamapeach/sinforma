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
use App\Models\Berita;
use App\Models\Absen;
use App\Models\Progress;
use App\Models\Nilai;
use App\Models\User;
use App\Models\GeneratedAbsen;
use App\Models\GeneratedProgress;
use App\Models\LiburNasional;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;

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

            $absen = Absen::where('id_mhs', $id_mhs)->select('absen.status');
            $progress = Progress::where('id_mhs', $id_mhs)->select('progress.status');

            $nilai = Nilai::where('id_mhs', $id_mhs)->first();

            $skl = SKL::where('id_mhs', $id_mhs)
                ->select('skl.file_skl')
                ->first();

            $berita = Berita::all();

            $libur = LiburNasional::all();

            return view('mahasiswa.dashboard', compact('berita', 'mahasiswa', 'skl', 'absen', 'progress', 'nilai', 'libur'));
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
            $fotoPath = $request->file('foto')->store('profile', 'public');
            $validated['foto'] = $fotoPath;
            $user->foto = $validated['foto'];
        }
    
        $user->username = $request->username;
        $user->email = $request->email;
        $mahasiswa->no_telepon = $request->no_telepon;
        $mahasiswa->email = $request->email;
        $mahasiswa->alamat = $request->alamat;
    
        $userChanged = $user->isDirty();
        $mahasiswaChanged = $mahasiswa->isDirty();
    
        if ($mahasiswa->save() && $user->save()) {
            if ($userChanged || $mahasiswaChanged) {
                return redirect()->route('profile_mahasiswa')->with('success', 'Data profil berhasil diperbarui!');
            } else {
                return redirect()->route('profile_mahasiswa')->with('info', 'Tidak ada data yang diperbarui!');
            }
        } else {
            return redirect()->route('profile_mahasiswa')->with('info', 'Data profil gagal diperbarui!');
        }
    }     
    
    public function change_password(Request $request)
    {
        // Check old password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error', 'Password lama salah!');
        }

        if ($request->old_password === $request->new_password) {
            return back()->with('error', 'Password baru sama dengan password lama!');
        }

        // Check new password and configuration
        if ($request->new_password != $request->config_password) {
            return back()->with('error', 'Konfigurasi password salah!');
        }

        User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    public function presensi() 
    {
        $user = Auth::user();
        $user->load('mahasiswa');
        $mahasiswa = $user->mahasiswa;

        $generate_absen = GeneratedAbsen::orderBy('mulai_absen', 'desc')->get();
        $id_absen = $generate_absen->pluck('id_absen'); // Mengambil semua id_absen
        
        $status_absens = Absen::whereIn('id_absen', $id_absen)->get();
        
        return view('mahasiswa.presensi', compact('generate_absen', 'mahasiswa', 'status_absens'));
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
        // dd($request);
        $validated = $request->validate([
            'keterangan' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            $tanggal = $request->input('tanggal');

            $user = Auth::user();
            $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();
            $id_mhs = $mahasiswa->id_mhs;

            if ($request->has('foto')) {
                $fotoPath = $request->file('foto')->store('absen', 'public');
                $validated['foto'] = $fotoPath;
            }

            $validated['id_mhs'] = $id_mhs;
            $validated['id_absen'] = $id_absen;
            $validated['tanggal'] = $tanggal;
            
            Absen::create($validated);
    
            return redirect()->route('presensi_mahasiswa')->with('success', 'Presensi berhasil dikirimkan! Silahkan menunggu presensi diverifikasi oleh admin.');
        } catch (\Exception $e) {
            return redirect()->route('presensi_mahasiswa')->with('error', 'Gagal mengirimkan presensi: ' . $e->getMessage());
        }
    } 
    
    public function edit_add_presensi($id_absen) 
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
    
        return view('mahasiswa.edit_add_presensi', compact('generate_absen', 'absen', 'mahasiswa', 'id_absen'));
    } 

    public function update_presensi(Request $request, $id_absen)
    {
        $absen  = Absen::where('id_absen', $id_absen)->first();
    
        $request->validate([
            'keterangan' => 'required',
            'foto' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    
        // Simpan foto lama untuk memeriksa perubahan nanti
        $fotoLama = $absen->foto;
    
        if ($request->hasFile('foto')) {
            if ($absen->foto && Storage::exists($absen->foto)) {
                Storage::delete($absen->foto);
            }
    
            $fotoPath = $request->file('foto')->store('absen', 'public');
            $absen->foto = $fotoPath;
        }
    
        $absen->keterangan = $request->keterangan;
        $absen->tanggal = $request->input('tanggal');
    
        // Periksa apakah ada perubahan pada foto atau atribut lainnya yang penting
        $absenChanged = $absen->foto !== $fotoLama || $absen->isDirty('keterangan');
    
        if ($absenChanged) {
            if ($absen->save()) {
                return redirect()->route('presensi_mahasiswa')->with(['success' => 'Presensi berhasil diperbarui! Silahkan menunggu presensi diverifikasi oleh admin.'] + compact('absen', 'id_absen'));
            } else {
                return redirect()->route('presensi_mahasiswa')->with(['info' => 'Data presensi gagal diperbarui!'] + compact('absen', 'id_absen'));
            }
        } else {
            return redirect()->route('presensi_mahasiswa')->with(['info' => 'Tidak ada data presensi yang diperbarui!'] + compact('absen', 'id_absen'));
        } 
    }    

    public function progress()
    {
        $user = Auth::user();
        $user->load('mahasiswa');
        $mahasiswa = $user->mahasiswa;
    
        // Dapatkan nip_mentor dari mahasiswa
        $nipMentor = $mahasiswa->nip_mentor;
    
        // Ambil progress yang dipost oleh mentornya
        $generate_progress = GeneratedProgress::where('nip_mentor', $nipMentor)
            ->orderBy('mulai_submit', 'desc')
            ->get();

        $id_progress = $generate_progress->pluck('id_progress');
        $status_progresses = Progress::whereIn('id_progress', $id_progress)->get();
    
        return view('mahasiswa.progress', compact('generate_progress', 'mahasiswa', 'status_progresses'));
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
                'generate_progress.nip_mentor'
            )
            ->first();

        return view('mahasiswa.add_progress', compact('progress', 'mahasiswa', 'id_progress', 'generate_progress'));
    }

    public function edit_add_progress($id_progress)
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
                'generate_progress.nip_mentor'
            )
            ->first();

        return view('mahasiswa.edit_add_progress', compact('progress', 'mahasiswa', 'id_progress', 'generate_progress'));
    }

    public function store_progress(Request $request, $id_progress)
    {
        $validated = $request->validate([
            'deskripsi' => 'required',
            'scan_file' => 'required|mimes:pdf|max:10240',
        ]);
        
        try {
            $tanggal = $request->input('tanggal');
            $user = Auth::user();
            $user->load('mahasiswa');
            $mahasiswa = $user->mahasiswa;

            if ($request->has('scan_file')) {
                $filePath = $request->file('scan_file')->store('progress', 'public');
                $validated['scan_file'] = $filePath;
            }

            $validated['id_mhs'] = $mahasiswa->id_mhs;
            $validated['id_progress'] = $id_progress;
            $validated['tanggal'] = $tanggal;

            // dd($validated);

            Progress::create($validated);

            return redirect()->route('progress_mahasiswa')->with('success', 'Progress berhasil dikirimkan! Silahkan menunggu presensi diverifikasi oleh admin.');
        } catch (\Exception $e) {
            return redirect()->route('progress_mahasiswa')->with('error', 'Gagal mengirimkan progress: ' . $e->getMessage());
        }
    }

    public function update_progress_mhs(Request $request, $id_progress)
    {
        $progress  = Progress::where('id_progress', $id_progress)->first();
    
        $request->validate([
            'deskripsi' => 'required',
            'scan_file' => 'nullable|mimes:pdf|max:10240',
        ]);
    
        // Simpan foto lama untuk memeriksa perubahan nanti
        $progressLama = $progress->scan_file;
    
        if ($request->hasFile('scan_file')) {
            if ($progress->scan_file && Storage::exists($progress->scan_file)) {
                Storage::delete($progress->scan_file);
            }
    
            $filePath = $request->file('scan_file')->store('progress', 'public');
            $progress->scan_file = $filePath;
        }
    
        $progress->deskripsi = $request->deskripsi;
        $progress->tanggal = $request->input('tanggal');
    
        // Periksa apakah ada perubahan pada scan_file atau atribut lainnya yang penting
        $progressChanged = $progress->scan_file !== $progressLama || $progress->isDirty('deskripsi');
    
        if ($progressChanged) {
            if ($progress->save()) {
                return redirect()->route('progress_mahasiswa')->with(['success' => 'Progres berhasil diperbarui! Silahkan menunggu progres diverifikasi oleh admin.'] + compact('progress', 'id_progress'));
            } else {
                return redirect()->route('progress_mahasiswa')->with(['info' => 'Data progres gagal diperbarui!'] + compact('progress', 'id_progress'));
            }
        } else {
            return redirect()->route('progress_mahasiswa')->with(['info' => 'Tidak ada data progres yang diperbarui!'] + compact('progress', 'id_progress'));
        } 
    } 

    public function cetak_skl()
    {
        $user = Auth::user();
        $id_mhs = $user->mahasiswa->id_mhs;
        $skl = Skl::where('id_mhs', $id_mhs)->first();

        if ($skl) {
            $file_path = storage_path("app/public/{$skl->file_skl}");

            if (file_exists($file_path)) {
                return response()->file($file_path);
            } else {
                return response()->json(['error' => 'SKL tidak ditemukan'], 404);
            }
        } else {
            return response()->json(['error' => 'SKL tidak ditemukan untuk user ini'], 404);
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
                'mahasiswa.nip_mentor', 
            )
            ->first();

        $nilai = Nilai::where('id_mhs', $id_mhs)->first();

        $mentor = Mentor::find($mahasiswa->nip_mentor); 

        $criteria = [
            'Kedisiplinan dan Etika',
            'Kemampuan Berkomunikasi dan Bekerja Sama',
            'Pemahaman terhadap Permasalahan',
            'Pengetahuan Teoritis dan Praktik',
            'Rata-rata',
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('mahasiswa.cetak_nilai', compact('criteria', 'nilai', 'mahasiswa', 'mentor'));
        return $pdf->stream('cetak_nilai.pdf');
    }

    public function delete_profile()
    {
        try {
            // User::where('id', auth()->user()->id)->delete();
            User::where('id', auth()->user()->id)->update(['foto' => null]);

            return redirect()->route('profile_mahasiswa')->with('success', 'Berhasil menghapus foto profile!');
        } catch (\Exception $e) {
            return redirect()->route('profile_mahasiswa')->with('error', 'Gagal menghapus foto profile!: ' . $e->getMessage());
        }
    } 

    public function showBuktiKehadiran($id_absen)
    {
        $foto = Absen::where('id_absen', $id_absen)->first();

        if ($foto) {
            $file_path = storage_path("app/public/{$foto->foto}");

            if (file_exists($file_path)) {
                return response()->file($file_path);
            } else {
                return response()->json(['error' => 'Bukti kehadiran tidak ditemukan'], 404);
            }
        } else {
            return response()->json(['error' => 'Bukti kehadiran tidak ditemukan untuk presensi ini'], 404);
        }
    }

    public function showBuktiProgress($id_progress)
    {
        $scan_file = Progress::where('id_progress', $id_progress)->first();

        if ($scan_file) {
            $file_path = storage_path("app/public/{$scan_file->scan_file}");

            if (file_exists($file_path)) {
                return response()->file($file_path);
            } else {
                return response()->json(['error' => 'File progres tidak ditemukan'], 404);
            }
        } else {
            return response()->json(['error' => 'File progres tidak ditemukan untuk progres ini'], 404);
        }
    }
}