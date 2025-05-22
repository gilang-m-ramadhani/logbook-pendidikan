<?php

namespace App\Livewire\Test;

use id;
use App\Models\Test;
use App\Models\User;
use Livewire\Component;
use App\Models\TestResult;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class TakeTest extends Component
{
    public $testId;
    public $soal = [];
    public $jawaban = [];
    public $currentQuestion = 0;
    public $isSubmitted = false;
    public $score = 0;
    public $feedback = '';

    public function mount($testId)
    {
        $this->testId = $testId;
        $test = Test::findOrFail($testId);
        $paket = $test->getRandomPaket();
        $this->soal = $test->prepareSoalForUser($paket);
    }

    public function nextQuestion()
    {
        $this->validate([
            "jawaban.{$this->currentQuestion}" => 'required|integer',
        ]);

        if ($this->currentQuestion < count($this->soal) - 1) {
            $this->currentQuestion++;
        }
    }

    public function prevQuestion()
    {
        if ($this->currentQuestion > 0) {
            $this->currentQuestion--;
        }
    }

    public function submitTest()
    {
        $this->validate([
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|integer',
        ]);

        $test = Test::find($this->testId);
        $totalBobot = 0;
        $totalScore = 0;

        foreach ($this->soal as $index => $question) {
            $selectedOption = $this->jawaban[$index];
            $isCorrect = $question['pilihan'][$selectedOption]['benar'] ?? false;

            $bobot = $question['bobot'] ?? 1;
            $totalBobot += $bobot;

            if ($isCorrect) {
                $totalScore += $bobot;
            }
        }

        $this->score = $totalBobot > 0 ? round(($totalScore / $totalBobot) * 100) : 0;

        // Simpan hasil test
        TestResult::create([
            'test_id' => $this->testId,
            'user_id' => auth()->id(),
            'dosen_id' => $test->dosen_id ?? User::role('dosen')->first()->id,
            'nilai' => $this->score,
            'feedback' => '',
        ]);

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.test.take-test', [
            'currentSoal' => $this->soal[$this->currentQuestion] ?? null,
            'totalQuestions' => count($this->soal),
            'progress' => count($this->soal) > 0 ? (($this->currentQuestion + 1) / count($this->soal)) * 100 : 0,
        ]);
    }
}
