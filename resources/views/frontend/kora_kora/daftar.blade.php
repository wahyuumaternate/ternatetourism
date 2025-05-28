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

            <label for="instansi_utusan">Instansi Utusan</label>
            <input type="text" id="instansi_utusan" name="instansi_utusan" required />

            <label for="id_kategori">Kategori</label>
            <select id="id_kategori" name="id_kategori" required>
                <option value="">Memuat kategori...</option>
            </select>

            <button type="submit">Daftar</button>
        </form>
    </div>

    <!-- Modal Syarat dan Ketentuan -->
    <div id="syaratModal" class="modal">
        <div class="modal-content">
            <h3>Syarat dan Ketentuan</h3>
            <p>
                Dengan mendaftar lomba ini, peserta setuju untuk mematuhi semua aturan
                yang berlaku selama festival berlangsung. Peserta wajib mengikuti
                semua instruksi panitia dan bertanggung jawab atas keselamatan diri
                sendiri. Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Recusandae atque itaque vel necessitatibus consectetur perspiciatis
                iste corporis suscipit reiciendis dicta maiores rerum, vero officiis
                veritatis? Ex corrupti atque qui. Eum, rerum nemo maiores similique
                eos quibusdam voluptatum blanditiis maxime quos reiciendis accusamus
                dicta corrupti. Autem ducimus facere officiis, natus cum earum quia
                voluptatibus quos hic aliquid vero itaque consequatur commodi dolore
                quas recusandae voluptatem laborum ipsa? Obcaecati voluptatibus
                quibusdam sit, reiciendis sint officia cum consequatur velit, veniam
                fugiat natus nam aperiam recusandae architecto et amet nesciunt.
                Voluptates vel, aliquid vitae hic quos perferendis praesentium nisi
                nemo repellat illum corporis ipsum!
            </p>
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

        form.addEventListener("submit", function(e) {
            e.preventDefault(); // stop submit dulu
            // Tampilkan modal syarat dan ketentuan
            modal.style.display = "block";
        });

        agreeCheckbox.addEventListener("change", function() {
            confirmBtn.disabled = !this.checked;
        });

        cancelBtn.addEventListener("click", function() {
            modal.style.display = "none";
            agreeCheckbox.checked = false;
            confirmBtn.disabled = true;
        });

        confirmBtn.addEventListener("click", function() {
            modal.style.display = "none";
            alert("Terima kasih sudah mendaftar!");
            form.reset();
        });

        // Klik di luar modal untuk tutup
        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
                agreeCheckbox.checked = false;
                confirmBtn.disabled = true;
            }
        });
    </script>
    <script>
        // Fungsi untuk ambil kategori dari API dan isi ke dalam <select>
        async function loadKategoris() {
            const select = document.getElementById('id_kategori');
            try {
                const response = await fetch('https://dashboard-lomba.ternatetourism.com/api/kategoris');
                const kategoris = await response.json();

                // Kosongkan select
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

        // Jalankan fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadKategoris);

        // Tangani submit form
        document.getElementById('registrationForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const data = {
                nama_tim_orang: e.target.nama_tim_orang.value,
                email: e.target.email.value,
                instansi_utusan: e.target.instansi_utusan.value,
                id_kategori: parseInt(e.target.id_kategori.value),
            };

            try {
                const response = await fetch('https://dashboard-lomba.ternatetourism.com/api/pendaftars', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                        // Tambahkan Authorization jika dibutuhkan
                        // 'Authorization': 'Bearer YOUR_TOKEN'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Pendaftaran berhasil!');
                    e.target.reset();
                } else {
                    alert('Gagal: ' + (result.message || 'Terjadi kesalahan'));
                }
            } catch (error) {
                alert('Kesalahan jaringan: ' + error.message);
            }
        });
    </script>


</body>

</html>
