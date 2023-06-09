<!-- resources/views/livewire/product-form.blade.php -->
<div>
    <form wire:submit.prevent="submitForm">
        <label for="productTitle">Product Title</label>
        <input type="text" id="productTitle" wire:model="productTitle">
        
        <label for="productImage">Product Image</label>
        <input type="file" id="productImage" wire:model="productImage">
        
        <button type="submit">Submit</button>
    </form>
</div>
