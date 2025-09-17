<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     * Untuk admin melihat semua kontak
     */
    public function index(Request $request)
    {
        $query = Kontak::query();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->byStatus($request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal_kontak', $request->tanggal);
        }

        // Search berdasarkan nama atau email
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subjek', 'like', "%{$search}%");
            });
        }

        $kontaks = $query->orderBy('tanggal_kontak', 'desc')
            ->paginate(15);

        $statusOptions = Kontak::getStatusOptions();
        // Hitung statistik
        $statistik = [
            'baru' => Kontak::where('status', 'baru')->count(),
            'dibaca' => Kontak::where('status', 'dibaca')->count(),
            'diproses' => Kontak::where('status', 'diproses')->count(),
            'selesai' => Kontak::where('status', 'selesai')->count(),
        ];

        // Transform data untuk include color
        $kontaks->getCollection()->transform(function ($kontak) {
            $kontak->subjek_color = $this->getSubjekColor($kontak->subjek);
            $kontak->status_color = $this->getStatusColor($kontak->status);
            return $kontak;
        });

        return view('admin.kontak.index', compact('kontaks', 'statusOptions', 'statistik'));
    }

    private function getSubjekColor($subjek)
    {
        $colors = [
            'Informasi Wisata' => 'primary',
            'Bantuan Perjalanan' => 'info',
            'Saran & Masukan' => 'success',
            'Kerjasama' => 'warning',
            'Keluhan' => 'danger',
            'Lainnya' => 'secondary'
        ];
        return $colors[$subjek] ?? 'secondary';
    }

    private function getStatusColor($status)
    {
        $colors = [
            'baru' => 'warning',
            'dibaca' => 'info',
            'diproses' => 'primary',
            'selesai' => 'success'
        ];
        return $colors[$status] ?? 'secondary';
    }

    /**
     * Show the form for creating a new resource.
     * Form kontak untuk masyarakat
     */
    public function create()
    {
        return view('frontend.kontak');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan kontak dari masyarakat
     */
    public function store(Request $request)
    {
        // Validasi hCaptcha terlebih dahulu
        $hcaptchaValid = $this->validateHCaptcha($request->input('h-captcha-response'));

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|min:10|max:1000',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subjek.required' => 'Subjek wajib diisi.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.min' => 'Pesan minimal 10 karakter.',
        ]);

        // Tambahkan error hCaptcha jika tidak valid
        if (!$hcaptchaValid) {
            $validator->errors()->add('h-captcha-response', 'Silakan verifikasi bahwa Anda bukan robot.');
        }

        if ($validator->fails() || !$hcaptchaValid) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan pada form. Silakan periksa kembali.');
        }

        try {
            $kontak = Kontak::create([
                'nama' => strip_tags($request->nama),
                'email' => $request->email,
                'telepon' => $request->telepon,
                'subjek' => strip_tags($request->subjek),
                'pesan' => strip_tags($request->pesan),
                'status' => 'baru',
                'tanggal_kontak' => now()
            ]);

            Log::info('Kontak baru diterima', [
                'id' => $kontak->id,
                'nama' => $kontak->nama,
                'email' => $kontak->email,
                'ip' => $request->ip()
            ]);

            return redirect()->back()
                ->with('success', 'Pesan Anda telah terkirim. Kami akan segera merespons. Terima kasih!');
        } catch (\Exception $e) {
            Log::error('Error saving contact: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi dalam beberapa saat.')
                ->withInput();
        }
    }

    private function validateHCaptcha($response)
    {
        // Skip validasi di environment local/testing
        if (app()->environment(['local', 'testing']) && empty($response)) {
            return true;
        }

        if (empty($response)) {
            return false;
        }

        try {
            $verifyResponse = Http::asForm()->post('https://hcaptcha.com/siteverify', [
                'secret' => env('HCAPTCHA_SECRET'),
                'response' => $response,
                'remoteip' => request()->ip(),
            ]);

            if ($verifyResponse->successful()) {
                $result = $verifyResponse->json();
                return isset($result['success']) && $result['success'] === true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('hCaptcha validation error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Display the specified resource.
     * Detail kontak untuk admin
     */
    public function show(Kontak $kontak)
    {
        // Tandai sebagai dibaca jika masih baru
        if ($kontak->isBaru()) {
            $kontak->markAsDibaca();
        }

        return view('admin.kontak.show', compact('kontak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kontak $kontak)
    {
        $statusOptions = Kontak::getStatusOptions();
        return view('admin.kontak.edit', compact('kontak', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     * Update status kontak oleh admin
     */
    public function update(Request $request, Kontak $kontak)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:' . implode(',', array_keys(Kontak::getStatusOptions())),
            'catatan_admin' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        try {
            $kontak->update([
                'status' => $request->status,
                'catatan_admin' => $request->catatan_admin
            ]);

            return redirect()->route('admin.kontak.index')
                ->with('success', 'Status kontak berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui status.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kontak $kontak)
    {
        try {
            $kontak->delete();

            return redirect()->route('admin.kontak.index')
                ->with('success', 'Kontak berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus kontak.');
        }
    }

    /**
     * Update status kontak menjadi diproses
     */
    public function markAsDisproses(Kontak $kontak)
    {
        $kontak->markAsDisproses();

        return redirect()->back()
            ->with('success', 'Kontak ditandai sebagai sedang diproses.');
    }

    /**
     * Update status kontak menjadi selesai
     */
    public function markAsSelesai(Kontak $kontak)
    {
        $kontak->markAsSelesai();

        return redirect()->back()
            ->with('success', 'Kontak ditandai sebagai selesai.');
    }

    /**
     * Dashboard statistik kontak untuk admin
     */
    public function dashboard()
    {
        $stats = [
            'total' => Kontak::count(),
            'baru' => Kontak::baru()->count(),
            'dibaca' => Kontak::byStatus(Kontak::STATUS_DIBACA)->count(),
            'diproses' => Kontak::byStatus(Kontak::STATUS_DIPROSES)->count(),
            'selesai' => Kontak::byStatus(Kontak::STATUS_SELESAI)->count(),
            'hari_ini' => Kontak::hariIni()->count(),
            'minggu_ini' => Kontak::mingguIni()->count()
        ];

        $kontakTerbaru = Kontak::orderBy('tanggal_kontak', 'desc')
            ->limit(5)
            ->get();

        return view('admin.kontak.dashboard', compact('stats', 'kontakTerbaru'));
    }

    /**
     * Export kontak ke CSV
     */
    public function export(Request $request)
    {
        $query = Kontak::query();

        if ($request->has('status') && $request->status != '') {
            $query->byStatus($request->status);
        }

        if ($request->has('dari_tanggal') && $request->dari_tanggal != '') {
            $query->whereDate('tanggal_kontak', '>=', $request->dari_tanggal);
        }

        if ($request->has('sampai_tanggal') && $request->sampai_tanggal != '') {
            $query->whereDate('tanggal_kontak', '<=', $request->sampai_tanggal);
        }

        $kontaks = $query->orderBy('tanggal_kontak', 'desc')->get();

        $fileName = 'kontak_' . date('Y-m-d') . '.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($kontaks) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, ['ID', 'Nama', 'Email', 'Telepon', 'Subjek', 'Pesan', 'Status', 'Tanggal Kontak']);

            foreach ($kontaks as $kontak) {
                fputcsv($file, [
                    $kontak->id,
                    $kontak->nama,
                    $kontak->email,
                    $kontak->telepon,
                    $kontak->subjek,
                    $kontak->pesan,
                    $kontak->status_label,
                    $kontak->tanggal_kontak_format
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Kirim notifikasi email ke admin (method private)
     */
    private function sendNotificationToAdmin($kontak)
    {
        try {
            // Implementasi sesuai kebutuhan email
            // Mail::to(config('mail.admin_email'))->send(new KontakBaruNotification($kontak));
        } catch (\Exception $e) {
            // Log error jika diperlukan
            Log::error('Failed to send contact notification: ' . $e->getMessage());
        }
    }
}
