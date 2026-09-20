<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class ContactAndPaginationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_contact_page_renders_the_form_with_captcha(): void
    {
        $this->get(route('kontak.create'))
            ->assertOk()
            ->assertSee('name="pesan"', false)
            ->assertSee('h-captcha', false);
    }

    public function test_valid_contact_message_is_stored(): void
    {
        $this->post(route('kontak.store'), [
            'nama' => 'Penguji',
            'email' => 'penguji@example.com',
            'subjek' => 'Informasi Wisata',
            'pesan' => 'Halo, saya ingin bertanya tentang wisata.',
        ])->assertRedirect()->assertSessionHas('success');

        $this->assertDatabaseHas('kontaks', ['email' => 'penguji@example.com', 'status' => 'baru']);
    }

    public function test_invalid_contact_message_is_rejected_with_errors(): void
    {
        $this->from(route('kontak.create'))
            ->post(route('kontak.store'), ['nama' => '', 'email' => 'bukan-email', 'subjek' => '', 'pesan' => 'pendek'])
            ->assertSessionHasErrors(['nama', 'email', 'subjek', 'pesan']);

        $this->assertDatabaseMissing('kontaks', ['email' => 'bukan-email']);
    }

    public function test_front_pagination_marks_current_page_and_summary(): void
    {
        $paginator = new LengthAwarePaginator(range(10, 18), 20, 9, 2, ['path' => '/berita']);

        $html = $paginator->links('pagination.front')->toHtml();

        $this->assertStringContainsString('aria-current="page"', $html);
        $this->assertStringContainsString('Menampilkan 10–18 dari 20', $html);
        $this->assertStringNotContainsString('page-item', $html);
    }

    public function test_front_pagination_renders_nothing_for_a_single_page(): void
    {
        $paginator = new LengthAwarePaginator(range(1, 3), 3, 9, 1, ['path' => '/berita']);

        $this->assertSame('', trim($paginator->links('pagination.front')->toHtml()));
    }
}
