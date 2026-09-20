<?php

namespace Tests\Feature;

use App\Models\Ekraf;
use App\Models\EkrafCategories;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EkrafPagesTest extends TestCase
{
    use DatabaseTransactions;

    private function ekraf(string $name, string $slug, EkrafCategories $category, array $extra = []): Ekraf
    {
        return Ekraf::create(array_merge([
            'name' => $name,
            'slug' => $slug,
            'description' => '<p>Deskripsi uji</p>',
            'category_id' => $category->id,
            'jumlah_produk' => '3',
        ], $extra));
    }

    private function category(): EkrafCategories
    {
        return EkrafCategories::forceCreate(['name' => 'Kategori Uji', 'icon' => 'bi-star', 'slug' => 'kategori-uji']);
    }

    public function test_list_page_shows_ekraf_and_category_chip(): void
    {
        $category = $this->category();
        $this->ekraf('Usaha Uji Satu', 'usaha-uji-satu', $category);

        $this->get(route('ekraf.index'))
            ->assertOk()
            ->assertSee('Kategori Uji')
            ->assertSee('id="ekraf-search"', false);
    }

    public function test_category_page_lists_only_that_categorys_ekraf(): void
    {
        $category = $this->category();
        $other = EkrafCategories::forceCreate(['name' => 'Kategori Lain', 'icon' => 'bi-star', 'slug' => 'kategori-lain']);
        $this->ekraf('Milik Kategori Uji', 'milik-kategori-uji', $category);
        $this->ekraf('Milik Kategori Lain', 'milik-kategori-lain', $other);

        $this->get(route('ekraf.category', 'kategori-uji'))
            ->assertOk()
            ->assertSee('Milik Kategori Uji')
            ->assertDontSee('Milik Kategori Lain');
    }

    public function test_detail_hides_placeholder_contact_values_and_links_real_ones(): void
    {
        $category = $this->category();
        $this->ekraf('Usaha Kontak', 'usaha-kontak', $category, [
            'phone' => 'Tidak tersedia',
            'email' => 'halo@example.com',
            'social_media' => 'https://www.instagram.com/contoh/',
        ]);

        $this->get(route('ekraf.show', 'usaha-kontak'))
            ->assertOk()
            ->assertDontSee('Tidak tersedia')
            ->assertSee('mailto:halo@example.com', false)
            ->assertSee('https://www.instagram.com/contoh/', false);
    }

    public function test_detail_shows_other_businesses_in_the_same_category(): void
    {
        $category = $this->category();
        $this->ekraf('Usaha Utama', 'usaha-utama', $category);
        $this->ekraf('Usaha Serupa', 'usaha-serupa', $category);

        $this->get(route('ekraf.show', 'usaha-utama'))->assertOk()->assertSee('Usaha Serupa');
    }

    public function test_unknown_ekraf_returns_404(): void
    {
        $this->get(route('ekraf.show', 'tidak-ada'))->assertNotFound();
    }

    public function test_search_endpoint_finds_ekraf_by_name(): void
    {
        $this->ekraf('Pencarian Unik Xyzzy', 'pencarian-unik-xyzzy', $this->category());

        $this->getJson(route('ekraf.search', ['query' => 'Xyzzy']))
            ->assertOk()
            ->assertJsonFragment(['slug' => 'pencarian-unik-xyzzy']);
    }
}
