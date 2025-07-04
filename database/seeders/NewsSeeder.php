<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Category;
use App\Models\Owner;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Nonaktifkan foreign key checks untuk mengizinkan truncate
        Schema::disableForeignKeyConstraints();

        // 2. Truncate tabel dalam urutan yang benar (dari child ke parent)
        News::truncate();
        Category::truncate();
        Owner::truncate();

        // 3. Aktifkan kembali foreign key checks
        Schema::enableForeignKeyConstraints();

        // 4. Buat data master (Owner dan Category) terlebih dahulu
        $owner = Owner::create([
            'name' => 'Admin Lytheria',
            'job' => 'Server Administrator',
            'quote' => 'Membangun dunia yang lebih baik, satu blok pada satu waktu.',
            'profile_image_url' => 'https://i.ibb.co/PZpRPPgq/avatar-Head-1.png',
            'skin_image_url' => 'https://i.ibb.co/PZpRPPgq/avatar-Head-1.png',
            'head_skin_image_url' => 'https://i.ibb.co/PZpRPPgq/avatar-Head-1.png',
        ]);

        // Membuat kategori tanpa kolom 'slug'
        $categories = [
            'Pembaruan Game' => Category::create(['name' => 'Pembaruan Game', 'description' => 'Berita seputar pembaruan game.']),
            'Event Komunitas' => Category::create(['name' => 'Event Komunitas', 'description' => 'Berita seputar event komunitas.']),
            'Info Server' => Category::create(['name' => 'Info Server', 'description' => 'Informasi penting seputar server.']),
        ];

        $imageUrl = 'https://www.nintendo.com/eu/media/images/10_share_images/games_15/nintendo_switch_4/2x1_NSwitch_Minecraft.jpg';

        // 5. Buat data berita
        $newsData = [
            [
                'category_id' => $categories['Pembaruan Game']->id,
                'title' => 'Minecraft Berinovasi dengan Pembaruan Lebih Rutin: "Spring to Life" dan "Chase the Skies" Resmi Diumumkan!',
                'published_at' => now()->subDays(1),
                'content' => <<<MARKDOWN
# Minecraft Berinovasi dengan Pembaruan Lebih Rutin: "Spring to Life" dan "Chase the Skies" Resmi Diumumkan!

_Mojang Studios kembali menunjukkan komitmennya untuk terus menghidupkan dunia Minecraft dengan pendekatan pembaruan yang lebih segar dan berkala. Melalui pengumuman terbaru, kita diperkenalkan pada dua pembaruan penting: **"Spring to Life"** yang telah dirilis pada Maret 2025, dan **"Chase the Skies"** yang dijadwalkan hadir bulan ini, Juni 2025. Perubahan strategi ini menandai transisi dari pembaruan raksasa yang terpisah menjadi serangkaian pembaruan yang lebih kecil namun konsisten sepanjang tahun._

Pendekatan baru ini memungkinkan Mojang untuk lebih responsif terhadap _feedback_ komunitas dan menghadirkan konten segar secara lebih sering, menjaga pengalaman bermain tetap dinamis dan menarik. Kedua pembaruan ini akan tersedia untuk **Java Edition** maupun **Bedrock Edition**, memastikan semua pemain dapat menikmati fitur-fitur baru.

---

### Pembaruan "Spring to Life" (Maret 2025): Overworld yang Lebih Hidup dan Detail!

Pembaruan yang telah mendarat pada bulan Maret lalu ini benar-benar fokus pada peningkatan keindahan dan imersi di dunia Overworld. "Spring to Life" membawa sentuhan detail yang membuat eksplorasi terasa lebih hidup:

* **Semak Kunang-kunang (Firefly Bushes):** Tambahan estetika yang indah di bioma hutan dan rawa pada malam hari. Semak-semak ini akan memancarkan cahaya lembut dari kunang-kunang yang berkedip, menciptakan suasana magis.
* **Dedaunan Berguguran (Falling Leaves):** Pohon-pohon di beberapa bioma kini akan menampilkan animasi dedaunan yang berguguran, memberikan nuansa musiman yang lebih realistis dan hidup pada lingkungan.
* **Bisikan Pasir (Whispering Sands):** Di bioma gurun, efek suara ambient baru dari "bisikan pasir" akan menambah kedalaman atmosfer, membuat gurun terasa lebih luas dan misterius.
* **Variasi Hewan Baru:** Sapi, babi, dan ayam kini hadir dengan variasi tekstur dan model yang lebih beragam. Ini tidak hanya meningkatkan realisme visual tetapi juga membuat dunia terasa lebih penuh kehidupan.
* **Efek Suara & Visual Baru:** Serangkaian efek suara dan visual kecil lainnya telah ditambahkan untuk meningkatkan imersi, mulai dari suara langkah kaki yang lebih bervariasi hingga partikel ambient yang lebih halus.

> "Kami ingin Overworld terasa lebih dinamis dan responsif terhadap lingkungan. 'Spring to Life' adalah langkah pertama dalam menciptakan dunia yang lebih hidup yang terus berubah dan mengejutkan para pemain," ujar seorang perwakilan Mojang Studios dalam rilis pers mereka.

---

### Menanti "Chase the Skies" (Juni 2025): Misteri di Atas Awan?

Meskipun "Spring to Life" telah membawa banyak peningkatan darat, perhatian kini beralih ke pembaruan **"Chase the Skies"** yang dijadwalkan rilis pada bulan Juni ini. Sayangnya, detail spesifik mengenai fitur-fitur yang akan dibawa oleh pembaruan ini masih diselimuti misteri.

Nama "Chase the Skies" sendiri telah memicu berbagai spekulasi di komunitas. Apakah ini akan melibatkan:

* **Ekspansi di Ketinggian?** Mungkin ada bioma awan baru atau struktur yang dapat ditemukan jauh di atas permukaan tanah.
* **Peningkatan Mekanisme Penerbangan?** Bisa jadi _Elytra_ akan mendapatkan _upgrade_ atau ada item baru yang mempermudah navigasi di udara.
* **Makhluk Langit Baru?** Kemungkinan monster atau hewan pasif yang mendiami ketinggian.

![Ilustrasi Konsep: Pemain Mengejar Objek Misterius di Langit Minecraft](https://i.imgur.com/chasetheskies_concept.png "Apa yang menanti di atas awan?")

_Ilustrasi konsep ini, dibuat oleh komunitas, mencoba membayangkan apa yang mungkin menanti dalam pembaruan "Chase the Skies". (Catatan: Ini adalah placeholder, tautan gambar tidak nyata dan hanya untuk tujuan ilustrasi)._

Mojang berjanji akan mengumumkan detail lebih lanjut mengenai "Chase the Skies" dalam waktu dekat, kemungkinan melalui video _sneak peek_ atau artikel di situs resmi mereka. Mengingat tren pembaruan kecil, kita bisa berharap akan ada beberapa fitur baru yang menarik dan fokus pada aspek vertikal permainan.

---

**Era Baru Pembaruan Minecraft:**

Transisi Mojang ke model pembaruan yang lebih rutin dan kecil sepanjang tahun ini disambut baik oleh banyak pemain. Ini berarti aliran konten segar yang lebih konsisten, menjaga _game_ tetap terasa baru tanpa perlu menunggu berbulan-bulan atau bahkan setahun untuk pembaruan besar berikutnya.

Pastikan untuk terus memantau [Situs Resmi Minecraft](https://www.minecraft.net/en-us/news) (tautan ke halaman berita umum Minecraft) dan saluran media sosial Mojang untuk pengumuman resmi tentang "Chase the Skies" yang akan datang! Bersiaplah untuk menjelajahi Overworld yang lebih hidup dan mungkin, mengejar langit itu sendiri!
MARKDOWN
            ],
            [
                'category_id' => $categories['Event Komunitas']->id,
                'title' => 'Event Lomba Membangun "Kerajaan Bawah Air" Dimulai!',
                'published_at' => now()->subDays(5),
                'content' => <<<MARKDOWN
# Event Lomba Membangun "Kerajaan Bawah Air" Dimulai!

_Para arsitek dan pembangun di Lytheria, siapkan prisma dan balok koral kalian! Event komunitas yang paling ditunggu-tunggu bulan ini, **Lomba Membangun "Kerajaan Bawah Air"**, secara resmi telah dibuka!_

Kami menantang kreativitas kalian untuk membangun istana, kota, atau bahkan ekosistem bawah laut yang paling megah dan imajinatif. Tunjukkan pada kami visi kalian tentang sebuah kerajaan yang tersembunyi di kedalaman samudra.

---

### Detail Event

* **Tema:** Kerajaan Bawah Air
* **Lokasi:** Plot khusus telah disediakan di `/warp event-build`.
* **Durasi:** Event akan berlangsung dari tanggal 5 Juli hingga 20 Juli 2025.
* **Penjurian:** Akan dilakukan oleh tim admin pada tanggal 21 Juli 2025.

### Kriteria Penilaian

1.  **Kreativitas dan Orisinalitas:** Seberapa unik dan imajinatif konsep kerajaan Anda?
2.  **Detail dan Estetika:** Penggunaan blok, palet warna, dan detail arsitektur.
3.  **Kesesuaian Tema:** Seberapa baik bangunan Anda mencerminkan kehidupan dan kemegahan bawah laut.
4.  **Fungsionalitas Interior:** Apakah bangunan Anda memiliki interior yang menarik dan berfungsi?

### Hadiah Pemenang

* **Juara 1:** Rank **Aqua Lord** eksklusif selama 1 bulan + 10 Legendary Crate Keys.
* **Juara 2:** 5 Legendary Crate Keys + 5 Juta Uang In-Game.
* **Juara 3:** 3 Legendary Crate Keys + 2 Juta Uang In-Game.

> Semua peserta yang menyelesaikan bangunannya akan mendapatkan hadiah partisipasi berupa 1 Crate Key spesial!

Kami tidak sabar untuk melihat mahakarya yang akan kalian ciptakan. Ambil peralatan selam kalian dan mulailah membangun! Semoga berhasil!
MARKDOWN
            ],
            [
                'category_id' => $categories['Info Server']->id,
                'title' => 'Panduan Ekonomi Server: Cara Cepat Menjadi Kaya di Lytheria',
                'published_at' => now()->subDays(10),
                'content' => <<<MARKDOWN
# Panduan Ekonomi Server: Cara Cepat Menjadi Kaya di Lytheria

_Bagi para pemain baru maupun lama, memahami sistem ekonomi di Lytheria SMP adalah kunci untuk meraih kesuksesan. Dalam panduan ini, kami akan membagikan beberapa tips dan trik untuk mengumpulkan kekayaan dengan cepat dan efisien._

Ekonomi server kami dirancang untuk menjadi dinamis dan digerakkan oleh pemain. Dengan strategi yang tepat, Anda bisa menjadi seorang taipan di dunia Lytheria.

---

### 1. Manfaatkan Toko Server (`/shop`)

Toko server adalah cara termudah untuk menjual hasil farm Anda. Beberapa item yang selalu memiliki permintaan tinggi adalah:

* **Hasil Pertanian:** Gandum, Wortel, Kentang, dan terutama Tebu.
* **Hasil Tambang:** Besi, Emas, dan Berlian selalu menjadi komoditas panas.
* **Mob Drops:** Gunpowder, String, dan Ender Pearl sangat dicari untuk crafting.

### 2. Buka Toko Pemain (Player Shops)

Setelah memiliki modal, jangan ragu untuk membuka toko Anda sendiri di area pasar `/warp market`. Jual item-item langka atau hasil crafting yang tidak tersedia di toko server.

> **Pro Tip:** Perhatikan item apa yang sedang langka atau banyak dicari pemain lain. Menjual item seperti Shulker Box, Elytra, atau buku sihir (enchanted books) dengan harga kompetitif bisa menjadi sumber pendapatan yang luar biasa.

### 3. Selesaikan Misi Harian (`/quests`)

Jangan lupakan misi harian! Menyelesaikan misi-misi ini tidak hanya memberikan hadiah item tetapi juga sejumlah uang yang lumayan. Ini adalah cara yang konsisten untuk mendapatkan pemasukan setiap hari.

### 4. Berpartisipasi dalam Event Ekonomi

Kami secara rutin mengadakan event yang berfokus pada ekonomi, seperti "Fishing Contest" atau "Mining Frenzy". Berpartisipasi dalam event ini adalah cara yang menyenangkan untuk mendapatkan hadiah uang tunai dalam jumlah besar.

Dengan mengikuti tips di atas, kami yakin Anda akan segera melihat pundi-pundi uang Anda bertambah. Selamat berbisnis!
MARKDOWN
            ],
            [
                'category_id' => $categories['Pembaruan Game']->id,
                'title' => 'Pembaruan Anti-Cheat dan Peningkatan Keamanan Server',
                'published_at' => now()->subDays(15),
                'content' => <<<MARKDOWN
# Pembaruan Anti-Cheat dan Peningkatan Keamanan Server

_Untuk menjaga lingkungan bermain yang adil dan menyenangkan bagi semua, kami telah melakukan pembaruan signifikan pada sistem keamanan dan anti-cheat di Lytheria SMP._

Kami berkomitmen penuh untuk menciptakan pengalaman bermain yang bebas dari cheater dan perlakuan tidak adil. Pembaruan ini adalah langkah besar untuk mewujudkan komitmen tersebut.

---

### Apa yang Baru?

* **Sistem Anti-Cheat yang Ditingkatkan:** Kami telah mengimplementasikan versi terbaru dari sistem anti-cheat kami yang lebih canggih dalam mendeteksi penggunaan _hack client_, _x-ray_, dan _fly hacks_. Sistem ini bekerja secara _real-time_ untuk mengidentifikasi dan menindak pemain yang melanggar aturan.
* **Verifikasi Dua Langkah (2FA):** Untuk melindungi akun Anda dari akses tidak sah, kami sangat merekomendasikan untuk mengaktifkan Verifikasi Dua Langkah. Anda bisa mengaktifkannya melalui profil Anda di situs web kami.
* **Pencatatan Log yang Lebih Detail:** Kami telah meningkatkan sistem pencatatan log untuk membantu staf kami dalam menginvestigasi laporan pelanggaran dengan lebih cepat dan akurat.

> Kami memiliki kebijakan **toleransi nol** terhadap kecurangan. Setiap pemain yang terdeteksi menggunakan cheat akan langsung dikenakan sanksi permanen tanpa peringatan.

Kami berterima kasih kepada komunitas yang terus membantu kami dengan melaporkan pemain yang mencurigakan. Laporan Anda sangat berharga dalam menjaga server tetap bersih dan adil. Mari kita bersama-sama menciptakan komunitas yang positif dan sportif.
MARKDOWN
            ],
            [
                'category_id' => $categories['Event Komunitas']->id,
                'title' => 'Musim Baru Skyblock Galaxy Telah Tiba! Reset dan Fitur Baru',
                'published_at' => now()->subDays(20),
                'content' => <<<MARKDOWN
# Musim Baru Skyblock Galaxy Telah Tiba! Reset dan Fitur Baru

_Bersiaplah untuk memulai petualangan dari nol di angkasa! Kami dengan gembira mengumumkan bahwa musim baru untuk mode permainan **Skyblock Galaxy** telah resmi dimulai!_

Seperti biasa, reset musim ini berarti semua pulau, inventaris, dan saldo uang di dunia Skyblock akan diatur ulang. Ini memberikan kesempatan yang adil bagi semua pemain, baik baru maupun lama, untuk bersaing memperebutkan posisi puncak di papan peringkat.

---

### Fitur Baru di Musim Ini

Setiap musim baru selalu datang dengan kejutan, dan musim ini tidak terkecuali. Berikut adalah beberapa fitur baru yang bisa Anda nikmati:

* **Misi Pulau (Island Missions):** Selesaikan serangkaian misi yang menantang untuk pulau Anda dan dapatkan hadiah eksklusif, termasuk item kustom dan upgrade pulau.
* **Generator Kustom:** Kami telah merombak sistem generator. Sekarang Anda memiliki lebih banyak kontrol atas item apa yang dihasilkan oleh _cobblestone generator_ Anda seiring dengan peningkatan level pulau.
* **Event Raja Langit (King of the Sky):** Sebuah event PvP mingguan di mana pemain akan bertarung di arena khusus untuk memperebutkan gelar "Raja Langit" dan hadiah yang melimpah.
* **Ekonomi yang Diperbarui:** Kami telah menyeimbangkan kembali harga item di toko untuk menciptakan ekonomi yang lebih menantang dan menarik.

> Reset ini **TIDAK** mempengaruhi rank, crate keys, atau item lain yang Anda beli dari toko server. Semua itu akan tetap aman di akun Anda.

Ayo segera masuk ke `/warp skyblock` dan mulailah membangun pulau impian Anda dari awal. Siapakah yang akan menjadi penguasa langit di musim ini?
MARKDOWN
            ],
        ];

        foreach ($newsData as $data) {
            News::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'category_id' => $data['category_id'],
                'owner_id' => $owner->id,
                'image_url' => $imageUrl,
                'image_caption' => 'Ilustrasi untuk berita ' . $data['title'],
                'content' => $data['content'],
                'status' => 'published',
                'published_at' => $data['published_at'],
            ]);
        }
    }
}
