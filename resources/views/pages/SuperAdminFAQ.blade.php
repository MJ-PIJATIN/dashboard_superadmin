@extends('layouts.faq')
@section('navtitle', 'FAQ')

@section('content')
<div class="p-28 pl-50 bg-gray-100 min-h-screen ml-[-60px] pt-[96px]">
    <div class="max-w-12xl mx-auto">
        <div class="flex justify-between items-center mb-4 mt-1">
            <h1 class="text-xl font-bold text-gray-700">Daftar Pertanyaan</h1>
            <button onclick="openAddModal()" 
                class="absolute right-14 text-white px-4 py-2 rounded transition flex items-center gap-2 bg-[#2196F3] hover:bg-[#1976D2]">
                <img src="{{ asset('images/plus.svg') }}" alt="Tambah" class="h-5 w-5">
                Tambah Pertanyaan Baru
            </button>
        </div>
        <div class="bg-white rounded-lg mt-8 shadow-lg">
            <div class="overflow-x-auto p-2">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-white">
                  <tr>
                  <th class="px-24 py-3 text-left font-sm text-gray-700">Judul</th>
                  <th class="px-4 py-3 text-left font-sm text-gray-700">Deskripsi</th>
                  <th class="px-4 py-3 text-center font-sm text-gray-700"></th>
                </tr>
                <tr>
                  <th colspan="3" class="px-6 pt-0 pb-3">
                    <div class="h-px bg-gray-700 mx-4"></div>
                  </th>
                </tr>
                </thead>
                <tbody id="faqTableBody">
                    @foreach ($faqs as $faq)
                    <tr class="hover:bg-gray-50" data-id="{{ $faq->id }}">
                        <td class="px-24 py-4" data-field="judul">{{ $faq->judul }}</td>
                        <td class="px-4 py-4 cursor-pointer hover:text-blue-600 transition-colors" 
                            data-field="deskripsi" 
                            data-full-desc="{{ $faq->deskripsi }}"
                            onclick="showFullDescription('{{ addslashes($faq->judul) }}', '{{ addslashes($faq->deskripsi) }}')">
                            {{ Str::limit($faq->deskripsi, 100, '...') }}
                        </td>
                        <td class="px-20 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick="openEditModal({{ $faq->id }}, '{{ addslashes($faq->judul) }}', '{{ addslashes($faq->deskripsi) }}')" title="Edit">
                                    <svg width="25" height="25" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M24.3981 5.60043C22.9307 4.13313 20.5518 4.1332 19.0846 5.60058L6.53794 18.1487C6.11132 18.5754 5.81146 19.112 5.67172 19.6989L4.52143 24.5302C4.4581 24.7962 4.53729 25.076 4.73065 25.2693C4.92401 25.4627 5.20384 25.5419 5.46985 25.4786L10.3008 24.3284C10.8879 24.1885 11.4247 23.8886 11.8515 23.4618L24.3982 10.9136C25.8653 9.44633 25.8653 7.06759 24.3981 5.60043ZM20.1983 6.71413C21.0504 5.86185 22.4322 5.86181 23.2844 6.71404C24.1366 7.5662 24.1367 8.94782 23.2845 9.80004L22.3487 10.736L19.2626 7.6499L20.1983 6.71413ZM18.149 8.76358L21.2352 11.8497L10.7378 22.3482C10.5172 22.5689 10.2396 22.724 9.93604 22.7963L6.34987 23.6501L7.20378 20.0638C7.27603 19.7603 7.43106 19.4829 7.65162 19.2623L18.149 8.76358Z" fill="#2196F3"/>
                                    </svg>
                                </button>
                                <button onclick="openDeleteModal({{ $faq->id }}, '{{ addslashes($faq->judul) }}')" title="Hapus">
                                    <svg width="25" height="25" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.951 7.58537H17.0485C17.0485 6.45386 16.1313 5.53659 14.9998 5.53659C13.8682 5.53659 12.951 6.45386 12.951 7.58537ZM11.4144 7.58537C11.4144 5.60522 13.0196 4 14.9998 4C16.9799 4 18.5851 5.60522 18.5851 7.58537H24.4754C24.8997 7.58537 25.2437 7.92935 25.2437 8.35366C25.2437 8.77797 24.8997 9.12195 24.4754 9.12195H23.1241L21.9235 21.5285C21.733 23.4976 20.0782 25 18.0999 25H11.8996C9.92139 25 8.2666 23.4976 8.07604 21.5285L6.8754 9.12195H5.52415C5.09984 9.12195 4.75586 8.77797 4.75586 8.35366C4.75586 7.92935 5.09984 7.58537 5.52415 7.58537H11.4144ZM13.4632 12.4512C13.4632 12.0269 13.1192 11.6829 12.6949 11.6829C12.2706 11.6829 11.9266 12.0269 11.9266 12.4512V20.1341C11.9266 20.5584 12.2706 20.9024 12.6949 20.9024C13.1192 20.9024 13.4632 20.5584 13.4632 20.1341V12.4512ZM17.3046 11.6829C17.7289 11.6829 18.0729 12.0269 18.0729 12.4512V20.1341C18.0729 20.5584 17.7289 20.9024 17.3046 20.9024C16.8803 20.9024 16.5363 20.5584 16.5363 20.1341V12.4512C16.5363 12.0269 16.8803 11.6829 17.3046 11.6829ZM9.60549 21.3805C9.71982 22.562 10.7127 23.4634 11.8996 23.4634H18.0999C19.2868 23.4634 20.2797 22.562 20.394 21.3805L21.5803 9.12195H8.41916L9.60549 21.3805Z" fill="#ED5554"/>
                                    </svg>      
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Lihat Deskripsi Lengkap -->
<div id="modalDeskripsi" class="fixed inset-0 hidden bg-black bg-opacity-30 flex items-center justify-center z-50">
  <div class="relative bg-white rounded-lg p-6 w-[700px] max-w-[90vw] shadow-lg">
    
    <!-- Tombol X -->
    <button onclick="closeModal('modalDeskripsi')" class="absolute top-4 right-4 text-gray-600 hover:text-black text-xl font-bold">
      <img src="{{ asset('images/X.svg') }}" alt="Close" class="w-5 h-5">
    </button>

    <h3 class="text-lg font-semibold mb-4" id="descModalTitle">Detail Pertanyaan</h3>

    <div class="mb-4">
        <label class="block font-semibold text-sm mb-2 text-gray-700">Judul:</label>
        <p class="text-gray-800 bg-gray-50 p-3 rounded border" id="descModalJudul"></p>
    </div>

    <div class="mb-6">
        <label class="block font-semibold text-sm mb-2 text-gray-700">Deskripsi Lengkap:</label>
        <div class="text-gray-800 bg-gray-50 p-4 rounded border max-h-60 overflow-y-auto leading-relaxed" id="descModalContent"></div>
    </div>
  </div>
</div>

<!-- Modal Tambah FAQ -->
<div id="modalTambah" class="fixed inset-0 hidden bg-black bg-opacity-30 flex items-center justify-center z-50">
  <div class="relative bg-white rounded-lg p-6 w-[600px] shadow-lg">
    
    <!-- Tombol X -->
    <button onclick="closeModal('modalTambah')" class="absolute top-4 right-4 text-gray-600 hover:text-black text-xl font-bold">
      <img src="{{ asset('images/X.svg') }}" alt="Close" class="w-5 h-5">
    </button>

    <h3 class="text-lg font-semibold mb-4">Tambah Pertanyaan</h3>

    <form id="addFaqForm">
        @csrf
        <label class="block font-semibold text-sm mb-1">Judul</label>
        <input type="text" id="addJudul" class="w-full border p-2 rounded mb-4" placeholder="Masukkan judul pertanyaan" required>
        <span class="text-red-500 text-sm hidden" id="addJudulError">Judul harus diisi</span>

        <label class="block font-semibold text-sm mb-1">Deskripsi</label>
        <textarea id="addDeskripsi" class="w-full border p-2 rounded mb-4" rows="3" placeholder="Tulis deskripsi pertanyaan" required></textarea>
        <span class="text-red-500 text-sm hidden" id="addDeskripsiError">Deskripsi harus diisi</span>

        <!-- Tombol Simpan -->
        <div class="flex justify-end gap-2">
          <button type="submit" class="bg-[#32C3C9] text-white px-4 py-2 rounded hover:bg-[#29b1b7] transition">
            Tambahkan
          </button>
        </div>
    </form>
  </div>
</div>

<!-- Modal Edit FAQ -->
<div id="modalEdit" class="fixed inset-0 hidden bg-black bg-opacity-30 flex items-center justify-center z-50">
  <div class="relative bg-white rounded-lg p-6 w-[600px] shadow-lg">
    <!-- Tombol X -->
    <button onclick="closeModal('modalEdit')" class="absolute top-4 right-4 text-gray-600 hover:text-black text-xl font-bold">
      <img src="{{ asset('images/X.svg') }}" alt="Close" class="w-5 h-5">
    </button>

    <h1 class="text-lg font-semibold mb-4">Ubah Pertanyaan</h1>

    <form id="editFaqForm">
        @csrf
        @method('PUT')
        <input type="hidden" id="editId">
        
        <label class="block font-semibold text-sm mb-1">Judul</label>
        <input type="text" id="editJudul" class="w-full border p-2 rounded mb-4" required>
        <span class="text-red-500 text-sm hidden" id="editJudulError">Judul harus diisi</span>

        <label class="block font-semibold text-sm mb-1">Deskripsi</label>
        <textarea id="editDeskripsi" class="w-full border p-2 rounded mb-4" rows="3" required></textarea>
        <span class="text-red-500 text-sm hidden" id="editDeskripsiError">Deskripsi harus diisi</span>

        <!-- Tombol Ubah -->
        <div class="flex justify-end gap-2">
          <button type="submit" class="bg-[#32C3C9] text-white px-4 py-2 rounded hover:bg-[#29b1b7] transition">
            Ubah
          </button>
        </div>
    </form>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapus" class="fixed inset-0 hidden bg-black bg-opacity-30 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg p-6 w-[500px] shadow-lg text-center">

    <!-- Judul -->
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Peringatan Sistem</h3>

    <!-- Ikon Peringatan -->
    <div class="flex justify-center mb-4">
      <img src="{{ asset('images/peringatan.svg') }}" alt="Warning" class="w-15 h-15">
    </div>

    <!-- Teks konfirmasi -->
    <p class="text-gray-700 mb-2">Apakah anda yakin ingin menghapus pertanyaan:</p>
    <p class="text-gray-900 font-semibold mb-6" id="deleteItemTitle"></p>

    <!-- Tombol aksi -->
    <div class="flex justify-center gap-10">
      <!-- Tombol Batal -->
      <button onclick="closeModal('modalHapus')" 
              class="flex items-center gap-x-2 px-8 py-1 rounded text-white bg-[#32C3C9] hover:bg-[#2aaeb3] transition">
        Batal
      </button> 

      <!-- Tombol Hapus -->
      <button onclick="confirmDelete()" class="flex items-center gap-x-2 px-8 py-1 rounded text-white bg-[#F44336] hover:bg-[#d32f2f] transition">
        Hapus
      </button>
    </div>

    <input type="hidden" id="deleteId">
  </div>
</div>

<!-- Loading Spinner Drawer -->
<div id="loading-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 70.5px;">
            <div class="flex flex-col items-center mb-4">
                <img src="{{ asset('images/loading.svg') }}" alt="Loading" class="h-30 w-30 animate-spin" />
            </div>
        </div>
    </div>
</div>

<!-- Success Drawer -->
<div id="success-drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
    <div id="success-drawer-overlay" class="flex items-center justify-center h-full">
        <div id="success-drawer-content" class="bg-white rounded-lg shadow-lg" style="width: 400px; padding: 24px; min-height: 280px;">
            <div class="flex flex-col items-center mb-4">
                <h2 class="text-2xl font-bold mb-6" style="color: #469D89;">Berhasil!</h2>
                <img src="{{ asset('images/succed.svg') }}" alt="Success" class="h-30 w-30">
                <p id="success-message" class="text-gray-700 text-center mt-4">Operasi berhasil dilakukan!</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Drawer Manager (tetap dipakai)
    const drawerManager = {
        showLoading: function() {
            document.getElementById('loading-drawer').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        },
        hideLoading: function() {
            document.getElementById('loading-drawer').classList.add('hidden');
            document.body.style.overflow = 'auto';
        },
        showSuccess: function(message = 'Operasi berhasil dilakukan!') {
            document.getElementById('success-message').textContent = message;
            document.getElementById('success-drawer').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            setTimeout(() => this.hideSuccess(), 2000);
        },
        hideSuccess: function() {
            document.getElementById('success-drawer').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    };

    // helper: ambil CSRF token (cari meta dulu, fallback ke input _token)
    function getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        if (meta) return meta.getAttribute('content');
        const tokenInput = document.querySelector('input[name="_token"]');
        return tokenInput ? tokenInput.value : '';
    }

    // Function to show full description
    function showFullDescription(judul, deskripsi) {
        document.getElementById('descModalJudul').textContent = judul;
        document.getElementById('descModalContent').textContent = deskripsi;
        openModal('modalDeskripsi');
    }

    // Modal functions
    function openModal(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.classList.add('hidden');
        document.body.style.overflow = 'auto';
        clearForm(id);
    }

    function clearForm(modalId) {
        if (modalId === 'modalTambah') {
            const form = document.getElementById('addFaqForm');
            if (form) form.reset();
            hideError('addJudulError');
            hideError('addDeskripsiError');
        } else if (modalId === 'modalEdit') {
            hideError('editJudulError');
            hideError('editDeskripsiError');
        }
    }

    function hideError(id) {
        const el = document.getElementById(id);
        if (el) el.classList.add('hidden');
    }

    // Add / Edit / Delete helpers
    function openAddModal() { openModal('modalTambah'); }
    function openEditModal(id, judul, deskripsi) {
        const elId = document.getElementById('editId');
        const elJudul = document.getElementById('editJudul');
        const elDesc = document.getElementById('editDeskripsi');
        if (elId) elId.value = id;
        if (elJudul) elJudul.value = judul;
        if (elDesc) elDesc.value = deskripsi;
        openModal('modalEdit');
    }
    function openDeleteModal(id, judul) {
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteItemTitle').textContent = `"${judul}"`;
        openModal('modalHapus');
    }

    // Confirm delete (tetap menggunakan fetch sederhana seperti sebelumnya — ok)
    function confirmDelete() {
        const id = document.getElementById('deleteId').value;
        if (!id) return;
        drawerManager.showLoading();
        closeModal('modalHapus');

        fetch(`/faqs/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            drawerManager.hideLoading();
            if (response.ok) {
                drawerManager.showSuccess('Pertanyaan berhasil dihapus!');
                setTimeout(() => location.reload(), 1200);
            } else {
                return response.json().then(j => { throw new Error(j.message || 'Gagal menghapus.'); }).catch(()=> { throw new Error('Gagal menghapus.'); });
            }
        })
        .catch(err => {
            drawerManager.hideLoading();
            alert(err.message || 'Gagal menghapus pertanyaan.');
        });
    }

    // --- Validasi forms ---
    function validateForm(formType) {
        let isValid = true;
        const fields = formType === 'add' ? ['addJudul', 'addDeskripsi'] : ['editJudul', 'editDeskripsi'];
        
        fields.forEach(field => {
            const input = document.getElementById(field);
            const error = document.getElementById(`${field}Error`);
            if (!input || input.value.trim() === '') {
                if (error) error.classList.remove('hidden');
                isValid = false;
            } else {
                if (error) error.classList.add('hidden');
            }
        });
        
        return isValid;
    }

    // --- Robust fetch helper untuk form submission ---
async function submitForm(fetchUrl, formElement, method = 'POST') {
    try {
        drawerManager.showLoading();
        
        // Ambil data dari form secara manual untuk memastikan data terkirim
        const formData = new FormData();
        
        if (method === 'PUT') {
            formData.append('_method', 'PUT');
        }
        
        // Tambahkan CSRF token
        formData.append('_token', getCsrfToken());
        
        // Ambil semua input dari form
        const inputs = formElement.querySelectorAll('input[type="text"], textarea, input[type="hidden"]');
        inputs.forEach(input => {
            if (input.name && input.name !== '_token' && input.name !== '_method') {
                formData.append(input.name, input.value);
            }
        });

        const response = await fetch(fetchUrl, {
            method: 'POST', // selalu POST, method override via _method
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            },
            body: formData,
            credentials: 'same-origin'
        });

        // jika ada error status
        if (!response.ok) {
            let errMsg = `Request gagal: ${response.status} ${response.statusText}`;
            try {
                const errJson = await response.json();
                if (errJson && errJson.message) errMsg = errJson.message;
                else if (errJson && errJson.errors) {
                    // Validation errors
                    const firstError = Object.values(errJson.errors)[0];
                    if (Array.isArray(firstError)) errMsg = firstError[0];
                }
            } catch (_e) {
                // ignore parse error
            }
            throw new Error(errMsg);
        }

        // check content-type
        const ct = (response.headers.get('content-type') || '').toLowerCase();
        if (ct.includes('application/json')) {
            return { ok: true, json: await response.json() };
        } else {
            const text = await response.text();
            return { ok: true, html: text };
        }
    } catch (err) {
        return { ok: false, error: err.message || String(err) };
    } finally {
        drawerManager.hideLoading();
    }
}

// --- Event listener: Tambah FAQ (DIPERBAIKI) ---
const addForm = document.getElementById('addFaqForm');
if (addForm) {
    addForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        if (!validateForm('add')) return;

        // Siapkan data manual untuk memastikan terkirim
        const judul = document.getElementById('addJudul').value.trim();
        const deskripsi = document.getElementById('addDeskripsi').value.trim();
        
        if (!judul || !deskripsi) {
            alert('Judul dan deskripsi harus diisi!');
            return;
        }

        closeModal('modalTambah');
        drawerManager.showLoading();

        try {
            const response = await fetch('/faqs', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    judul: judul,
                    deskripsi: deskripsi
                }),
                credentials: 'same-origin'
            });

            drawerManager.hideLoading();

            if (!response.ok) {
                let errMsg = `Gagal menambahkan: ${response.status}`;
                try {
                    const errJson = await response.json();
                    if (errJson.message) errMsg = errJson.message;
                    else if (errJson.errors) {
                        const firstError = Object.values(errJson.errors)[0];
                        if (Array.isArray(firstError)) errMsg = firstError[0];
                    }
                } catch (e) {}
                throw new Error(errMsg);
            }

            const result = await response.json();
            drawerManager.showSuccess('Pertanyaan berhasil ditambahkan!');
            setTimeout(() => location.reload(), 1200);

        } catch (error) {
            drawerManager.hideLoading();
            console.error('Error adding FAQ:', error);
            alert('Gagal menambahkan pertanyaan: ' + error.message);
        }
    });
}

// --- Event listener: Edit FAQ (DIPERBAIKI) ---
const editForm = document.getElementById('editFaqForm');
if (editForm) {
    editForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        if (!validateForm('edit')) return;

        const id = document.getElementById('editId').value;
        const judul = document.getElementById('editJudul').value.trim();
        const deskripsi = document.getElementById('editDeskripsi').value.trim();
        
        if (!id || !judul || !deskripsi) {
            alert('Semua field harus diisi!');
            return;
        }

        closeModal('modalEdit');
        drawerManager.showLoading();

        try {
            const response = await fetch(`/faqs/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    judul: judul,
                    deskripsi: deskripsi
                }),
                credentials: 'same-origin'
            });

            drawerManager.hideLoading();

            if (!response.ok) {
                let errMsg = `Gagal mengubah: ${response.status}`;
                try {
                    const errJson = await response.json();
                    if (errJson.message) errMsg = errJson.message;
                    else if (errJson.errors) {
                        const firstError = Object.values(errJson.errors)[0];
                        if (Array.isArray(firstError)) errMsg = firstError[0];
                    }
                } catch (e) {}
                throw new Error(errMsg);
            }

            const result = await response.json();
            drawerManager.showSuccess('Pertanyaan berhasil diubah!');
            setTimeout(() => location.reload(), 1200);

        } catch (error) {
            drawerManager.hideLoading();
            console.error('Error updating FAQ:', error);
            alert('Gagal mengubah pertanyaan: ' + error.message);
        }
    });
}
</script>

@endsection
