<div class="flex justify-center items-center space-x-6 py-4">
    <button
        @click="openContactModal = true"
        class="btn btn-primary px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
        Créer Contact
    </button>
    <button
        @click="openEntrepriseModal = true"
        class="btn btn-secondary px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
        Créer Entreprise
    </button>
</div>

<div x-show="openContactModal" class="fixed inset-0 flex items-center justify-center z-60" style="display: none;">
    <div class="fixed inset-0 bg-gray-900 opacity-50" @click="openContactModal = false"></div>
    <div class="bg-white p-8 rounded-xl shadow-2xl z-70 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Créer Contact</h3>
            <button @click="openContactModal = false" class="text-gray-500 text-3xl leading-none">&times;</button>
        </div>
        <livewire:create-contact />
    </div>
</div>

<div x-show="openEntrepriseModal" class="fixed inset-0 flex items-center justify-center z-60" style="display: none;">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-gray-900 opacity-50" @click="openEntrepriseModal = false"></div>
    <div class="bg-white p-8 rounded-xl shadow-2xl z-70 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Créer Entreprise</h3>
            <button @click="openEntrepriseModal = false" class="text-gray-500 text-3xl leading-none">&times;</button>
        </div>
        <livewire:create-entreprise />
    </div>
</div>
