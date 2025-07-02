<div class="py-20">
    <form wire:submit.prevent="submit" enctype="multipart/form-data" class="max-w-3xl mx-auto bg-white p-6 rounded-lg" id="form-aduan">

        <h2 class="text-xl text-center font-semibold mb-6 text-gray-800">Form Lapor Aduan</h2>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap (Opsional)</label>
                <input type="text" id="nama" wire:model.lazy="nama" 
                    class="bg-gray-50 border @error('nama') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                    placeholder="Masukkan nama Anda">
                @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>


            <div>
                <label for="nomor_wa" class="block mb-2 text-sm font-medium text-gray-900">Nomor HP / WA *</label>
                <input type="tel" id="nomor_wa" wire:model.lazy="nomor_wa" 
                    class="bg-gray-50 border @error('nomor_wa') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                    placeholder="08xxxxxxxxxx" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                @error('nomor_wa') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email (Opsional)</label>
                <input type="email" id="email" wire:model.lazy="email" 
                    class="bg-gray-50 border @error('email') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                    placeholder="Masukkan email Anda">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900">Lokasi Kejadian *</label>
                <input type="text" id="lokasi" wire:model.lazy="lokasi" 
                    class="bg-gray-50 border @error('lokasi') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                    placeholder="Alamat lengkap kejadian" required>
                @error('lokasi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="judul" class="block mb-2 text-sm font-medium text-gray-900">Judul Aduan *</label>
            <input type="text" id="judul" wire:model.lazy="judul" 
                class="bg-gray-50 border @error('judul') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="Contoh: Lampu Jalan Mati" required>
            @error('judul') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="isi" class="block mb-2 text-sm font-medium text-gray-900">Isi Aduan *</label>
            <textarea id="isi" wire:model.lazy="isi" rows="5" 
                class="bg-gray-50 border @error('isi') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="Tuliskan kronologi aduan secara detail..." required></textarea>
            @error('isi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div x-data="{ openModal: false }" class="mb-6">
            <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900">
                Kategori Aduan *
            </label>

            <!-- Tombol untuk membuka modal -->
            <button
                type="button"
                @click="openModal = true"
                class="px-5 py-2 border-2 border-gray-700 text-gray-700 font-medium cursor-pointer rounded-md hover:bg-gray-700 hover:text-white transition-colors duration-300 focus:outline-none focus:ring-4 focus:ring-gray-300"
            >
                Pilih Kategori Aduan
            </button>



            <!-- Modal -->
            <div
                x-show="openModal"
                class="fixed inset-0 flex items-center justify-center bg-transparent bg-opacity-50 z-50"
                x-transition
            >
                <div
                    @click.away="openModal = false"
                    class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md"
                >
                    <h2 class="text-lg font-semibold mb-4 text-gray-800 text-center">
                        Pilih Kategori Aduan
                    </h2>

                    <div class="grid grid-cols-2 gap-2 mb-4 text-sm text-gray-700">
                        @foreach ($semuaKategori as $kat)
                            <label class="inline-flex items-center">
                                <input
                                    type="checkbox"
                                    wire:model="kategori"
                                    value="{{ $kat->id }}"
                                    class="checkbox"
                                >
                                <span class="ml-2">{{ $kat->nama_kategori }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="flex justify-end">
                        <button
                            type="button"
                            @click="openModal = false"
                            class="px-4 py-2 bg-blue-400 text-white text-sm rounded cursor-pointer hover:bg-blue-500"
                        >
                            Selesai
                        </button>
                    </div>
                </div>
            </div>

            @error('kategori')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900">
                Lampiran (Opsional, maksimal 3 file: JPG, JPEG, PNG, PDF)
            </label>

            @if (count($lampiran) < 3)
                <input type="file" wire:model="lampiran"
                    accept=".jpg,.jpeg,.png,.pdf"
                    multiple
                    oninput="if(this.files.length > 3){ 
                        Swal.fire({
                            icon: 'warning',
                            title: 'Maksimal 3 file!',
                            text: 'Anda hanya bisa mengunggah hingga 3 file.',
                            confirmButtonText: 'OK'
                        });
                        this.value = '';
                    }"
                    class="block w-full mb-3 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-200 focus:outline-none px-2 py-2" />
            @else
                <p class="text-sm text-gray-600 mb-2">Maksimal 3 file sudah ditambahkan.</p>
            @endif

            @error('lampiran') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            @error('lampiran.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <ul class="space-y-3 mt-3">
                @foreach ($lampiran as $index => $file)
                    <li class="flex items-start bg-gray-100 p-3 rounded-lg relative">
                        <div class="flex-shrink-0 mr-3">
                            @if (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png']))
                                <img src="{{ $file->temporaryUrl() }}" class="w-20 h-20 object-cover rounded border border-gray-300" />
                            @else
                                <div class="w-20 h-20 bg-gray-200 flex items-center justify-center rounded border border-gray-300 text-gray-600">
                                    PDF
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <p class="truncate text-sm text-gray-700">{{ $file->getClientOriginalName() }}</p>
                            <p class="text-xs text-gray-500">
                                {{ number_format($file->getSize() / 1024, 2) }} KB
                            </p>

                        </div>
                        <button type="button" wire:click="removeFile({{ $index }})"
                            class="absolute top-1 right-2 text-red-600 hover:text-red-800 text-xl font-bold">&times;</button>
                    </li>
                @endforeach
            </ul>

            <div wire:loading wire:target="lampiran" class="text-sm text-gray-500 mt-2">
                Mengunggah file...
            </div>
        </div>

        <button type="button"
            id="btn-kirim"
            class="w-full text-white bg-green-600 cursor-pointer hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-3 text-center">
            Kirim Aduan
        </button>
        
    </form>

   <script>
        function initKirimAduanButton() {
            const btn = document.getElementById('btn-kirim');
            if (!btn) return;

            btn.addEventListener('click', function () {
            Swal.fire({
                title: 'Kebijakan Privasi',
                html: `
                    <div style="text-align: justify;">
                        <p>Dengan melanjutkan pengiriman aduan ini, Anda menyetujui bahwa seluruh data yang disampaikan akan digunakan oleh instansi terkait dalam rangka penanganan dan penyelesaian aduan sesuai dengan ketentuan yang berlaku.</p>
                        <br />
                        <p>Seluruh informasi yang Anda berikan akan dijaga kerahasiaannya dan diproses sesuai dengan kebijakan privasi yang berlaku.</p>
                    </div>
                `,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Setuju & Kirim',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('kirimAduan');
                }
            });
        });

        }

        document.addEventListener('livewire:navigated', initKirimAduanButton);
        document.addEventListener('livewire:load', initKirimAduanButton);

        Livewire.on('aduanBerhasil', () => {
            Swal.fire({
                icon: 'success',
                title: 'Aduan Berhasil Dikirim!',
                text: 'Terima kasih, aduan Anda telah berhasil dikirim dan akan segera ditindaklanjuti.',
                confirmButtonText: 'OK'
            });
        });
    </script>

</div>
