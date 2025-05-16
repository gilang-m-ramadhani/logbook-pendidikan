<?php

namespace App\Http\Controllers\Dosen;

use App\Models\User;
use App\Models\LogEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $mahasiswas = User::role('mahasiswa')->withCount(['logEntries as total_entries'])
        ->orderBy('name')
        ->get();

    $pendingValidations = LogEntry::where('validasi', false)
        ->with(['user', 'kegiatan'])
        ->latest()
        ->limit(5)
        ->get();

    return view('dosen.dashboard', compact('mahasiswas', 'pendingValidations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function validateLogEntry(Request $request, LogEntry $logEntry)
    {
        $request->validate([
        'validasi' => 'required|boolean',
        'catatan' => 'nullable|string',
    ]);

    $logEntry->update([
        'validasi' => $request->validasi,
        'catatan_validasi' => $request->catatan,
    ]);

    return back()->with('success', 'Validasi berhasil disimpan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
