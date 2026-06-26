<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Selamat Datang</h2>
    </x-slot>

    <div class="py-12" style="padding: 2rem; max-width: 1200px; margin: 0 auto;">
        <div class="space-y-6" style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            <div style="background: linear-gradient(135deg, #3B82F6 0%, #A855F7 50%, #F472B6 100%); height: 150px; border-radius: 0.5rem; display: flex; align-items: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <h1 style="font-family: 'Century', 'Century Schoolbook', serif; font-size: 20pt; font-weight: bold; color: white; margin-left: 120px; text-transform: uppercase;">
                    USER
                </h1>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.125rem; font-weight: bold; margin-bottom: 1rem; color: #1f2937;">Silahkan Isi Buku Tamu</h3>
                <form action="{{ route('guestbook.store') }}" method="POST">
                    @csrf
                    <textarea name="pesan" style="width: 100%; width: -webkit-fill-available; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; min-height: 100px;" placeholder="Tulis pesan atau kesan Anda di sini..." required></textarea>
                    <button type="submit" style="margin-top: 1rem; background-color: #2563eb; color: white; font-weight: bold; padding: 0.5rem 1.5rem; border-radius: 0.375rem; border: none; cursor: pointer;">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <div style="background: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 1.125rem; font-weight: bold; margin-bottom: 1rem; color: #1f2937;">Riwayat Pengisian Buku Tamu Anda</h3>
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e5e7eb; background-color: #f9fafb;">
                            <th style="padding: 0.75rem; color: #4b5563; font-weight: 600; width: 30%;">WAKTU BERKUNJUNG</th>
                            <th style="padding: 0.75rem; color: #4b5563; font-weight: 600; width: 70%;">ISI PESAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myMessages as $msg)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 0.75rem; color: #1f2937;">{{ $msg->created_at->format('d M Y H:i') }} WIB</td>
                            <td style="padding: 0.75rem; color: #1f2937;">{{ $msg->pesan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" style="padding: 2rem; text-align: center; color: #9ca3af;">Anda belum pernah mengisi buku tamu.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>