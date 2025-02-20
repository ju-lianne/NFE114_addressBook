<div class=" p-4">
    <div class="mb-4 flex items-center justify-between sticky top-0 bg-white z-50 p-2">
        <div class="flex-1">
            <div class="form-control">
                <div class="input-group">
                    <input type="text" placeholder="Rechercher une entreprise..."
                           class="input input-bordered w-full"
                           wire:model.live="search" />
                </div>
            </div>
        </div>
    </div>

    <div>
        <ul class="divide-y divide-gray-200">
            @forelse($entreprises as $entreprise)
                <li class="py-3 hover:bg-base-200 transition-colors duration-150">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-base">{{ $entreprise->nom }}</span>
                        <span class="badge badge-sm badge-primary">
                            {{ $entreprise->personnes_count }} contacts
                        </span>
                    </div>
                </li>
            @empty
                <li class="py-3 text-center text-gray-500">Aucune entreprise trouvée.</li>
            @endforelse
        </ul>

        <div class="mt-4">
            {{ $entreprises->links() }}
        </div>
    </div>
</div>
