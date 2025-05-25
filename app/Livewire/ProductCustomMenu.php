<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;

class ProductCustomMenu extends Component
{
    public $product;
    public $selectedOptions = [];
    public $cartCount = 0;

    public function mount($slug)
    {
        $this->product = Product::with('options.optionItems')
            ->where('slug', $slug)
            ->firstOrFail();

        // Initialize selected options
        foreach ($this->product->options as $option) {
            // Auto-select first item
            if ($option->optionItems->count() > 0) {
                $this->selectedOptions[$option->id] = $option->optionItems->first()->id;
            }
        }

        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        $this->cartCount = auth()->check()
            ? Cart::where('user_id', auth()->id())->sum('quantity')
            : 0;
    }

    public function addToCart()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        try {
            $customOptionsJson = json_encode($this->selectedOptions);

            // Simplified: Just create new cart item or update existing by product_id only
            $existingCart = Cart::where('user_id', auth()->id())
                ->where('product_id', $this->product->id)
                ->first(); // Remove custom_options_json condition temporarily

            if ($existingCart) {
                $existingCart->update([
                    'quantity' => $existingCart->quantity + 1,
                    'custom_options_json' => $customOptionsJson // Update options
                ]);
            } else {
                Cart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $this->product->id,
                    'quantity' => 1,
                    'custom_options_json' => $customOptionsJson,
                ]);
            }

            $this->updateCartCount();
           
            $this->dispatch('showAlert', [
                'message' => 'Berhasil ditambahkan ke keranjang',
                'type' => 'success'
            ]);

        } catch(\Exception $e) {
            \Log::error('Cart Error: ' . $e->getMessage());
            
            $this->dispatch('showAlert', [
                'message' => 'Gagal menambahkan ke keranjang: ' . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.product-custom-menu');
    }
}