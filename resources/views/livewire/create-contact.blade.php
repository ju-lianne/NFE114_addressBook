<div>
    @if (session()->has('message'))
        <div class="alert alert-success mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Prénom</label>
            <input type="text" wire:model="name" class="input input-bordered w-full" placeholder="Prénom">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Nom</label>
            <input type="text" wire:model="surname" class="input input-bordered w-full" placeholder="Nom">
            @error('surname') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Téléphone</label>
            <input type="text" wire:model="phone" class="input input-bordered w-full" placeholder="Téléphone">
            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Courriel</label>
            <input type="email" wire:model="email" class="input input-bordered w-full" placeholder="Courriel">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Entreprise</label>
            <select wire:model="entreprise_id" class="select select-bordered w-full">
                <option value="">Sélectionner une entreprise</option>
                @foreach($entreprises as $entreprise)
                    <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                @endforeach
            </select>
            @error('entreprise_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Catégorie</label>
            <select wire:model="categorie_id" class="select select-bordered w-full">
                <option value="">Sélectionner une catégorie</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                @endforeach
            </select>
            @error('categorie_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">Créer</button>
        </div>
    </form>
</div>
