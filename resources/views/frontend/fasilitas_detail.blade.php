@extends('frontend.layouts.app')

@php($plain = Str::limit(trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string) $facility->deskripsi)))), 155))

@section('title', $facility->name . ' — ' . __('wt.brand'))
@section('description', $plain)
@section('og_image', asset($facility->gambar))

@section('body')
    <x-front.page-header :eyebrow="$facility->kategori" :title="$facility->name" :image="$facility->gambar" />

    <article class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:py-24">
        <div class="rich">{!! \App\Helpers\RichText::clean($facility->deskripsi) !!}</div>
        <a href="{{ route('fasilitas.front', $facility->kategori) }}" class="btn-outline mt-12">&larr; {{ __('wt.pg_back_list') }}</a>
    </article>
@endsection
