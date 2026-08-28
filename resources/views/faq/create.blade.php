@extends('layouts.app')

@section('title', 'Add FAQ item')

@section('content')
    <div class="form-card">
        <h1>Add FAQ item</h1>
        <p>Published items appear on the public accordion, ordered by sort order then id.</p>

        <form method="POST" action="{{ route('faqs.store') }}">
            @csrf

            <label for="question">Question</label>
            <input id="question" name="question" type="text" value="{{ old('question') }}" required maxlength="255">
            @error('question')
                <p class="error">{{ $message }}</p>
            @enderror

            <label for="answer">Answer</label>
            <textarea id="answer" name="answer" rows="6" required>{{ old('answer') }}</textarea>
            @error('answer')
                <p class="error">{{ $message }}</p>
            @enderror

            <label for="sort_order">Sort order</label>
            <input id="sort_order" name="sort_order" type="number" min="0" max="9999" value="{{ old('sort_order', 0) }}">
            @error('sort_order')
                <p class="error">{{ $message }}</p>
            @enderror

            <label class="checkbox">
                <input type="checkbox" name="published" value="1" @checked(old('published', true))>
                Published
            </label>

            <button type="submit">Save item</button>
        </form>
    </div>
@endsection
