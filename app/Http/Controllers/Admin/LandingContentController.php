<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LandingContentRequest;
use App\Models\LandingContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LandingContentController extends Controller
{
    public function index(): View
    {
        return view('modulAdmin.kelolaLanding', [
            'programs' => LandingContent::query()->where('type', 'program')->orderBy('sort_order')->orderBy('id')->get(),
            'packages' => LandingContent::query()->where('type', 'package')->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function store(LandingContentRequest $request): RedirectResponse
    {
        LandingContent::create($this->payload($request));

        return to_route('admin.landing.index')->with('status', 'Konten landing page berhasil ditambahkan.');
    }

    public function update(LandingContentRequest $request, LandingContent $landingContent): RedirectResponse
    {
        $landingContent->update($this->payload($request));

        return to_route('admin.landing.index')->with('status', 'Konten landing page berhasil diperbarui.');
    }

    public function destroy(LandingContent $landingContent): RedirectResponse
    {
        $landingContent->delete();

        return to_route('admin.landing.index')->with('status', 'Konten landing page berhasil dihapus.');
    }

    /** @return array<string, mixed> */
    private function payload(LandingContentRequest $request): array
    {
        $data = $request->validated();
        $data['features'] = collect(preg_split('/\r\n|\r|\n/', $data['features'] ?? ''))
            ->map(fn (string $feature): string => trim($feature))
            ->filter()
            ->values()
            ->all();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
