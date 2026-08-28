@extends('layouts.app')

@section('title', 'Manage FAQ')

@section('content')
    <div class="page-head">
        <h1>Manage FAQ</h1>
        <p>All items, including unpublished. Public visitors only see published rows.</p>
    </div>

    <p><a class="button" href="{{ route('faqs.create') }}">Add item</a></p>

    @if ($faqs->isEmpty())
        <p class="empty">No FAQ items yet.</p>
    @else
        <ul class="manage-list">
            @foreach ($faqs as $faq)
                <li class="manage-item">
                    <div>
                        <strong>{{ $faq->question }}</strong>
                        <p class="muted">
                            Sort {{ $faq->sort_order }}
                            ·
                            @if ($faq->published)
                                Published
                            @else
                                Unpublished
                            @endif
                        </p>
                    </div>
                    <div class="manage-actions">
                        <a href="{{ route('faqs.edit', $faq) }}">Edit</a>
                        <form method="POST" action="{{ route('faqs.destroy', $faq) }}" onsubmit="return confirm('Delete this FAQ item?');">
                            @csrf
                            @method('DELETE')
                            <button class="danger" type="submit">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
