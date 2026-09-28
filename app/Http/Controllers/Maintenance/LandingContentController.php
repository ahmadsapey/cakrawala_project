<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\LandingContentRequest;
use App\Models\LandingContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        'theme' => 'Warna Landing Page',
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
        $themeContent = LandingContent::query()->firstOrCreate(
            ['type' => 'theme'],
            [
                'title' => 'Pengaturan Warna Landing Page',
                'description' => 'Warna background body, teks, card, CTA banner, dan footer.',
                'badge' => '#F8FAFC',
                'meta' => '#1E293B',
                'price' => '#0B0F19',
                'price_suffix' => '#FFFFFF',
                'cta_label' => '#080B13',
                'image_url' => '#94A3B8',
                'features' => [
                    'body_bg' => '#F8FAFC',
                    'body_text' => '#1E293B',
                    'header_bg' => '#FFFFFF',
                    'header_text' => '#1E293B',
                    'card_bg' => '#FFFFFF',
                    'card_text' => '#0F172A',
                    'cta_bg' => '#0B0F19',
                    'cta_text' => '#FFFFFF',
                    'footer_bg' => '#080B13',
                    'footer_text' => '#94A3B8',
                ],
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        if (request()->routeIs('admin.*')) {
            return view('modulAdmin.kelolaLanding', [
                'programs' => LandingContent::query()->where('type', 'program')->orderBy('sort_order')->orderBy('id')->get(),
                'packages' => LandingContent::query()->where('type', 'package')->orderBy('sort_order')->orderBy('id')->get(),
                'themeContent' => $themeContent,
            ]);
        }

        return view('maintenance.dashbord', [
            'contents' => LandingContent::query()->orderBy('type')->orderBy('sort_order')->orderBy('id')->get(),
            'brandContent' => LandingContent::query()->where('type', 'brand')->first(),
            'themeContent' => $themeContent,
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

    public function store(LandingContentRequest $request): RedirectResponse
    {
        LandingContent::create($this->payload($request));

        return to_route('admin.landing.index')->with('status', 'Konten landing page berhasil ditambahkan.');
    }

    public function updateTheme(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'body_bg' => ['required', 'string', 'regex:/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/'],
            'body_text' => ['required', 'string', 'regex:/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/'],
            'header_bg' => ['nullable', 'string', 'regex:/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/'],
            'header_text' => ['nullable', 'string', 'regex:/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/'],
            'card_bg' => ['nullable', 'string', 'regex:/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/'],
            'card_text' => ['nullable', 'string', 'regex:/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/'],
            'cta_bg' => ['required', 'string', 'regex:/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/'],
            'cta_text' => ['required', 'string', 'regex:/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/'],
            'footer_bg' => ['required', 'string', 'regex:/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/'],
            'footer_text' => ['required', 'string', 'regex:/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/'],
        ]);

        $headerBg = $validated['header_bg'] ?? '#FFFFFF';
        $headerText = $validated['header_text'] ?? '#1E293B';
        $cardBg = $validated['card_bg'] ?? '#FFFFFF';
        $cardText = $validated['card_text'] ?? '#0F172A';

        $themeContent = LandingContent::query()->firstOrCreate(
            ['type' => 'theme'],
            [
                'title' => 'Pengaturan Warna Landing Page',
                'description' => 'Warna background body, teks, card, CTA banner, dan footer.',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $themeContent->update([
            'badge' => $validated['body_bg'],
            'meta' => $validated['body_text'],
            'price' => $validated['cta_bg'],
            'price_suffix' => $validated['cta_text'],
            'cta_label' => $validated['footer_bg'],
            'image_url' => $validated['footer_text'],
            'features' => [
                'body_bg' => $validated['body_bg'],
                'body_text' => $validated['body_text'],
                'header_bg' => $headerBg,
                'header_text' => $headerText,
                'card_bg' => $cardBg,
                'card_text' => $cardText,
                'cta_bg' => $validated['cta_bg'],
                'cta_text' => $validated['cta_text'],
                'footer_bg' => $validated['footer_bg'],
                'footer_text' => $validated['footer_text'],
            ],
        ]);

        $redirectRoute = request()->routeIs('admin.*') ? 'admin.landing.index' : 'maintenance.landing.index';

        return to_route($redirectRoute)->with('status', 'Warna landing page berhasil diperbarui.');
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
