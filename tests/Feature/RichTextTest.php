<?php

namespace Tests\Feature;

use App\Helpers\RichText;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RichTextTest extends TestCase
{
    use DatabaseTransactions;

    public function test_inline_editor_styles_are_preserved(): void
    {
        $html = '<p style="text-align: justify; color: #e03e2e;"><strong>Tebal</strong> <span style="background-color: #fbeeb8;">sorot</span></p>'
            .'<table border="1" style="border-collapse: collapse; width: 100%;"><tr><td style="width: 50%;">Sel</td></tr></table>'
            .'<p style="padding-left: 40px;"><img src="a.jpg" style="max-width: 100%; height: auto;" alt="Foto"></p>';

        $clean = RichText::clean($html);

        $this->assertStringContainsString('<p style="text-align: justify; color: #e03e2e;"><strong>Tebal</strong>', $clean);
        $this->assertStringContainsString('<span style="background-color: #fbeeb8;">sorot</span>', $clean);
        $this->assertStringContainsString('<table border="1" style="border-collapse: collapse; width: 100%;">', $clean);
        $this->assertStringContainsString('<p style="padding-left: 40px;"><img src="a.jpg" style="max-width: 100%; height: auto;" alt="Foto"></p>', $clean);
    }

    public function test_tables_are_wrapped_so_they_scroll_instead_of_stretching_the_page(): void
    {
        $clean = RichText::clean('<table style="width: 900px;"><tr><td>Sel</td></tr></table>');

        $this->assertSame('<div class="rich-table"><table style="width: 900px;"><tr><td>Sel</td></tr></table></div>', $clean);
    }

    public function test_pasted_classes_and_data_attributes_are_removed(): void
    {
        $clean = RichText::clean('<div class="flex w-full hidden" data-start="1"><p class="grow" data-end="9" style="text-align: left;">Isi</p></div>');

        $this->assertStringNotContainsString('class=', $clean);
        $this->assertStringNotContainsString('data-', $clean);
        $this->assertStringContainsString('style="text-align: left;"', $clean);
    }

    public function test_scripts_handlers_and_javascript_links_are_removed(): void
    {
        $clean = RichText::clean('<p onclick="x()">A</p><script>alert(1)</script><a href="javascript:alert(1)">B</a><img src="a.jpg" onerror=\'x()\'>');

        $this->assertStringNotContainsString('<script', $clean);
        $this->assertStringNotContainsString('onclick', $clean);
        $this->assertStringNotContainsString('onerror', $clean);
        $this->assertStringNotContainsString('javascript:', $clean);
    }

    public function test_h1_is_demoted_and_null_is_safe(): void
    {
        $this->assertSame('<h2 style="text-align: center;">Judul</h2>', RichText::clean('<h1 style="text-align: center;">Judul</h1>'));
        $this->assertSame('', RichText::clean(null));
    }

    public function test_news_detail_renders_editor_content_with_a_single_h1(): void
    {
        $author = User::factory()->create();
        Berita::create([
            'title' => 'Berita Editor',
            'slug' => 'berita-editor',
            'excerpt' => 'Ringkasan',
            'image' => 'assets/front/gamalama-800.webp',
            'views' => 0,
            'content' => '<h1>Judul di isi</h1><div class="flex hidden"><p style="text-align: justify;">Paragraf rata kanan-kiri</p></div>',
            'user_id' => $author->id,
        ]);

        $response = $this->get(route('berita.detail', 'berita-editor'));

        $response->assertOk();
        $response->assertSee('<p style="text-align: justify;">Paragraf rata kanan-kiri</p>', false);
        $response->assertDontSee('class="flex hidden"', false);
        $this->assertSame(1, substr_count($response->getContent(), '<h1'));
    }
}
