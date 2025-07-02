<div class="bg-white p-4 rounded-md shadow-sm">
    <form wire:submit.prevent="submit" class="space-y-4">
        <!-- Nama -->
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama (Opsional)</label>
            <input 
                type="text" 
                id="nama" 
                wire:model.defer="nama"
                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition"
                placeholder="Nama Anda (opsional)"
            >
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input 
                type="email" 
                id="email" 
                wire:model.defer="email" 
                required
                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition"
                placeholder="contoh@email.com"
            >
            @error('email') 
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Pesan -->
        <div>
            <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
            <textarea 
                id="pesan" 
                wire:model.defer="pesan" 
                rows="3" 
                required
                class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition resize-none"
                placeholder="Tulis komentar Anda..."
            ></textarea>
            @error('pesan') 
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Tombol -->
        <div>
            <button 
                type="submit" 
                class="w-full inline-flex justify-center px-4 py-2 bg-blue-600 cursor-pointer text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 transition"
            >
                Kirim Komentar
            </button>
        </div>
    </form>

    <script>
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
