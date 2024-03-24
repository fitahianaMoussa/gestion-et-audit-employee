<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier un employé') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 dark:text-gray-100">
                    <form action="{{ route('employes.update', $employe->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="matricule" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Matricule:</label>
                            <input type="text" id="matricule" name="matricule" value="{{ $employe->matricule }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nom:</label>
                            <input type="text" id="nom" name="nom" value="{{ $employe->nom }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div>
                            <label for="salaire" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Salaire:</label>
                            <input type="text" id="salaire" name="salaire" value="{{ $employe->salaire }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div>
                            <button type="submit" class="inline-block bg-indigo-500 text-white px-4 py-2 rounded-md transition duration-300 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
