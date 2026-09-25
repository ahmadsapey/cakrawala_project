@csrf
@method('PUT')
<input type="hidden" name="type" value="{{ $content->type }}">
<input type="hidden" name="sort_order" value="{{ $content->sort_order }}">
<input type="hidden" name="is_active" value="{{ $content->is_active ? 1 : 0 }}">

<div class="grid gap-4 md:grid-cols-2">
    
      
    <label class="space-y-1.5 text-xs font-black text-slate-700 md:col-span-2">Judul
        <input name="title" value="{{ $content->title }}" required maxlength="150" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
    </label>
    @if ($content->type !== 'brand')
        <label class="space-y-1.5 text-xs font-black text-slate-700 md:col-span-2">Deskripsi
            <textarea name="description" rows="4" maxlength="500" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">{{ $content->description }}</textarea>
        </label>
    @endif
    @if (in_array($content->type, ['program', 'brand'], true))
        <label class="space-y-1.5 text-xs font-black text-slate-700">Upload gambar
            <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs font-semibold file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-100 file:px-3 file:py-2 file:text-xs file:font-black file:text-indigo-700">
            <span class="block text-[11px] font-semibold text-slate-400">JPG, PNG, atau WEBP maksimal 5 MB.</span>
            @if ($content->image_url)
                <img src="{{ $content->image_url }}" alt="Preview {{ $content->title }}" class="mt-2 h-24 {{ $content->type === 'brand' ? 'w-24 object-contain' : 'w-full object-cover' }} rounded-xl">
            @endif
        </label>
    
    @elseif ($content->type === 'package')
        <label class="space-y-1.5 text-xs font-black text-slate-700">Harga
            <input name="price" value="{{ $content->price }}" maxlength="80" placeholder="Rp 149.000" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
        </label>
        <label class="space-y-1.5 text-xs font-black text-slate-700">Satuan harga
            <input name="price_suffix" value="{{ $content->price_suffix }}" maxlength="30" placeholder="/bln" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
        </label>
    @elseif (in_array($content->type, ['cta', 'footer'], true))
        <label class="space-y-1.5 text-xs font-black text-slate-700">Nomor/link WhatsApp
            <input name="meta" value="{{ $content->meta }}" maxlength="150" placeholder="{{ $content->type === 'footer' ? 'info@cakrawala.id' : 'https://wa.me/628...' }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
        </label>
    @endif

    @if (in_array($content->type, ['hero', 'package', 'cta', 'footer'], true))
        <label class="space-y-1.5 text-xs font-black text-slate-700">Label tombol
            <input name="cta_label" value="{{ $content->cta_label }}" maxlength="80" placeholder="{{ $content->type === 'footer' ? '+62 812-3456-7890' : '' }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
        </label>
    @endif
   
    @if ($content->type === 'package')
        <label class="space-y-1.5 text-xs font-black text-slate-700 md:col-span-2">Fitur paket, satu fitur per baris
            <textarea name="features" rows="4" maxlength="500" placeholder="Materi sesuai kurikulum&#10;E-learning 24/7 jam" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">{{ is_array($content->features) ? implode(PHP_EOL, $content->features) : '' }}</textarea>
        </label>
    @endif
</div>

<div class="mt-5 flex flex-wrap items-center gap-5 border-t border-slate-100 pt-4">

    @if ($content->type === 'package')
        <label class="inline-flex items-center gap-2 text-xs font-bold text-slate-600">
            <input type="hidden" name="is_featured" value="0">
            <input type="checkbox" name="is_featured" value="1" @checked($content->is_featured) class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
            Tandai sebagai unggulan
        </label>
    @endif
</div>

<button type="submit" class="mt-6 w-full rounded-xl bg-indigo-600 px-4 py-3 text-sm font-black text-white transition hover:bg-indigo-700">Simpan perubahan</button>
