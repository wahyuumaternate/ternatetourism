@extends('frontend.layouts.app')

@php($isStructure = ($visi_misi->slug ?? '') === 'struktur')

@section('title', ($isStructure ? __('pesan.organization') : __('pesan.vision_mission')) . ' — ' . __('wt.brand'))

@section('body')
    <x-front.page-header :eyebrow="__('pesan.profile')" :title="$isStructure ? __('pesan.organization') : __('pesan.vision_mission')" />

    <article class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:py-24">
        @if (filled(strip_tags((string) ($visi_misi->content ?? ''))))
            <div class="rich">{!! \App\Helpers\RichText::clean($visi_misi->content) !!}</div>
        @else
            <p class="card p-6 text-volcanic/70">{{ __('wt.pg_profile_soon') }}</p>
        @endif
    </article>
@endsection
