<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::query()
            ->published()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('faq.index', compact('faqs'));
    }

    public function manage(): View
    {
        $faqs = Faq::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('faq.manage', compact('faqs'));
    }

    public function create(): View
    {
        return view('faq.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        Faq::create([
            'user_id' => $request->user()->id,
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'published' => $request->boolean('published'),
        ]);

        return redirect()
            ->route('faqs.manage')
            ->with('status', 'FAQ item created.');
    }

    public function edit(Faq $faq): View
    {
        return view('faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $this->validated($request);

        $faq->update([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'published' => $request->boolean('published'),
        ]);

        return redirect()
            ->route('faqs.manage')
            ->with('status', 'FAQ item updated.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()
            ->route('faqs.manage')
            ->with('status', 'FAQ item deleted.');
    }

    /**
     * @return array{question: string, answer: string, sort_order: int|null}
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);
    }
}
