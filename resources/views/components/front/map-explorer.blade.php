@props(['points'])

<div x-data="mapExplorer(@js($points), @js(['destination' => __('wt.map_destinations'), 'event' => __('wt.map_events'), 'detail' => __('wt.view_detail')]))"
    x-init="init()" class="card">
    <div class="flex flex-wrap gap-2 border-b border-black/5 p-4" role="group" aria-label="{{ __('wt.map_title') }}">
        @foreach (['all' => __('wt.map_all'), 'destination' => __('wt.map_destinations'), 'event' => __('wt.map_events')] as $key => $label)
            <button type="button" @click="filter = '{{ $key }}'; render()"
                :class="filter === '{{ $key }}' ? 'bg-primary text-white' : 'bg-surface text-volcanic hover:bg-black/5'"
                class="rounded-full px-4 py-2 text-sm font-semibold transition">{{ $label }}</button>
        @endforeach
    </div>
    <div x-ref="map" class="h-[26rem] w-full sm:h-[32rem]" role="application" aria-label="{{ __('wt.map_title') }}"></div>
</div>

@push('head')
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('leaflet/leaflet.js') }}"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            const colors = { destination: '#0B6E69', event: '#172026' };
            const esc = (text) => String(text ?? '').replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

            Alpine.data('mapExplorer', (points, labels) => ({
                points, labels, filter: 'all', map: null, layer: null,
                init() {
                    this.map = L.map(this.$refs.map, { scrollWheelZoom: false }).setView([0.79, 127.36], 11);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 18,
                        attribution: '&copy; OpenStreetMap contributors',
                    }).addTo(this.map);
                    this.layer = L.layerGroup().addTo(this.map);
                    this.render();
                },
                render() {
                    this.layer.clearLayers();
                    const shown = this.points.filter((p) => this.filter === 'all' || p.type === this.filter);
                    shown.forEach((p) => {
                        const marker = L.circleMarker([p.lat, p.lng], {
                            radius: 9, color: '#fff', weight: 2, fillColor: colors[p.type], fillOpacity: 1,
                        }).addTo(this.layer);
                        marker.bindPopup(
                            `<div style="width:200px">
                                ${p.image ? `<img src="${esc(p.image)}" alt="" style="width:100%;height:100px;object-fit:cover;border-radius:8px">` : ''}
                                <p style="margin:8px 0 0;font-size:11px;color:${colors[p.type]};font-weight:700">${esc(this.labels[p.type])}</p>
                                <p style="margin:2px 0;font-weight:700">${esc(p.name)}</p>
                                <p style="margin:0 0 6px;font-size:12px">${esc(p.description)}</p>
                                <a href="${esc(p.url)}" style="font-size:12px;font-weight:700;color:#0B6E69">${esc(this.labels.detail)} &rarr;</a>
                            </div>`
                        );
                    });
                    if (shown.length) {
                        this.map.fitBounds(shown.map((p) => [p.lat, p.lng]), { padding: [40, 40], maxZoom: 13 });
                    }
                },
            }));
        });
    </script>
@endpush
