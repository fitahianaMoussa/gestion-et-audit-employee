<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau d\'Audit des Employés') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de Mise à Jour</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employé</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salaire Ancien</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salaire Nouveau</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800">
                            @foreach ($audits as $audit)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $audit->action }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $audit->date_mise_a_jour }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $audit->nom }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $audit->salaire_ancien }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $audit->salaire_nouv }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $audit->user }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        <p class="text-gray-500 dark:text-gray-400">Nombre d'Insertions : {{ $insertions }}</p>
                        <p class="text-gray-500 dark:text-gray-400">Nombre de Modifications : {{ $modifications }}</p>
                        <p class="text-gray-500 dark:text-gray-400">Nombre de Suppressions : {{ $suppressions }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
