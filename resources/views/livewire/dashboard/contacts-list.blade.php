@php
    function highlight($text, $search) {
        if (!$search) {
            return e($text);
        }
        $escaped = e($text);
        return preg_replace('/(' . preg_quote($search, '/') . ')/i', '<span style="background-color:yellow;">$1</span>', $escaped);
    }
@endphp

<div class="w-full h-full bg-base-200 p-4 flex flex-col">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Liste des Contacts</h2>
        <div class="form-control">
            <div class="input-group">
                <input type="text" placeholder="Rechercher..."
                       class="input input-bordered"
                       wire:model.live="search" />
                <button wire:click="$refresh" class="btn btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-4.35-4.35m1.55-5.15A7 7 0 1110 3a7 7 0 017 7z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto pr-2">
        <div class="grid grid-cols-1 gap-4">
            @forelse($contacts as $contact)
                <div class="card card-bordered shadow-md flex items-center p-4">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold flex items-center">
                            {!! highlight($contact->personne->prenom, $search) !!} {!! highlight($contact->personne->nom, $search) !!}
                            @if($contact->categorie)
                                <span class="badge badge-info text-sm ml-2">
                                    {!! highlight($contact->categorie->libelle, $search) !!}
                                </span>
                            @else
                                <span class="badge badge-secondary text-sm ml-2">
                                    Sans catégorie
                                </span>
                            @endif
                            @if($contact->personne->entreprise)
                                <span class="badge badge-primary text-sm ml-2">
                                    {!! highlight($contact->personne->entreprise->nom, $search) !!}
                                </span>
                            @endif
                        </h3>
                        <p class="text-sm text-gray-500">
                            @if($contact->personne->courriel)
                                <a href="mailto:{{ $contact->personne->courriel }}" class="hover:underline">
                                    {!! highlight($contact->personne->courriel, $search) !!}
                                </a>
                            @else
                                Aucun courriel
                            @endif
                        </p>
                        <p class="text-sm text-gray-500">
                            @if($contact->personne->telephone)
                                <a href="tel:{{ $contact->personne->telephone }}" class="hover:underline">
                                    {!! highlight($contact->personne->telephone, $search) !!}
                                </a>
                            @else
                                Aucun téléphone
                            @endif
                        </p>
                    </div>
                </div>
            @empty
                <div class="text-center col-span-1">Aucun contact trouvé.</div>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        {{ $contacts->links() }}
    </div>
</div>
