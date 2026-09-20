<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Events;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InnerPagesTest extends TestCase
{
    use DatabaseTransactions;

    private function destination(string $name, string $slug, string $lat, string $long): Destination
    {
        return Destination::create([
            'name' => $name,
            'image' => 'assets/front/gamalama-800.webp',
            'description' => '<p>Deskripsi contoh</p>',
            'lat' => $lat,
            'long' => $long,
            'slug' => $slug,
        ]);
    }

    public function test_destination_detail_lists_the_closest_place_as_nearby(): void
    {
        $this->destination('Tempat Uji Utama', 'tempat-uji-utama', '0.7900', '127.3600');
        $this->destination('Tempat Uji Dekat', 'tempat-uji-dekat', '0.7910', '127.3610');

        $response = $this->get(route('destinasi.show', 'tempat-uji-utama'));

        $response->assertOk();
        $response->assertSee('Tempat Uji Utama');
        $response->assertSee('Tempat Uji Dekat');
        $response->assertSee('application/ld+json', false);
    }

    public function test_destination_detail_returns_404_for_unknown_slug(): void
    {
        $this->get(route('destinasi.show', 'tidak-ada'))->assertNotFound();
    }

    public function test_destination_with_invalid_coordinates_still_renders_without_map(): void
    {
        $this->destination('Tanpa Koordinat', 'tanpa-koordinat', 'abc', 'xyz');

        $this->get(route('destinasi.show', 'tanpa-koordinat'))
            ->assertOk()
            ->assertDontSee('detail-map');
    }

    public function test_event_detail_renders_event_information(): void
    {
        Events::create([
            'name' => 'Event Uji',
            'slug' => 'event-uji',
            'location' => 'Lokasi Uji',
            'date' => '2030-01-15',
            'time' => '10:00:00',
            'detail' => '<p>Detail uji</p>',
            'lat' => '0.79',
            'long' => '127.36',
            'poster' => 'assets/front/kora-kora-800.webp',
        ]);

        $this->get(route('event.detail', 'event-uji'))
            ->assertOk()
            ->assertSee('Event Uji')
            ->assertSee('Lokasi Uji');
    }

    public function test_listing_pages_render(): void
    {
        foreach (['destinasi.all', 'events.all', 'berita.all', 'frontFoto', 'frontVideo'] as $name) {
            $this->get(route($name))->assertOk();
        }

        $this->get(route('fasilitas.front', 'hotel'))->assertOk();
    }
}
