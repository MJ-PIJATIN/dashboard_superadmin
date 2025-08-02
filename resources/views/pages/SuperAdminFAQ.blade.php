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
                    @foreach ([
                        ['id' => 1, 'judul' => 'Apa itu massage?', 'deskripsi' => 'Massage merupakan suatu teknik perawatan tubuh yang menggunakan gerakan tangan, tekanan, dan manipulasi jaringan lunak untuk memberikan relaksasi, mengurangi stres, dan meningkatkan kesehatan secara keseluruhan.'],
                        ['id' => 2, 'judul' => 'Bagaimana saya bisa menemukan terapis yang baik?', 'deskripsi' => 'Untuk menemukan terapis yang baik, pastikan untuk mengecek kualifikasi dan sertifikasi mereka, cari referensi atau ulasan dari pelanggan sebelumnya, tanyakan pengalaman mereka, dan pastikan mereka terdaftar secara resmi.'],
                        ['id' => 3, 'judul' => 'Berapa biaya rata-rata untuk layanan massage?', 'deskripsi' => 'Harga layanan massage bervariasi tergantung jenis treatment, lokasi, dan kualitas tempat. Umumnya harga mulai dari 100 ribu rupiah untuk massage tradisional hingga 500 ribu rupiah untuk treatment premium di spa mewah.'],
                        ['id' => 4, 'judul' => 'Seberapa sering saya sebaiknya mendapatkan massage?', 'deskripsi' => 'Frekuensi massage tergantung pada kebutuhan individu. Untuk relaksasi umum, 1 minggu sekali sudah cukup, namun untuk kondisi tertentu atau stress tinggi bisa 2-3 kali seminggu sesuai anjuran terapis.'],
                        ['id' => 5, 'judul' => 'Apakah ada risiko atau efek samping dari massage?', 'deskripsi' => 'Meskipun umumnya aman, massage dapat menimbulkan beberapa risiko seperti memar ringan, nyeri otot sementara, atau reaksi alergi terhadap minyak. Hindari massage jika memiliki kondisi medis tertentu tanpa konsultasi dokter.']
                    ] as $faq)
                    <tr class="hover:bg-gray-50" data-id="{{ $faq['id'] }}">
                        <td class="px-24 py-4" data-field="judul">{{ $faq['judul'] }}</td>
                        <td class="px-4 py-4 cursor-pointer hover:text-blue-600 transition-colors" 
                            data-field="deskripsi" 
                            data-full-desc="{{ $faq['deskripsi'] }}"
                            onclick="showFullDescription('{{ addslashes($faq['judul']) }}', '{{ addslashes($faq['deskripsi']) }}')">
                            {{ Str::limit($faq['deskripsi'], 50, '...') }}
                        </td>
                        <td class="px-20 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick="openEditModal({{ $faq['id'] }}, '{{ addslashes($faq['judul']) }}', '{{ addslashes($faq['deskripsi']) }}')" title="Edit">
                                    <img src="{{ asset('images/edit.svg') }}" alt="Edit" class="h-5 w-5 hover:opacity-80">
                                </button>
                                <button onclick="openDeleteModal({{ $faq['id'] }}, '{{ addslashes($faq['judul']) }}')" title="Hapus">
                                    <img src="{{ asset('images/delete.svg') }}" alt="Hapus" class="h-5 w-5 hover:opacity-80">
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

    <!-- Tombol Tutup -->
    <div class="flex justify-end">
      <button onclick="closeModal('modalDeskripsi')" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition">
        Tutup
      </button>
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
        <label class="block font-semibold text-sm mb-1">Judul</label>
        <input type="text" id="addJudul" class="w-full border p-2 rounded mb-4" placeholder="Masukkan judul pertanyaan" required>
        <span class="text-red-500 text-sm hidden" id="addJudulError">Judul harus diisi</span>

        <label class="block font-semibold text-sm mb-1">Deskripsi</label>
        <textarea id="addDeskripsi" class="w-full border p-2 rounded mb-4" rows="3" placeholder="Tulis deskripsi pertanyaan" required></textarea>
        <span class="text-red-500 text-sm hidden" id="addDeskripsiError">Deskripsi harus diisi</span>

        <!-- Tombol Simpan -->
        <div class="flex justify-end gap-2">
          <button type="button" onclick="closeModal('modalTambah')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
            Batal
          </button>
          <button type="submit" class="bg-[#32C3C9] text-white px-4 py-2 rounded hover:bg-[#29b1b7] transition">
            Simpan
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
        <input type="hidden" id="editId">
        
        <label class="block font-semibold text-sm mb-1">Judul</label>
        <input type="text" id="editJudul" class="w-full border p-2 rounded mb-4" required>
        <span class="text-red-500 text-sm hidden" id="editJudulError">Judul harus diisi</span>

        <label class="block font-semibold text-sm mb-1">Deskripsi</label>
        <textarea id="editDeskripsi" class="w-full border p-2 rounded mb-4" rows="3" required></textarea>
        <span class="text-red-500 text-sm hidden" id="editDeskripsiError">Deskripsi harus diisi</span>

        <!-- Tombol Ubah -->
        <div class="flex justify-end gap-2">
          <button type="button" onclick="closeModal('modalEdit')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
            Batal
          </button>
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
    let faqData = [];
    let nextId = 6;

    // Drawer Manager
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
            
            // Auto hide after 2 seconds
            setTimeout(() => {
                this.hideSuccess();
            }, 2000);
        },
        
        hideSuccess: function() {
            document.getElementById('success-drawer').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    };

    // Initialize FAQ data from blade template
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('#faqTableBody tr');
        rows.forEach(row => {
            const id = parseInt(row.getAttribute('data-id'));
            const judul = row.querySelector('[data-field="judul"]').textContent;
            const deskripsi = row.querySelector('[data-field="deskripsi"]').getAttribute('data-full-desc');
            faqData.push({ id, judul, deskripsi });
        });

        // Success drawer overlay click handler
        const successOverlay = document.getElementById('success-drawer-overlay');
        if (successOverlay) {
            successOverlay.addEventListener('click', function(e) {
                if (e.target === this) {
                    drawerManager.hideSuccess();
                }
            });
        }

        // Prevent success drawer content clicks from closing drawer
        const successContent = document.getElementById('success-drawer-content');
        if (successContent) {
            successContent.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    });

    // Function to show full description
    function showFullDescription(judul, deskripsi) {
        document.getElementById('descModalJudul').textContent = judul;
        document.getElementById('descModalContent').textContent = deskripsi;
        openModal('modalDeskripsi');
    }

    // Function to truncate text
    function truncateText(text, maxLength = 50) {
        if (text.length <= maxLength) return text;
        return text.substring(0, maxLength) + '...';
    }

    // Modal functions
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent background scroll
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto'; // Restore scroll
        clearForm(id);
    }

    // Clear form data when closing modal
    function clearForm(modalId) {
        if (modalId === 'modalTambah') {
            document.getElementById('addJudul').value = '';
            document.getElementById('addDeskripsi').value = '';
            hideError('addJudulError');
            hideError('addDeskripsiError');
        } else if (modalId === 'modalEdit') {
            hideError('editJudulError');
            hideError('editDeskripsiError');
        }
    }

    // Add FAQ functions
    function openAddModal() {
        openModal('modalTambah');
    }

    // Edit FAQ functions
    function openEditModal(id, judul, deskripsi) {
        document.getElementById('editId').value = id;
        document.getElementById('editJudul').value = judul;
        document.getElementById('editDeskripsi').value = deskripsi;
        openModal('modalEdit');
    }

    // Delete FAQ functions
    function openDeleteModal(id, judul) {
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteItemTitle').textContent = `"${judul}"`;
        openModal('modalHapus');
    }

    function confirmDelete() {
        const id = parseInt(document.getElementById('deleteId').value);
        
        // Show loading
        drawerManager.showLoading();
        closeModal('modalHapus');
        
        // Simulate API call delay
        setTimeout(() => {
            // Remove from array
            faqData = faqData.filter(faq => faq.id !== id);
            
            // Remove from DOM
            const row = document.querySelector(`tr[data-id="${id}"]`);
            if (row) {
                row.remove();
            }

            // Hide loading and show success
            drawerManager.hideLoading();
            drawerManager.showSuccess('Pertanyaan berhasil dihapus!');
        }, 1000);
    }

    // Form validation
    function validateForm(formType) {
        let isValid = true;
        
        if (formType === 'add') {
            const judul = document.getElementById('addJudul').value.trim();
            const deskripsi = document.getElementById('addDeskripsi').value.trim();
            
            if (!judul) {
                showError('addJudulError');
                isValid = false;
            } else {
                hideError('addJudulError');
            }
            
            if (!deskripsi) {
                showError('addDeskripsiError');
                isValid = false;
            } else {
                hideError('addDeskripsiError');
            }
        } else if (formType === 'edit') {
            const judul = document.getElementById('editJudul').value.trim();
            const deskripsi = document.getElementById('editDeskripsi').value.trim();
            
            if (!judul) {
                showError('editJudulError');
                isValid = false;
            } else {
                hideError('editJudulError');
            }
            
            if (!deskripsi) {
                showError('editDeskripsiError');
                isValid = false;
            } else {
                hideError('editDeskripsiError');
            }
        }
        
        return isValid;
    }

    function showError(elementId) {
        document.getElementById(elementId).classList.remove('hidden');
    }

    function hideError(elementId) {
        document.getElementById(elementId).classList.add('hidden');
    }

    // Add FAQ form submission
    document.getElementById('addFaqForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm('add')) {
            return;
        }

        const judul = document.getElementById('addJudul').value.trim();
        const deskripsi = document.getElementById('addDeskripsi').value.trim();
        
        // Show loading
        drawerManager.showLoading();
        closeModal('modalTambah');
        
        // Simulate API call delay
        setTimeout(() => {
            // Add to array
            const newFaq = { id: nextId++, judul, deskripsi };
            faqData.push(newFaq);
            
            // Add to DOM
            addRowToTable(newFaq);
            
            // Hide loading and show success
            drawerManager.hideLoading();
            drawerManager.showSuccess('Pertanyaan berhasil ditambahkan!');
        }, 1000);
    });

    // Edit FAQ form submission
    document.getElementById('editFaqForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm('edit')) {
            return;
        }

        const id = parseInt(document.getElementById('editId').value);
        const judul = document.getElementById('editJudul').value.trim();
        const deskripsi = document.getElementById('editDeskripsi').value.trim();
        
        // Show loading
        drawerManager.showLoading();
        closeModal('modalEdit');
        
        // Simulate API call delay
        setTimeout(() => {
            // Update array
            const faqIndex = faqData.findIndex(faq => faq.id === id);
            if (faqIndex !== -1) {
                faqData[faqIndex].judul = judul;
                faqData[faqIndex].deskripsi = deskripsi;
            }
            
            // Update DOM
            const row = document.querySelector(`tr[data-id="${id}"]`);
            if (row) {
                row.querySelector('[data-field="judul"]').textContent = judul;
                const descCell = row.querySelector('[data-field="deskripsi"]');
                descCell.textContent = truncateText(deskripsi, 50);
                descCell.setAttribute('data-full-desc', deskripsi);
                descCell.setAttribute('onclick', `showFullDescription('${judul.replace(/'/g, "\\'")}', '${deskripsi.replace(/'/g, "\\'")}');`);
                
                // Update button onclick attributes
                const editBtn = row.querySelector('button[title="Edit"]');
                const deleteBtn = row.querySelector('button[title="Hapus"]');
                
                editBtn.setAttribute('onclick', `openEditModal(${id}, '${judul.replace(/'/g, "\\'")}', '${deskripsi.replace(/'/g, "\\'")}')`);
                deleteBtn.setAttribute('onclick', `openDeleteModal(${id}, '${judul.replace(/'/g, "\\'")}')`);
            }
            
            // Hide loading and show success
            drawerManager.hideLoading();
            drawerManager.showSuccess('Pertanyaan berhasil diubah!');
        }, 1000);
    });

    // Add new row to table
    function addRowToTable(faq) {
        const tbody = document.getElementById('faqTableBody');
        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50';
        row.setAttribute('data-id', faq.id);
        
        row.innerHTML = `
            <td class="px-24 py-4" data-field="judul">${faq.judul}</td>
            <td class="px-4 py-4 cursor-pointer hover:text-blue-600 transition-colors" 
                data-field="deskripsi" 
                data-full-desc="${faq.deskripsi}"
                onclick="showFullDescription('${faq.judul.replace(/'/g, "\\'")}', '${faq.deskripsi.replace(/'/g, "\\'")}')">
                ${truncateText(faq.deskripsi, 50)}
            </td>
            <td class="px-20 py-4 text-center">
                <div class="flex justify-center gap-2">
                    <button onclick="openEditModal(${faq.id}, '${faq.judul.replace(/'/g, "\\'")}', '${faq.deskripsi.replace(/'/g, "\\'")}');" title="Edit">
                        <img src="{{ asset('images/edit.svg') }}" alt="Edit" class="h-5 w-5 hover:opacity-80">
                    </button>
                    <button onclick="openDeleteModal(${faq.id}, '${faq.judul.replace(/'/g, "\\'")}')" title="Hapus">
                        <img src="{{ asset('images/delete.svg') }}" alt="Hapus" class="h-5 w-5 hover:opacity-80">
                    </button>
                </div>
            </td>
        `;
        
        tbody.appendChild(row);
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        const modals = ['modalTambah', 'modalEdit', 'modalHapus', 'modalDeskripsi'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (e.target === modal) {
                closeModal(modalId);
            }
        });
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modals = ['modalTambah', 'modalEdit', 'modalHapus', 'modalDeskripsi'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (!modal.classList.contains('hidden')) {
                    closeModal(modalId);
                }
            });
            
            // Also close success drawer with Escape
            const successDrawer = document.getElementById('success-drawer');
            if (!successDrawer.classList.contains('hidden')) {
                drawerManager.hideSuccess();
            }
        }
    });
</script>
@endsection