<!-- resources/views/livewire/test/take-test.blade.php -->

<div class="bg-white rounded-lg shadow p-6">
    @if(!$isSubmitted)
        <!-- Progress Bar -->
        <div class="mb-6">
            <div class="flex justify-between mb-1">
                <span class="text-sm font-medium">Soal {{ $currentQuestion + 1 }} dari {{ $totalQuestions }}</span>
                <span class="text-sm font-medium">{{ round($progress) }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-primary-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
            </div>
        </div>

        <!-- Question -->
        <div class="mb-6 p-4 border border-gray-200 rounded-lg">
            <h3 class="font-bold mb-2">Soal {{ $currentQuestion + 1 }}:</h3>
            <div class="prose max-w-none">
                {!! $currentSoal['pertanyaan'] !!}
            </div>
        </div>

        <!-- Options -->
        <div class="space-y-3 mb-6">
            @foreach($currentSoal['pilihan'] as $index => $pilihan)
                <div class="flex items-center">
                    <input type="radio"
                           id="option-{{ $currentQuestion }}-{{ $index }}"
                           wire:model="jawaban.{{ $currentQuestion }}"
                           value="{{ $index }}"
                           class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300">
                    <label for="option-{{ $currentQuestion }}-{{ $index }}" class="ml-3 block text-gray-700">
                        {{ $pilihan['text'] }}
                        @if($pilihan['benar'] ?? false)
                            <span class="text-xs text-green-500">(Jawaban Benar)</span>
                        @endif
                    </label>
                </div>
            @endforeach
            @error("jawaban.{$currentQuestion}") <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Navigation -->
        <div class="flex justify-between">
            <button wire:click="prevQuestion"
                    class="btn-secondary"
                    @if($currentQuestion === 0) disabled @endif>
                Sebelumnya
            </button>

            @if($currentQuestion < $totalQuestions - 1)
                <button wire:click="nextQuestion" class="btn-primary">
                    Berikutnya
                </button>
            @else
                <button wire:click="submitTest" class="btn-accent">
                    Submit Test
                </button>
            @endif
        </div>
    @else
        <!-- Results -->
        <div class="text-center py-8">
            <div class="mx-auto w-24 h-24 rounded-full bg-{{ $score >= 70 ? 'green' : 'red' }}-100 flex items-center justify-center mb-4">
                <span class="text-2xl font-bold text-{{ $score >= 70 ? 'green' : 'red' }}-600">{{ $score }}</span>
            </div>
            <h3 class="text-xl font-bold mb-2">
                {{ $score >= 70 ? 'Selamat!' : 'Tetap Semangat!' }}
            </h3>
            <p class="text-gray-600 mb-6">
                Nilai Anda: {{ $score }}<br>
                {{ $score >= 70 ? 'Anda telah lulus test ini' : 'Anda belum mencapai nilai passing grade' }}
            </p>
            <a href="{{ route('mahasiswa.dashboard') }}" class="btn-primary">
                Kembali ke Dashboard
            </a>
        </div>
    @endif
</div>
