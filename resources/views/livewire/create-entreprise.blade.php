<div wire:poll>
    @if (session()->has('message'))
        <div class="alert alert-success mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Nom de l'entreprise</label>
            <input type="text" wire:model="nom" class="input input-bordered w-full" placeholder="Nom de l'entreprise">
            @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">Créer</button>
        </div>
    </form>
</div>
