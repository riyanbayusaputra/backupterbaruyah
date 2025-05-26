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
   <div class="mt-6 mb-8">
    <div class="text-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Silahkan pilih isi menu</h3>
        <p class="text-gray-600 text-base">Pilih sesuai selera Anda</p>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mx-auto mt-3"></div>
    </div>
</div>
 <!-- Dynamic Options -->
 @if($product->options->isEmpty())
    <div class="text-center text-gray-500 my-12">
        Produk ini tidak memiliki opsi kustom.
    </div>
@else
@foreach($product->options as $option)
<div class="mb-12">
    <div class="mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-2 capitalize tracking-wide flex items-center">
            <span class="w-2 h-6 bg-gradient-to-b from-blue-500 to-purple-500 rounded-full mr-3"></span>
            Pilih {{ $option->name }}
        </h3>
        <p class="text-gray-500 text-sm ml-5">Silakan pilih salah satu opsi di bawah</p>
    </div>
    
    <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 px-1">
        @foreach($option->optionItems as $item)
        <label class="min-w-[140px] bg-white border-2 border-gray-200 peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-blue-100 rounded-2xl p-5 flex flex-col items-center text-center cursor-pointer hover:border-blue-300 hover:shadow-xl transition-all duration-300 shadow-md relative group transform hover:-translate-y-1">
            <input
                type="radio"
                name="option_{{ $option->id }}"
                class="hidden peer"
                wire:model="selectedOptions.{{ $option->id }}"
                value="{{ $item->id }}"
                @if($loop->first) checked @endif
            >
            
            <!-- Selection Indicator -->
            <div class="absolute -top-1.5 -right-1.5 w-6 h-6 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 border-2 border-white flex items-center justify-center transition-all duration-300 opacity-0 peer-checked:opacity-100 peer-checked:scale-110 shadow-lg z-20" style="box-shadow: 0 2px 8px 0 rgba(59,130,246,0.15);">
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            
            <!-- Image Container -->
            <div class="w-20 h-20 mb-3 relative overflow-hidden rounded-xl ring-2 ring-gray-100 group-hover:ring-blue-200 transition-all duration-300">
                <img
                    src="{{ $item->image ? asset('storage/' . $item->image) : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=80&q=80' }}"
                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                    alt="{{ $item->name }}"
                >
                <!-- Overlay gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            
            <!-- Item Name -->
            <span class="font-semibold text-gray-800 text-sm mb-1 leading-tight">{{ $item->name }}</span>
            
            <!-- Additional Price -->
            @if($item->additional_price > 0)
                <span class="text-xs font-medium text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 px-2 py-1 bg-blue-50 rounded-full">
                    +Rp {{ number_format($item->additional_price, 0, ',', '.') }}
                </span>
            @else
                <span class="text-xs text-green-600 font-medium px-2 py-1 bg-green-50 rounded-full">
                    {{-- Gratis --}}
                </span>
            @endif
            
            <!-- Selected Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-purple-500/5 rounded-2xl opacity-0 peer-checked:opacity-100 transition-opacity duration-300"></div>
        </label>
        @endforeach
    </div>
</div>
@endforeach
@endif

    <!-- Button -->
    <div class="right-0 left-0 bottom-0 bg-white border-t border-gray-100 p-4">
        <button 
            class="w-full bg-primary text-white font-semibold py-3 rounded-lg "
            wire:click="addToCart"
        >
            Tambahkan ke Keranjang
        </button>
    </div>
</div>


