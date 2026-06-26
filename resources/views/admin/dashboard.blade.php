<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Admin</h2>
    </x-slot>

    <div class="py-12" style="padding: 2rem; max-width: 1200px; margin: 0 auto;">
        <div class="space-y-6" style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            <div style="background: linear-gradient(135deg, #E9D5FF 0%, #EF4444 50%, #111827 100%); height: 150px; border-radius: 0.5rem; display: flex; align-items: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h1 style="font-family: 'Century', 'Century Schoolbook', serif; font-size: 20pt; font-weight: bold; color: white; margin-left: 120px; text-transform: uppercase;">
                    ADMIN
                </h1>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.125rem; font-weight: bold; margin-bottom: 1rem; color: #4f46e5;">Daftar User Terdaftar</h3>
                <ul style="list-style-type: discrete; margin-left: 1.25rem; color: #374151; display: flex; flex-direction: column; gap: 0.5rem;">
                    @forelse($allUsers as $u)
                        <li><strong>{{ $u->name }}</strong> ({{ $u->email }}) — Bergabung: {{ $u->created_at->format('d M Y') }}</li>
                    @empty
                        <li style="color: #9ca3af; list-style-type: none; margin-left: 0;">Belum ada user yang mendaftar.</li>
                    @endforelse
                </ul>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.125rem; font-weight: bold; margin-bottom: 1rem; color: #dc2626;">Daftar Semua Buku Tamu</h3>
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e5e7eb; background-color: #f9fafb;">
                            <th style="padding: 0.75rem; color: #4b5563; font-weight: 600; width: 25%;">NAMA USER</th>
                            <th style="padding: 0.75rem; color: #4b5563; font-weight: 600; width: 60%;">ISI PESAN</th>
                            <th style="padding: 0.75rem; color: #4b5563; font-weight: 600; width: 15%; text-align: center;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allGuestbook as $gb)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 0.75rem; color: #1f2937; font-weight: 600;">{{ $gb->user->name }}</td>
                            <td style="padding: 0.75rem; color: #1f2937;">{{ $gb->pesan }}</td>
                            <td style="padding: 0.75rem; text-align: center;">
                                <form action="{{ route('guestbook.destroy', $gb->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #dc2626; text-decoration: underline; cursor: pointer; font-weight: 600;">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="padding: 2rem; text-align: center; color: #9ca3af;">Belum ada isi buku tamu.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>