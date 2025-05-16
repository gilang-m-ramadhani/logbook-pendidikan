<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Kegiatan;
use App\Models\LogEntry;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]
class AddLogEntry extends Component
{
    use WithFileUploads;

    public $kegiatan_id;
    public $tanggal;
    public $deskripsi;
    public $file;
    public $isSubmitting = false;

    protected $rules = [
        'kegiatan_id' => 'required|exists:kegiatans,id',
        'tanggal' => 'required|date|before_or_equal:today',
        'deskripsi' => 'required|string|min:20',
        'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
    ];

    public function mount()
    {
        $this->tanggal = now()->format('Y-m-d');
    }

    public function saveEntry()
    {
        $this->validate();
        $this->isSubmitting = true;

        try {
            $filePath = $this->file ? $this->file->store('logbook-files') : null;

            LogEntry::create([
                'user_id' => auth()->id(),
                'kegiatan_id' => $this->kegiatan_id,
                'tanggal' => $this->tanggal,
                'deskripsi' => $this->deskripsi,
                'file_path' => $filePath,
            ]);

            $this->reset(['kegiatan_id', 'deskripsi', 'file']);
            $this->dispatch('entry-added');
            session()->flash('success', 'Logbook berhasil disimpan!');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan: ' . $e->getMessage());
        }

        $this->isSubmitting = false;
    }
    public function render()
    {
        return view('livewire.mahasiswa.add-log-entry',[
            'kegiatans' => Kegiatan::where('aktif', true)->get(),
        ]);
    }
}
