 <div class="flex flex-col sm:flex-row gap-8 w-full" wire:poll>
        <div class="rounded-xl flex-1 p-8 flex flex-col items-center">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M7 21v-2a4 4 0 0 1 3-3.87"/>
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M20 8v2a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4V8"/>
                </svg>
            </div>
            <div class="text-3xl font-bold">{{ $contactsCount }}</div>
            <div class="text-sm  font-medium">Contacts</div>
        </div>
        <div class="rounded-xl flex-1 p-8 flex flex-col items-center ">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15 8.5 22 9.3 17 14 18.2 21 12 18 5.8 21 7 14 2 9.3 9 8.5 12 2"/>
                </svg>
            </div>
            <div class="text-3xl font-bold">{{ $favoritesCount }}</div>
            <div class="text-sm  font-medium">Favoris</div>
        </div>
        <div class="rounded-xl  flex-1 p-8 flex flex-col items-center">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <line x1="3" y1="9" x2="21" y2="9"/>
                    <line x1="9" y1="21" x2="9" y2="9"/>
                </svg>
            </div>
            <div class="text-3xl font-bold">{{ $entreprisesCount }}</div>
            <div class="text-sm font-medium">Entreprises</div>
        </div>
    </div>
