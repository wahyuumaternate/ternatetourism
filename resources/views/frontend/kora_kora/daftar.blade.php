<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Pendaftaran Lomba dengan Texture Background</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('kora_kora/tex.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #aaa;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background-color: #008977;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #02a48f;
        }

        /* Modal styles */
        .modal {
            display: none;
            /* hidden default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            box-shadow: 0 0 10px #333;
        }

        .modal-content h3 {
            margin-top: 0;
        }

        .modal-footer {
            margin-top: 20px;
            text-align: right;
        }

        .modal-footer button {
            width: auto;
            padding: 8px 16px;
            margin-left: 10px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Logo bar */
        .top-logos {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .top-logos img {
            height: 75px;
        }
    </style>
</head>

<body>
    <!-- Logo Bar Atas -->
    <div class="top-logos">
        <img src="{{ asset('kora_kora/logo-kementrian.png') }}" alt="Kemenparekraf" width="80" height="80" />
        <img src="{{ asset('kora_kora/logo kota.png') }}" alt="Logo Kota Ternate" />
        <img src="{{ asset('kora_kora/LOGO_KEN (1).png') }}" alt="KEN 2025" />
        <img src="{{ asset('kora_kora/wi.png') }}" alt="Wonderful Indonesia" />
        <img src="{{ asset('kora_kora/kora-kora.png') }}" alt="Festival Kora-Kora" />
    </div>

    <div class="container">
        <h2>Pendaftaran Lomba</h2>
        <form id="registrationForm">
            <label for="nama_tim_orang">Nama Tim/Pendaftar</label>
            <input type="text" id="nama_tim_orang" name="nama_tim_orang" required />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required />

            <label for="instansi_utusan">unit kerja/instansi/utusan</label>
            <input type="text" id="instansi_utusan" name="instansi_utusan" required />

            <label for="id_kategori">Kategori</label>
            <select id="id_kategori" name="id_kategori" required>
                <option value="">Memuat kategori...</option>
            </select>

            <button type="submit">Daftar</button>
        </form>
    </div>

    <!-- Modal Syarat dan Ketentuan -->
    <div id="syaratModal" class="modal" style="display:none;">
        <div class="modal-content">
            <h3>Syarat dan Ketentuan</h3>
            <p id="persyaratanText">Memuat syarat...</p>
            <label class="checkbox-label">
                <input type="checkbox" id="agreeCheckbox" />
                Saya setuju dengan syarat dan ketentuan di atas
            </label>
            <div class="modal-footer">
                <button id="cancelBtn" type="button">Batal</button>
                <button id="confirmBtn" type="button" disabled>Setuju & Kirim</button>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById("registrationForm");
        const modal = document.getElementById("syaratModal");
        const agreeCheckbox = document.getElementById("agreeCheckbox");
        const confirmBtn = document.getElementById("confirmBtn");
        const cancelBtn = document.getElementById("cancelBtn");
        let kategoris = [];

        // Load kategori dari API
        async function loadKategoris() {
            const select = document.getElementById('id_kategori');
            try {
                const response = await fetch('https://dashboard-lomba.ternatetourism.com/api/kategoris');
                kategoris = await response.json();

                select.innerHTML = '<option value="">-- Pilih Kategori --</option>';
                kategoris.forEach(kat => {
                    const option = document.createElement('option');
                    option.value = kat.id;
                    option.textContent = kat.nama_kategori;
                    select.appendChild(option);
                });
            } catch (error) {
                select.innerHTML = '<option value="">Gagal memuat kategori</option>';
                console.error('Gagal ambil kategori:', error);
            }
        }

        // Update persyaratan modal sesuai kategori dipilih
        function updatePersyaratan(kategoriId) {
            const syaratP = document.getElementById('persyaratanText');
            if (!kategoriId) {
                syaratP.textContent = 'Pilih kategori terlebih dahulu untuk melihat syarat dan ketentuan.';
                return;
            }
            const kategori = kategoris.find(k => k.id === parseInt(kategoriId));
            if (kategori) {
                syaratP.textContent = kategori.persyaratan || 'Tidak ada persyaratan khusus untuk kategori ini.';
            } else {
                syaratP.textContent = 'Data persyaratan tidak ditemukan.';
            }
        }

        // Ketika halaman siap
        document.addEventListener('DOMContentLoaded', () => {
            loadKategoris();

            const select = document.getElementById('id_kategori');
            select.addEventListener('change', (e) => {
                updatePersyaratan(e.target.value);
            });

            updatePersyaratan('');

            // Form submit - hanya buka modal
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const kategoriId = form.id_kategori.value;
                if (!kategoriId) {
                    alert('Silakan pilih kategori terlebih dahulu.');
                    return;
                }
                updatePersyaratan(kategoriId);
                agreeCheckbox.checked = false;
                confirmBtn.disabled = true;
                modal.style.display = "block";
            });
        });

        // Enable/disable tombol setuju di modal
        agreeCheckbox.addEventListener("change", () => {
            confirmBtn.disabled = !agreeCheckbox.checked;
        });

        // Batal modal
        cancelBtn.addEventListener("click", () => {
            modal.style.display = "none";
            agreeCheckbox.checked = false;
            confirmBtn.disabled = true;
        });

        // Klik luar modal untuk tutup
        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
                agreeCheckbox.checked = false;
                confirmBtn.disabled = true;
            }
        });

        // Tombol Setuju & Kirim -> submit data ke API
        confirmBtn.addEventListener("click", async () => {
            confirmBtn.disabled = true; // prevent multiple clicks
            const data = {
                nama_tim_orang: form.nama_tim_orang.value,
                email: form.email.value,
                instansi_utusan: form.instansi_utusan.value,
                id_kategori: parseInt(form.id_kategori.value),
            };

            try {
                const response = await fetch('https://dashboard-lomba.ternatetourism.com/api/pendaftars', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Pendaftaran berhasil!');
                    form.reset();
                    modal.style.display = "none";
                    agreeCheckbox.checked = false;
                    confirmBtn.disabled = true;
                    updatePersyaratan('');
                } else {
                    alert('Gagal: ' + (result.message || 'Terjadi kesalahan'));
                    confirmBtn.disabled = false;
                }
            } catch (error) {
                alert('Kesalahan jaringan: ' + error.message);
                confirmBtn.disabled = false;
            }
        });
    </script>
</body>

</html>
