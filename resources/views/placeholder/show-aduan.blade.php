<div class="max-w-7xl bg-white mx-auto px-6 grid grid-cols-1 lg:grid-cols-4 gap-8 py-20">

    {{-- Sidebar Riwayat --}}

    <div class=" rounded-lg animate-pulse overflow-hidden">
        <div class="h-10 bg-gray-200 rounded  w-70 mb-3"></div>
        <div class="h-100 bg-gray-200 rounded  w-70 mb-3"></div>
    </div>

    {{-- Konten Utama --}}
    <article class="lg:col-span-3 animate-pulse  space-y-6">
        
        {{-- Info Atas --}}
        <div class="flex flex-wrap items-center gap-4">
            <span class="flex items-center gap-1">
                <div class="h-7 bg-gray-200 rounded-full  w-40 mb-3"></div>
            </span>

            {{-- <span class="flex items-center gap-1">
                <div class="h-7 bg-gray-200 rounded-full  w-50 mb-3"></div>
            </span> --}}

            <span class="flex items-center gap-1">
                <div class="h-7 bg-gray-200 rounded-full  w-40 mb-3"></div>
            </span>

            <span class="flex items-center gap-1 ml-auto">
                <div class="h-7 bg-gray-200 rounded-full  w-70 mb-3"></div>
            </span>
        </div>

        {{-- Baris 2: Instansi --}}
        <div class="flex flex-wrap items-center gap-2">
            <div class="h-7 bg-gray-200 rounded-full  w-40 mb-3"></div>
            <div class="h-7 bg-gray-200 rounded-full  w-40 mb-3"></div>
        </div>

        {{-- Baris 3: Nomor Tiket (copyable), Tanggal, Kategori --}}
        <div class="flex flex-wrap items-center gap-4">
            <span class="flex items-center gap-1">
                <div class="h-7 bg-gray-200 rounded-full  w-45 mb-3"></div>
            </span>

            

            <span class="flex items-center gap-1">
                <div class="h-7 bg-gray-200 rounded-full  w-60 mb-3"></div>
            </span>
        </div>
        

        {{-- Judul dan Isi --}}
        <div class="h-7 bg-gray-200 rounded-full  w-90 mb-2"></div>
        <div class="h-3 bg-gray-200 rounded-full  max-w-[800px] mb-2.5"></div>
        <div class="h-3 bg-gray-200 rounded-full  max-w-[770px] mb-2.5"></div>
        <div class="h-3 bg-gray-200 rounded-full  max-w-[700px] mb-2.5"></div>
        <div class="h-3 bg-gray-200 rounded-full  max-w-[830px] mb-2.5"></div>
   

        <!-- Tabs -->
        <div x-data="{ tab: 'tindak' }" class="mt-6">
        {{-- Tab Headers --}}
            <div class="flex flex-wrap gap-6 text-sm pt-4">
                <div class="h-5 bg-gray-200 rounded-full  w-30 mb-3"></div>

                <div class="h-5 bg-gray-200 rounded-full  w-30 mb-3"></div>
                <div class="h-5 bg-gray-200 rounded-full  w-30 mb-3"></div>

                <div class="h-5 bg-gray-200 rounded-full  w-30 mb-3"></div>

               
            </div>


            {{-- Tab Contents --}}
         
        </div>

    </article>
</div>