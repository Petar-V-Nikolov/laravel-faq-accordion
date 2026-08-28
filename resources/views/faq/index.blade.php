@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
    <div class="page-head">
        <h1>Frequently asked questions</h1>
        <p>Published items, ordered by sort order. Sign in to add, edit, or delete.</p>
    </div>

    @if ($faqs->isEmpty())
        <p class="empty">No published FAQ items yet.</p>
    @else
        <div
            class="accordion"
            x-data="{ open: {{ $faqs->first()->id }} }"
        >
            @foreach ($faqs as $faq)
                <div class="accordion-item">
                    <h2 class="accordion-heading">
                        <button
                            type="button"
                            class="accordion-trigger"
                            id="faq-button-{{ $faq->id }}"
                            :aria-expanded="open === {{ $faq->id }} ? 'true' : 'false'"
                            aria-controls="faq-panel-{{ $faq->id }}"
                            @click="open = open === {{ $faq->id }} ? null : {{ $faq->id }}"
                        >
                            <span>{{ $faq->question }}</span>
                            <span class="accordion-icon" aria-hidden="true"></span>
                        </button>
                    </h2>
                    <div
                        class="accordion-panel"
                        id="faq-panel-{{ $faq->id }}"
                        role="region"
                        aria-labelledby="faq-button-{{ $faq->id }}"
                        x-show="open === {{ $faq->id }}"
                        x-cloak
                    >
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
