<!doctype html>
<html data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mon Dashboard</title>
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        main {
            overflow-y: hidden;
        }
    </style>
</head>

<body>
    <main>
        <div class="w-screen h-screen grid grid-cols-11 grid-rows-12 gap-0">
            <div class="row-start-[1] row-span-[2] col-start-[1] col-span-[5] card bg-base-100 shadow-xl m-2 p-4">
            @include('components.dashboard-nav')
        </div>

        <div class="row-start-[1] row-span-[2] col-start-[6] col-span-[3] card bg-base-100 shadow-xl m-2 p-4" x-data="{ openContactModal: false, openEntrepriseModal: false }">
            @include('components.dashboard-button-create')
        </div>

            <div
                class="row-start-[1] row-span-[2] col-start-[9] col-span-[3] card bg-base-100 shadow-xl m-2 p-4 flex flex-col items-end text-right">
                <h2 class="text-2xl font-bold text-gray-900">{{ $prenom }} {{ $nom }}</h2>
                <p class="text-gray-500 text-sm mt-1">{{ $email }}</p>
                <hr class="my-2 w-full">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline">Déconnexion</button>
                </form>
            </div>

            <div class="row-start-[3] row-span-[10] col-start-[1] col-span-[3] card bg-base-100 shadow-xl m-2 p-4">
                <div class="row-start-[1] row-span-[2] col-start-[1] col-span-[3] ">
                    <h2 class="text-2xl font-bold text-center">Contacts</h2>
                </div>
                <div class="row-start-[2] row-span-[3] col-start-[1] col-span-[3]"></div>
                <div class="overflow-auto" wire:init="loadContacts">
                    <div wire:loading>
                        Chargement des contacts...
                    </div>
                    <div wire:loading.remove>
                        <livewire:contacts-list />
                    </div>
                </div>
            </div>

            <div class="row-start-[3] row-span-[10] col-start-[9] col-span-[3] card bg-base-100 shadow-xl m-2 p-4">
                <livewire:companies-list />
            </div>

            <div
                class="row-start-[3] row-span-[2] col-start-[4] col-span-[5] card bg-base-100 shadow-xl m-2 p-4 flex items-center justify-center">
                <livewire:stats />
            </div>

            <div class="row-start-[5] row-span-[8] col-start-[4] col-span-[5] card bg-base-100 shadow-xl m-2 p-4">
                <div class="row-start-[1] row-span-[2] col-start-[4] col-span-[5]">
                    <h2 class="text-2xl font-bold text-center">Contacts favoris</h2>
                </div>
                <div class="row-start-[2] row-span-[3] col-start-[4] col-span-[5]"></div>
                <div class="overflow-auto">
                    <livewire:favorite-contacts-list />
                </div>
            </div>
        </div>
    </main>
</body>

</html>
