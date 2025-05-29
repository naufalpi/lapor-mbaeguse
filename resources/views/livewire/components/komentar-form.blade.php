<div>

    <form wire:submit.prevent="submit" class="space-y-4 mt-6">
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama (Opsional)</label>
            <input type="text" id="nama" wire:model.defer="nama" class="w-full border rounded p-2">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" wire:model.defer="email" class="w-full border rounded p-2" required>
            @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
            <textarea id="pesan" wire:model.defer="pesan" class="w-full border rounded p-2" rows="3" required></textarea>
            @error('pesan') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Kirim Komentar</button>
    </form>

    <script>
        // Cek apakah listener sudah terpasang, hindari double-binding
        window.addEventListener('DOMContentLoaded', () => {
            Livewire.on('komentarTerkirim', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Komentar Berhasil Dikirim!',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>
</div>
