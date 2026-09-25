<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\LandingContentRequest;
use App\Models\LandingContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LandingContentController extends Controller
{
    /** @var array<string, string> */
    private const SECTION_LABELS = [
        'hero' => 'Hero utama',
        'program' => 'Program & Modul',
        'package' => 'Paket layanan',
        'section' => 'Judul section',
        'stat' => 'Statistik hero',
        'benefit' => 'Keunggulan',
        'cta' => 'CTA penutup',
        'brand' => 'Identitas global',
    ];

    /** @var array<string, string> */
    private const LAYER_LABELS = [
        'hero' => 'Layer 1 · Hero + Program & Modul',
        'package' => 'Layer 2 · Online Schedule + Paket',
        'visual' => 'Layer 3 · Colossal gambar',
        'cta' => 'Layer 4 · CTA prestasi',
        'footer' => 'Layer 5 · Footer',
    ];

    public function index(): View
    {
        return view('maintenance.dashbord', [
            'contents' => LandingContent::query()->orderBy('type')->orderBy('sort_order')->orderBy('id')->get(),
            'brandContent' => LandingContent::query()->where('type', 'brand')->first(),
        ]);
    }

    public function section(string $type): View
    {
        abort_unless(array_key_exists($type, self::SECTION_LABELS), 404);

        return view('maintenance.section', [
            'type' => $type,
            'label' => self::SECTION_LABELS[$type],
            'contents' => LandingContent::query()->where('type', $type)->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function layer(string $layer): View
    {
        abort_unless(array_key_exists($layer, self::LAYER_LABELS), 404);

        $query = LandingContent::query()->orderBy('sort_order')->orderBy('id');

        if ($layer === 'hero') {
            $query->whereIn('type', ['hero', 'program']);
        } elseif ($layer === 'package') {
            $query->where(function ($contentQuery): void {
                $contentQuery->where('type', 'package')
                    ->orWhere(function ($sectionQuery): void {
                        $sectionQuery->where('type', 'section')->where('sort_order', 1);
                    });
            });
        } elseif ($layer === 'visual') {
            $query->where('type', 'program')->whereNotNull('image_url');
        } else {
            $query->where('type', $layer);
        }

        return view('maintenance.layer', [
            'layer' => $layer,
            'label' => self::LAYER_LABELS[$layer],
            'contents' => $query->get(),
        ]);
    }

    public function show(LandingContent $landingContent): View
    {
        return view('maintenance.show', ['content' => $landingContent]);
    }

    public function edit(LandingContent $landingContent): View
    {
        return view('maintenance.edit', [
            'content' => $landingContent,
            'label' => self::SECTION_LABELS[$landingContent->type] ?? ucfirst($landingContent->type),
        ]);
    }

    public function createPackage(): View
    {
        return view('maintenance.packageCreate');
    }

    public function createProgram(): View
    {
        return view('maintenance.programCreate');
    }

    public function storePackage(LandingContentRequest $request): RedirectResponse
    {
        LandingContent::create($this->payload($request));

        return to_route('maintenance.landing.layer', 'package')->with('status', 'Paket layanan berhasil ditambahkan.');
    }

    public function storeProgram(LandingContentRequest $request): RedirectResponse
    {
        LandingContent::create($this->payload($request));

        return to_route('maintenance.landing.layer', 'hero')->with('status', 'Program & unggulan berhasil ditambahkan.');
    }

    public function update(LandingContentRequest $request, LandingContent $landingContent): RedirectResponse
    {
        $landingContent->update($this->payload($request));

        return to_route('maintenance.landing.index')->with('status', 'Konten landing page berhasil diperbarui.');
    }

    public function destroy(LandingContent $landingContent): RedirectResponse
    {
        $landingContent->delete();

        return to_route('maintenance.landing.index')->with('status', 'Konten landing page berhasil dihapus.');
    }

    /** @return array<string, mixed> */
    private function payload(LandingContentRequest $request): array
    {
        $data = $request->validated();
        unset($data['image']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('landing', 'public');
            $data['image_url'] = asset('storage/'.$path);
        }

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
