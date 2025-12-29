<?php

namespace App\Livewire\PublicPages\Articles;

use Livewire\Component;
use Livewire\Attributes\Title;

class Detail extends Component
{
    public $article;
    public $related = [];

    public function title()
    {
        return $this->article['title'] . ' - PT KAL';
    }

    public function mount($id)
    {
        // Simulasi DB (Copy array dari Index.php untuk kesederhanaan mockup)
        // Di real app, ini query DB: Article::find($id)
        $all = [
             [
                'id' => 1,
                'title' => 'Mengatasi Sawit "Trek" Berkepanjangan di Lahan Gambut',
                'image' => 'https://images.unsplash.com/photo-1625246333195-58f2164be23e?q=80&w=2071&auto=format&fit=crop',
                'category' => 'Teknis Pertanian',
                'author' => 'Dr. Agronomy',
                'date' => '28 Okt 2024',
                // Isi konten dummy panjang
                'content' => '
                    <p class="mb-4">Fenomena "trek" atau masa istirahat tanaman kelapa sawit seringkali menjadi momok bagi petani. Terutama di lahan gambut, kondisi ini bisa berlangsung lebih lama dari lahan mineral jika tidak ditangani dengan benar.</p>
                    <h3 class="text-xl font-bold mb-2">Penyebab Trek di Lahan Gambut</h3>
                    <p class="mb-4">Selain faktor cuaca (water deficit), trek di lahan gambut sering disebabkan oleh ketidakseimbangan unsur hara mikro (Cu, Zn, Fe) dan makro (K). Lahan gambut memiliki C/N ratio yang tinggi sehingga mineralisasi berjalan lambat.</p>
                    <h3 class="text-xl font-bold mb-2">Strategi Pemupukan</h3>
                    <p class="mb-4">Kunci memutus siklus trek adalah <strong>Pemupukan Kalium (K)</strong> dan <strong>Magnesium (Mg)</strong> yang cukup. Produk NPK 6-12-22 + Magsul dari Kurnia Agro Lestari dirancang khusus untuk masalah ini.</p>
                    <ul class="list-disc list-inside mb-4 ml-4">
                        <li>Jaga level air parit (50-60 cm).</li>
                        <li>Aplikasi Cu dan Zn setahun sekali.</li>
                        <li>Rotasi pupuk NPK dengan interval 4 bulan.</li>
                    </ul>
                    <p>Dengan manajemen yang tepat, produktivitas bisa dijaga stabil di angka 1.8 - 2.2 ton/ha/bulan.</p>
                '
            ],
            // ... Tambahkan data dummy lainnya minimal ID sesuai index ...
             [
                'id' => 2,
                'title' => 'Kenapa Daun Sawit Menguning? Ini Penyebab & Solusinya',
                'image' => 'https://images.unsplash.com/photo-1598155523122-38423bd4d6bc?q=80&w=2070&auto=format&fit=crop',
                'category' => 'Tips & Trik',
                'author' => 'Tim Ahli KAL',
                'date' => '15 Nov 2024',
                'content' => '<p>Konten dummy untuk artikel kedua...</p>'
            ],
            [
                'id' => 3,
                'title' => 'PT KAL Luncurkan Aplikasi Rekam Medis Kebun Digital',
                'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1932&auto=format&fit=crop', 
                'category' => 'Berita Perusahaan',
                'author' => 'Humas',
                'date' => '10 Jan 2025',
                'content' => '<p>Konten dummy untuk artikel ketiga...</p>'
            ],
        ];

        $this->article = collect($all)->firstWhere('id', $id);

        if (!$this->article) {
            return redirect()->route('articles');
        }

        // Ambil artikel lain acak sebagai related
        $this->related = collect($all)->where('id', '!=', $id)->take(2)->all();
    }
    
    public function render()
    {
        return view('livewire.public-pages.articles.detail');
    }
}
