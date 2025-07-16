@extends('unit-laka-samsat-jakut.layouts.main')
@section('container')

<div class="p-4 sm:ml-64 bg-[#ECF3F7]" x-data="formHandler()">
    <div class="p-4 mt-24">
        <div class="bg-white shadow rounded-lg p-6 text-sm">
            <h2 class="text-lg font-semibold mb-4 text-[#373A3C]">
                <span><i class="fa-solid fa-square-plus fa-lg mr-2"></i></span>Input Data Laporan
            </h2>
            <hr class="bg-[#E8EEF2] h-[2px] mt-4 mb-8">

            <form class="space-y-4" method="POST" action="{{ route('data-kendaraan.store') }}" enctype="multipart/form-data" onsubmit="return confirm('Yakin menyimpan data?')">
                @csrf

                <!-- Form Data Laporan -->
                <div>
                    <label class="block text-sm font-medium">Laporan Polisi</label>
                    <input name="laporan_polisi" type="text" placeholder="Ketikkan Laporan Polisi..." class="placeholder:text-gray-500 placeholder:normal-case uppercase mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium">Tanggal Laporan</label>
                    <input name="tanggal_laporan" type="date" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium">Tanggal Kejadian</label>
                    <input name="tanggal_kejadian" type="date" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium">Kode Penyidik</label>
                    <select name="kode_penyidik" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">Pilih Kode Penyidik</option>
                        <option value="T.1">T.1</option>
                        <option value="T.2">T.2</option>
                        <option value="T.3">T.3</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Status Perkara</label>
                    <select name="status_perkara" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">Pilih Status Perkara</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Belum Selesai">Belum Selesai</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Nama Tersangka</label>
                    <input name="nama_tersangka_global" type="text"
                        placeholder="Ketikkan Nama Tersangka..."
                        class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium">Jenis Kendaraan Tersangka</label>
                    <select name="jenis_kendaraan_tersangka" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
                        <option value="">Pilih Jenis Kendaraan</option>
                        <option value="Roda 2">Roda 2</option>
                        <option value="Roda 3">Roda 3</option>
                        <option value="Roda 4">Roda 4</option>
                        <option value="Diatas Roda 4">Diatas Roda 4</option>
                    </select>
                </div>

                <div x-data="nopolHandler()" class="space-y-1">
                    <label class="block text-sm font-medium">Nomor Polisi Tersangka</label>

                    <div x-show="!tanpaNopol">
                        <div class="flex items-center space-x-1">
                            <input type="text" x-model="part1" @input="updateNomorPolisi" maxlength="2" class="uppercase text-center w-14 border border-gray-300 rounded px-2 py-2 text-sm">
                            <span class="text-lg font-semibold">-</span>
                            <input type="text" x-model="part2" @input="updateAngkaOnly(); updateNomorPolisi()" maxlength="4" inputmode="numeric" class="text-center w-20 border border-gray-300 rounded px-2 py-2 text-sm">
                            <span class="text-lg font-semibold">-</span>
                            <input type="text" x-model="part3" @input="updateNomorPolisi" maxlength="3" class="uppercase text-center w-16 border border-gray-300 rounded px-2 py-2 text-sm">
                        </div>
                    </div>

                    <input type="hidden" name="nomor_polisi_tersangka" :value="tanpaNopol ? 'Tanpa Nomor Polisi' : full">
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" x-model="tanpaNopol" @change="handleTanpaNopol">
                            <span class="ml-2 text-sm">Tanpa Nomor Polisi</span>
                        </label>
                    </div>
                </div>

                <div x-data="masaBerlakuHandler()" class="mt-4">
                    <label class="block text-sm font-medium">Masa Berlaku PKB/SW Tersangka</label>
                    <input name="masa_berlaku_pkb_sw_tersangka" type="date" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium">Foto Barang Bukti Tersangka</label>
                    <input name="foto_barang_bukti_tersangka" type="file" accept="image/*" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 bg-white">
                </div>

                <div class="bg-white shadow rounded-lg p-6 text-sm mt-10">
                    <h2 class="text-lg font-semibold mb-4 text-[#373A3C]">
                        <span><i class="fa-solid fa-car fa-lg mr-2"></i></span>Input Data Kendaraan
                    </h2>
                    <hr class="bg-[#E8EEF2] h-[2px] mt-4 mb-8">

                    <template x-for="(kendaraan, index) in kendaraans" :key="index">
                        <div class="bg-[#f6f7f8] p-4 rounded-lg shadow-sm mb-6 space-y-4">
                            <h3 class="font-semibold text-base mb-4 text-[#373A3C]">Kendaraan <span x-text="index + 1"></span></h3>

                            <div>
                                <label class="block text-sm font-medium">Nama Korban</label>
                                <input :name="'nama_korban[]'" type="text" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
                            </div>

                            <div>
                                <label class="block text-sm font-medium">Jenis Kendaraan</label>
                                <select :name="'jenis_kendaraan[]'" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
                                    <option value="">Pilih Jenis Kendaraan</option>
                                    <option value="Roda 2">Roda 2</option>
                                    <option value="Roda 3">Roda 3</option>
                                    <option value="Roda 4">Roda 4</option>
                                    <option value="Diatas Roda 4">Diatas Roda 4</option>
                                </select>
                            </div>

                            <div x-data="nopolHandler()" class="space-y-1">
                                <label class="block text-sm font-medium">Nomor Polisi</label>

                                <div x-show="!tanpaNopol">
                                    <div class="flex items-center space-x-1">
                                        <input type="text" x-model="part1" @input="updateNomorPolisi" maxlength="2"
                                            class="uppercase text-center w-14 border border-gray-300 rounded px-2 py-2 text-sm">

                                        <span class="text-lg font-semibold">-</span>

                                        <input type="text" x-model="part2" @input="updateAngkaOnly(); updateNomorPolisi()" maxlength="4"
                                            inputmode="numeric"
                                            class="text-center w-20 border border-gray-300 rounded px-2 py-2 text-sm">

                                        <span class="text-lg font-semibold">-</span>

                                        <input type="text" x-model="part3" @input="updateNomorPolisi" maxlength="3"
                                            class="uppercase text-center w-16 border border-gray-300 rounded px-2 py-2 text-sm">
                                    </div>
                                </div>

                                <!-- Hidden input untuk dikirim ke backend -->
                                <input type="hidden" name="nomor_polisi[]" :value="tanpaNopol ? 'Tanpa Nomor Polisi' : full">

                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" x-model="tanpaNopol" @change="handleTanpaNopol">
                                        <span class="ml-2 text-sm">Tanpa Nomor Polisi</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium">Masa Berlaku PKB/SW</label>
                                <input :name="'masa_berlaku_pkb_sw[]'" type="date" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
                            </div>

                            <div x-data="currencyHandler()">
                                <label class="block text-sm font-medium">Total Kerugian</label>
                                <input type="hidden" :name="'total_kerugian[]'" x-model="hiddenValue">

                                <input type="text" placeholder="Rp" 
                                    x-model="displayValue"
                                    @input="formatInput"
                                    @focus="focusInput"
                                    @blur="blurInput"
                                    class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2">
                            </div>

                            <div>
                                <label class="block text-sm font-medium">Foto Barang Bukti</label>
                                <input :name="'foto_barang_bukti[]'" type="file" accept="image/*" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2 bg-white">
                            </div>

                            <div>
                                <label class="block text-sm font-medium">Keterangan</label>
                                <textarea :name="'keterangan[]'" class="placeholder:text-gray-500 mt-1 text-sm w-full border border-gray-300 rounded px-3 py-2"></textarea>
                            </div>
                        </div>
                    </template>

                    <div class="mt-4">
                        <button type="button" @click="tambahKendaraan" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            <i class="fa-solid fa-plus mr-2"></i>Tambah Kendaraan
                        </button>
                    </div>
                </div>

                <div class="pt-4 flex justify-center">
                    <button type="submit" class="bg-blueJR text-white px-4 py-2 rounded hover:bg-blueJRdark">Simpan Data</button>
                </div>

            </form>
        </div>
    </div>
</div>

@if(session('success'))
<div id="toast-success" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 text-green-800 bg-green-100 rounded-lg shadow-lg transition-opacity duration-700 opacity-100"
     role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-200 rounded-lg">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 111.414-1.414L8.414 12.586l7.293-7.293a1 1 0 011.414 0z"/>
        </svg>
        <span class="sr-only">Success icon</span>
    </div>
    <div class="ms-3 text-sm font-medium">
        {{ session('success') }}
    </div>
    <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
            onclick="closeToast()">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13"/>
        </svg>
        <span class="sr-only">Close</span>
    </button>
</div>

<script>
    const toast = document.getElementById('toast-success');
    if (toast) {
        setTimeout(() => {
            toast.classList.remove('opacity-100');
            toast.classList.add('opacity-0');
        }, 5000); // 5 detik

        toast.addEventListener('transitionend', () => {
            toast.remove();
        });
    }

    function closeToast() {
        toast.classList.remove('opacity-100');
        toast.classList.add('opacity-0');
    }
</script>
@endif

@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
        <strong>Terjadi kesalahan saat menyimpan data:</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
function formHandler() {
    return {
        kendaraans: [{}],
        tambahKendaraan() {
            this.kendaraans.push({});
        }
    }
}

function currencyHandler() {
    return {
        hiddenValue: '',
        displayValue: '',

        formatInput() {
            let numeric = this.displayValue.replace(/[^0-9]/g, '');
            if (numeric) {
                this.displayValue = 'Rp ' + new Intl.NumberFormat('id-ID').format(numeric);
                this.hiddenValue = numeric;
            } else {
                this.displayValue = '';
                this.hiddenValue = '';
            }
        },

        focusInput() {
            this.displayValue = this.hiddenValue;
        },

        blurInput() {
            if (this.hiddenValue) {
                this.displayValue = 'Rp ' + new Intl.NumberFormat('id-ID').format(this.hiddenValue);
            }
        }
    }
}

function nopolHandler() {
    return {
        part1: '',
        part2: '',
        part3: '',
        full: '',
        tanpaNopol: false,

        updateAngkaOnly() {
            this.part2 = this.part2.replace(/[^0-9]/g, '');
        },

        updateNomorPolisi() {
            const p1 = this.part1.toUpperCase().trim();
            const p2 = this.part2.trim();
            const p3 = this.part3.toUpperCase().trim();
            this.full = [p1, p2, p3].filter(Boolean).join('-');
        },

        handleTanpaNopol() {
            if (this.tanpaNopol) {
                this.full = 'Tanpa Nomor Polisi';
                this.part1 = '';
                this.part2 = '';
                this.part3 = '';
            } else {
                this.full = '';
            }
        }
    }
}

</script>

@endsection