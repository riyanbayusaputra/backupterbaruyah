<div class="max-w-[480px] mx-auto bg-white min-h-screen relative shadow-lg pb-36 px-4">
    <!-- Header -->
    <div class="pt-6">
        <div class="w-full h-48 mb-3 relative">
            <!-- Gambar -->
            <img 
                src="{{ $product->first_image_url ?: 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=480&q=80' }}" 
                alt="{{ $product->name }}" 
                class="w-full h-48 object-cover rounded-md transition-opacity duration-300"
            >
        </div>
        {{-- <h2 class="text-xl font-bold text-gray-800">{{ $product->name }}</h2>
        <p class="text-gray-500 text-sm">Harga Rp {{ number_format($product->price, 0, ',', '.') }}</p> --}}
    </div>

    <!-- Silahkan pilih isi menu -->    
    <div class="mt-4">
        <h3 class="text-lg font-semibold text-gray-800">Silahkan pilih isi menu</h3>
        <p class="text-gray-600 text-sm">Pilih sesuai selera Anda</p>
    </div>
    <!-- Dynamic Options -->
    @if($product->options->isEmpty())
        <div class="mt-10 text-center text-gray-500">
            Produk ini tidak memiliki opsi custom.
        </div>
    @else
        @foreach($product->options as $option)
        <div class="mt-10">
            <h3 class="text-lg font-bold text-gray-800 mb-3 capitalize tracking-wide">
                Pilih {{ $option->name }}
            </h3>
            <div class="flex gap-5 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                @foreach($option->optionItems as $item)
                <label class="min-w-[130px] bg-gray-50 border-2 border-transparent peer-checked:border-blue-600 rounded-xl p-4 flex flex-col items-center text-center cursor-pointer hover:border-blue-400 transition-all shadow-sm relative group">
                    <input 
                        type="radio" 
                        name="option_{{ $option->id }}" 
                        class="hidden peer" 
                        wire:model="selectedOptions.{{ $option->id }}" 
                        value="{{ $item->id }}"
                        @if($loop->first) checked @endif
                    >
                    <div class="absolute top-2 right-2 w-5 h-5 rounded-full border-2 border-blue-400 bg-white flex items-center justify-center transition-all group-hover:border-blue-600 peer-checked:bg-blue-600 peer-checked:border-blue-600">
                        <svg x-show="selectedOptions.{{ $option->id }} == {{ $item->id }}" class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div class="w-20 h-20 mb-2 relative">
                        <img 
                            src="{{ $item->image ? asset('storage/' . $item->image) : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=80&q=80' }}" 
                            class="w-20 h-20 object-cover rounded-lg shadow transition-opacity duration-300" 
                            alt="{{ $item->name }}" 
                        >
                    </div>
                    <span class="font-semibold text-gray-700">{{ $item->name }}</span>
                    @if($item->additional_price > 0)
                        <span class="text-xs text-blue-600 mt-1">+Rp {{ number_format($item->additional_price, 0, ',', '.') }}</span>
                    @endif
                </label>
                @endforeach
            </div>
        </div>
        @endforeach
    @endif

    <!-- Button -->
    <div class="right-0 left-0 bottom-0 bg-white border-t border-gray-100 p-4">
        <button 
            class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition"
            wire:click="addToCart"
        >
            Tambahkan ke Keranjang
        </button>
    </div>
</div>
