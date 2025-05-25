<div class="max-w-[480px] mx-auto bg-white min-h-screen relative shadow-lg pb-36 px-4">
    <!-- Header -->
    <div class="pt-6">
        <div x-data="{ loaded: false }" class="w-full h-48 mb-3 relative">
            <!-- Splashscreen/Placeholder -->
            <div x-show="!loaded" class="absolute inset-0 flex items-center justify-center bg-gray-200 rounded-md animate-pulse">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                    <circle cx="24" cy="24" r="20" stroke-width="4" />
                </svg>
            </div>
            <!-- Gambar -->
            <img 
                src="{{ $product->image ?? 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=480&q=80' }}" 
                alt="{{ $product->name }}" 
                class="w-full h-48 object-cover rounded-md transition-opacity duration-300"
                x-on:load="loaded = true"
                :class="loaded ? 'opacity-100' : 'opacity-0'"
            >
        </div>
        <h2 class="text-xl font-bold text-gray-800">{{ $product->name }}</h2>
        <p class="text-gray-500 text-sm">Harga Rp {{ number_format($product->price, 0, ',', '.') }}</p>
    </div>

    <!-- Dynamic Options -->
    @foreach($product->options as $option)
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">pilih {{ $option->name }}</h3>
        
        <!-- Radio Buttons -->
        <div class="grid grid-cols-2 gap-4">
            @foreach($option->optionItems as $item)
            <label class="border rounded-lg p-3 flex flex-col items-center text-center cursor-pointer hover:border-blue-500 transition-all relative">
                <input 
                    type="radio" 
                    name="option_{{ $option->id }}" 
                    class="hidden peer" 
                    wire:model="selectedOptions.{{ $option->id }}" 
                    value="{{ $item->id }}"
                    @if($loop->first) checked @endif
                >
                <div class="absolute top-2 right-2 w-4 h-4 rounded-full border-2 border-blue-500 bg-white peer-checked:bg-blue-500"></div>
                
                <div x-data="{ loaded: false }" class="w-20 h-20 mb-2 relative">
                    <div x-show="!loaded" class="absolute inset-0 flex items-center justify-center bg-gray-200 rounded animate-pulse"></div>
                    <img 
                        src="{{ $item->image ?? 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=80&q=80' }}" 
                        class="w-20 h-20 object-cover rounded transition-opacity duration-300" 
                        alt="{{ $item->name }}" 
                        x-on:load="loaded = true" 
                        :class="loaded ? 'opacity-100' : 'opacity-0'"
                    >
                </div>
                
                <span class="font-medium">{{ $item->name }}</span>
                @if($item->additional_price > 0)
                    <span class="text-sm text-blue-500">+Rp {{ number_format($item->additional_price, 0, ',', '.') }}</span>
                @endif
            </label>
            @endforeach
        </div>
    </div>
    @endforeach

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