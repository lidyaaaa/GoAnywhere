<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Kelola Manager
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                 <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4"> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                 <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4"> {{ session('error') }}</div>
            @endif

            <!-- Tambah Manager -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">                 Tambah Manager Baru</h3>
                <form action="{{ route('superadmin.managers.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Manager" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="email" name="email" placeholder="Email" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="password" name="password" placeholder="Password" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <input type="text" name="phone" placeholder="No HP" class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                    <select name="location" required class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                        <option value="">Pilih Lokasi</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}">{{ $loc }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">                     Tambah</button>
                </form>
            </div>

            <!-- List Manager -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No HP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($managers as $manager)
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{ $manager->name }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $manager->email }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $manager->location }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $manager->phone ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <form action="{{ route('superadmin.managers.destroy', $manager->id) }}" method="POST" onsubmit="return confirm('Hapus manager ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada manager</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>