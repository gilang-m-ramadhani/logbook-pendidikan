<x-app-layout>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-4">
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-2">Menu Mahasiswa</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('mahasiswa.dashboard') }}" class="block px-2 py-1 rounded hover:bg-primary-50 text-primary-600">Dashboard</a></li>
                    <li><a href="{{ route('mahasiswa.logbook') }}" class="block px-2 py-1 rounded hover:bg-primary-50 text-primary-600">Logbook Harian</a></li>
                    <li><a href="{{ route('mahasiswa.minicex') }}" class="block px-2 py-1 rounded hover:bg-primary-50 text-primary-600">Mini-CEX</a></li>
                    <li><a href="{{ route('mahasiswa.tests') }}" class="block px-2 py-1 rounded hover:bg-primary-50 text-primary-600">Pre/Post Test</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="block px-2 py-1 rounded hover:bg-primary-50 text-primary-600">Edit Profile</a></li>
                </ul>
            </div>

            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-2">Statistik</h3>
                <div class="space-y-2">
                    <div>
                        <span class="text-gray-600">Total Kegiatan:</span>
                        <span class="font-bold">{{ auth()->user()->logEntries()->count() }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Tervalidasi:</span>
                        <span class="font-bold">{{ auth()->user()->logEntries()->where('validasi', true)->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Tambah Logbook Harian</h2>
                @livewire('mahasiswa.add-log-entry')
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Logbook Terakhir</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse(auth()->user()->logEntries()->latest()->take(5)->get() as $log)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $log->tanggal->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $log->kegiatan->nama_kegiatan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($log->validasi)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Tervalidasi</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('mahasiswa.logbook.show', $log->id) }}" class="text-primary-600 hover:text-primary-800">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada logbook</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
