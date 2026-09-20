@extends('frontend.layouts.app')

@php
    $field = 'mt-2 w-full rounded-xl border-black/15 bg-white px-4 py-3 text-volcanic placeholder:text-volcanic/40 focus:border-primary focus:ring-primary';
    $subjects = ['Informasi Wisata', 'Bantuan Perjalanan', 'Saran & Masukan', 'Kerjasama', 'Keluhan', 'Lainnya'];
    $whatsappNumber = '6281261180672';
@endphp

@section('title', __('wt.ct_title') . ' — ' . __('wt.brand'))
@section('description', __('wt.ct_sub'))

@push('head')
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
@endpush

@section('body')
    <x-front.page-header :eyebrow="__('wt.footer_contact')" :title="__('wt.ct_title')" :subtitle="__('wt.ct_sub')" image="assets/kora_kora.jpg" />

    <section class="mx-auto grid max-w-7xl grid-cols-1 gap-8 px-4 py-16 sm:px-6 lg:grid-cols-5 lg:px-8 lg:py-24">
        <div class="card p-6 sm:p-10 lg:col-span-3"
            x-data="{ count: {{ mb_strlen(old('pesan', '')) }}, submitting: false, captchaMissing: false }">
            <h2 class="font-display text-3xl text-volcanic">{{ __('wt.ct_send') }}</h2>

            @if (session('success'))
                <div role="status" class="mt-6 rounded-xl bg-primary/10 px-4 py-3 text-sm font-medium text-primary-dark">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div role="alert" class="mt-6 rounded-xl bg-red-50 px-4 py-3 text-sm font-medium text-red-700">{{ session('error') }}</div>
            @endif

            <form action="{{ route('kontak.store') }}" method="POST" class="mt-8 space-y-6"
                @submit="
                    const captcha = $el.querySelector('[name=h-captcha-response]');
                    if (! captcha || ! captcha.value) { $event.preventDefault(); captchaMissing = true; return; }
                    captchaMissing = false; submitting = true;
                ">
                @csrf

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="nama" class="text-sm font-semibold text-volcanic">{{ __('wt.ct_name') }} *</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required autocomplete="name"
                            placeholder="{{ __('wt.ct_name_ph') }}" class="{{ $field }}" @error('nama') aria-invalid="true" aria-describedby="nama-error" @enderror>
                        @error('nama') <p id="nama-error" class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="email" class="text-sm font-semibold text-volcanic">{{ __('wt.ct_email') }} *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="nama@example.com" class="{{ $field }}" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                        @error('email') <p id="email-error" class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="telepon" class="text-sm font-semibold text-volcanic">{{ __('wt.ct_phone') }}</label>
                    <div class="mt-2 flex">
                        <span class="inline-flex items-center rounded-s-xl border border-e-0 border-black/15 bg-surface px-4 text-sm text-volcanic/70">+62</span>
                        <input type="tel" id="telepon" name="telepon" value="{{ old('telepon') }}" autocomplete="tel-national"
                            placeholder="812-3456-7890" class="w-full rounded-e-xl rounded-s-none border-black/15 bg-white px-4 py-3 text-volcanic placeholder:text-volcanic/40 focus:border-primary focus:ring-primary"
                            aria-describedby="telepon-hint">
                    </div>
                    <p id="telepon-hint" class="mt-1 text-xs text-volcanic/55">{{ __('wt.ct_phone_hint') }}</p>
                    @error('telepon') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="subjek" class="text-sm font-semibold text-volcanic">{{ __('wt.ct_subject') }} *</label>
                    <select id="subjek" name="subjek" required class="{{ $field }}">
                        <option value="">{{ __('wt.ct_subject_ph') }}</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject }}" @selected(old('subjek') === $subject)>{{ $subject }}</option>
                        @endforeach
                    </select>
                    @error('subjek') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="pesan" class="text-sm font-semibold text-volcanic">{{ __('wt.ct_message') }} *</label>
                    <textarea id="pesan" name="pesan" rows="6" required maxlength="1000" @input="count = $event.target.value.length"
                        placeholder="{{ __('wt.ct_message_ph') }}" class="{{ $field }}">{{ old('pesan') }}</textarea>
                    <p class="mt-1 text-right text-xs" :class="count > 900 ? 'text-red-600' : 'text-volcanic/55'"><span x-text="count">0</span>/1000 {{ __('wt.ct_chars') }}</p>
                    @error('pesan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <div class="h-captcha" data-sitekey="{{ config('services.hcaptcha.sitekey_test') }}"></div>
                    <p x-show="captchaMissing" x-cloak class="mt-2 text-sm text-red-600" role="alert">{{ __('wt.ct_captcha') }}</p>
                    @error('h-captcha-response') <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn-primary disabled:opacity-60" :disabled="submitting">
                    <span x-show="!submitting">{{ __('wt.ct_submit') }} &rarr;</span>
                    <span x-show="submitting" x-cloak>{{ __('wt.ct_sending') }}</span>
                </button>
            </form>
        </div>

        <aside class="dark-surface rounded-3xl bg-volcanic p-8 text-white sm:p-10 lg:col-span-2">
            <h2 class="font-display text-3xl">{{ __('wt.ct_info') }}</h2>
            <p class="mt-3 text-white/70">{{ __('wt.ct_info_sub') }}</p>

            <dl class="mt-8 space-y-6 text-sm">
                <div>
                    <dt class="eyebrow">{{ __('wt.ct_address') }}</dt>
                    <dd class="mt-2 text-base text-white/90">Kalumpang, Kec. Ternate Tengah,<br>Kota Ternate, Maluku Utara</dd>
                </div>
                <div>
                    <dt class="eyebrow">{{ __('wt.ct_phone_label') }}</dt>
                    <dd class="mt-2 text-base text-white/90"><a href="tel:+{{ $whatsappNumber }}" class="hover:text-accent">+62 812-6118-0672</a></dd>
                </div>
                <div>
                    <dt class="eyebrow">Email</dt>
                    <dd class="mt-2 break-all text-base text-white/90">
                        <a href="mailto:mediacenterdisparkotaternate@gmail.com" class="hover:text-accent">mediacenterdisparkotaternate@gmail.com</a><br>
                        <a href="mailto:disparternatekota@gmail.com" class="hover:text-accent">disparternatekota@gmail.com</a>
                    </dd>
                </div>
                <div>
                    <dt class="eyebrow">{{ __('wt.ct_hours') }}</dt>
                    <dd class="mt-2 text-base text-white/90">Senin - Jum'at: 08:00 - 17:00</dd>
                </div>
            </dl>

            <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" rel="noopener noreferrer" class="btn-ghost mt-10 w-full">{{ __('wt.ct_wa') }}</a>
        </aside>
    </section>
@endsection
