<?php

namespace App\Livewire\PublicPages\Articles;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

#[Title('Artikel & Berita - PT Kurnia Agro Lestari')]
class Index extends Component
{
    #[Url]
    public $category = 'Semua';
    
    #[Url]
    public $search = '';

    private function getArticles()
    {
        return [
            [
                'id' => 1,
                'title' => 'Mengatasi Sawit "Trek" Berkepanjangan di Lahan Gambut',
                'slug' => 'mengatasi-sawit-trek',
                'excerpt' => 'Fenomena trek buah bisa bikin petani rugi besar. Simak strategi pemupukan nitrogen dan kalium yang tepat untuk memulihkan produktivitas.',
                'image' => 'https://www.infosawit.com/2025/12/29/kebun-sawit-sitaan-diputihkan-petani-sawit-nilai-negara-lebih-berpihak-ke-bumn-ketimbang-rakyat/',
                'category' => 'Teknis Pertanian',
                'author' => 'Dr. Agronomy',
                'date' => '28 Okt 2024',
                'read_time' => '5 min baca'
            ],
            [
                'id' => 2,
                'title' => 'Kenapa Daun Sawit Menguning? Ini Penyebab & Solusinya',
                'slug' => 'daun-sawit-menguning',
                'excerpt' => 'Jangan buru-buru vonis penyakit ganoderma. Bisa jadi sawit Anda hanya kekurangan Magnesium. Pelajari tanda-tandanya disini.',
                'image' => 'https://images.unsplash.com/photo-1598155523122-38423bd4d6bc?q=80&w=2070&auto=format&fit=crop',
                'category' => 'Tips & Trik',
                'author' => 'Tim Ahli KAL',
                'date' => '15 Nov 2024',
                'read_time' => '3 min baca'
            ],
            [
                'id' => 3,
                'title' => 'PT KAL Luncurkan Aplikasi Rekam Medis Kebun Digital',
                'slug' => 'launching-aplikasi-rekam-medis',
                'excerpt' => 'Inovasi terbaru untuk petani modern. Pantau kesehatan kebun dan jadwal pemupukan hanya dari genggaman smartphone.',
                'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1932&auto=format&fit=crop', // Gambar teknologi/HP
                'category' => 'Berita Perusahaan',
                'author' => 'Humas',
                'date' => '10 Jan 2025',
                'read_time' => '2 min baca'
            ],
            [
                'id' => 4,
                'title' => 'Bahaya Residu Kimia Berlebih pada Tanah Jangka Panjang',
                'slug' => 'bahaya-residu-kimia',
                'excerpt' => 'Tanah yang keras dan masam adalah tanda kelelahan. Saatnya beralih ke metode semi-organik untuk keberlanjutan lahan anak cucu.',
                'image' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?q=80&w=2070&auto=format&fit=crop',
                'category' => 'Edukasi',
                'author' => 'Muhammad Hasyari',
                'date' => '05 Feb 2025',
                'read_time' => '6 min baca'
            ],
             [
                'id' => 5,
                'title' => 'Cara Menghitung Kebutuhan Pupuk Per Hektar Secara Presisi',
                'slug' => 'cara-hitung-pupuk',
                'excerpt' => 'Jangan asal tebar. Hitungan yang salah bikin boncos biaya operasional. Gunakan rumus sederhana ini.',
                'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=2070&auto=format&fit=crop',
                'category' => 'Teknis Pertanian',
                'author' => 'Tim Ahli KAL',
                'date' => '20 Feb 2025',
                'read_time' => '4 min baca'
            ],
        ];
    }

    public function render()
    {
        $all = $this->getArticles();

        // Ambil artikel pertama sebagai "Featured" (Headline)
        $featured = $all[0];

        // Filter sisa artikel
        $articles = collect($all)
            ->filter(function($item) {
                // Filter Search
                if ($this->search !== '' && stripos($item['title'], $this->search) === false) {
                    return false;
                }
                // Filter Category
                if ($this->category !== 'Semua' && $item['category'] !== $this->category) {
                    return false;
                }
                return true;
            })
            // Exclude yang sudah jadi featured (kecuali kalau lagi search/filter)
            ->when($this->search == '' && $this->category == 'Semua', function($collection) use ($featured) {
                return $collection->reject(fn($item) => $item['id'] === $featured['id']);
            })
            ->all();

        return view('livewire.public-pages.articles.index', [
            'featured' => ($this->search == '' && $this->category == 'Semua') ? $featured : null, // Sembunyikan featured kalau lagi search
            'articles' => $articles
        ]);
    }

    public function setCategory($cat)
    {
        $this->category = $cat;
    }
}
