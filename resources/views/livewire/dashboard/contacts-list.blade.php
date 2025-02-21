<div class="mx-auto p-4" wire:poll>
    <!-- Barre de recherche et bouton de filtre -->
    <div class="mb-4 flex items-center justify-between sticky top-0 bg-white z-50 p-2">
        <div class="flex-1 ">
            <div class="form-control">
                <div class="input-group">
                    <input type="text" placeholder="Rechercher..."
                           class="input input-bordered w-full"
                           wire:model.live="search" />
                </div>
            </div>
        </div>
        <!-- Bouton pour afficher le mini-menu de filtres -->
        <div x-data="{ open: false }" class="relative ml-4">
            <button @click="open = !open" class="btn btn-sm btn-secondary">Filtrer</button>
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white shadow-lg border rounded p-2 z-10">
                <p class="font-semibold mb-2">Catégories</p>
                @foreach($categories as $categorie)
                    <div class="flex items-center">
                        <input type="checkbox" value="{{ $categorie->id }}" wire:model.live="selectedCategories" id="cat-{{ $categorie->id }}" class="checkbox mr-2">
                        <label for="cat-{{ $categorie->id }}">{{ $categorie->libelle }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Liste des contacts -->
    <div>
        <ul class="divide-y divide-gray-200">
            @forelse($contacts as $contact)
                <li class="py-3 hover:bg-base-200 transition-colors duration-150">
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <div class="flex flex-col">
                            <span class="font-semibold text-base">
                                {!! $this->highlight($contact->personne->prenom, $search) !!}
                                {!! $this->highlight($contact->personne->nom, $search) !!}
                            </span>
                            <div class="mt-1 flex flex-wrap gap-1">
                                @if($contact->categorie)
                                    <span class="badge badge-sm badge-info">
                                        {!! $this->highlight($contact->categorie->libelle, $search) !!}
                                    </span>
                                @else
                                    <span class="badge badge-sm badge-secondary">Sans catégorie</span>
                                @endif
                                @if($contact->personne->entreprise)
                                    <span class="badge badge-sm badge-primary">
                                        {!! $this->highlight($contact->personne->entreprise->nom, $search) !!}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-2 sm:mt-0 text-right">
                            <p class="text-sm">
                                @if($contact->personne->courriel)
                                    <a href="mailto:{{ $contact->personne->courriel }}" class="hover:underline">
                                        {!! $this->highlight($contact->personne->courriel, $search) !!}
                                    </a>
                                @else
                                    <span>Aucun courriel</span>
                                @endif
                            </p>
                            <p class="text-sm">
                                @if($contact->personne->telephone)
                                    <a href="tel:{{ $contact->personne->telephone }}" class="hover:underline">
                                        {!! $this->highlight($contact->personne->telephone, $search) !!}
                                    </a>
                                @else
                                    <span>Aucun téléphone</span>
                                @endif
                            </p>
                            <!-- Bouton Favoris : étoile qui se colore -->
                            <div class="mt-2">
                                <button wire:click="toggleFavorite({{ $contact->id }})" class="focus:outline-none">
                                    <span class="{{ in_array($contact->id, $userFavoris) ? 'text-yellow-500' : 'text-gray-400' }} text-2xl">
                                        ★
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li class="py-3 text-center text-gray-500">Aucun contact trouvé.</li>
            @endforelse
        </ul>

        <div class="mt-4">
            {{ $contacts->links('vendor.pagination.custom-tailwind') }}

        </div>
    </div>
</div>
