<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-500 dark:text-blue-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg transition duration-300 ease-in-out hover:shadow-2xl">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">Benvingut al teu Dashboard</h3>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">
                            {{ now()->format('d M, Y') }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <div class="bg-indigo-50 dark:bg-gray-700 p-6 rounded-lg shadow transition duration-300 ease-in-out hover:shadow-md hover:transform hover:-translate-y-1">
                            <div class="text-indigo-500 dark:text-indigo-300 text-3xl mb-2">🎬</div>
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Els teus Vídeos</h4>
                            <p class="text-gray-600 dark:text-gray-300">Gestiona i visualitza tots els teus vídeos.</p>
                            <a href="{{ url('videos') }}" class="mt-4 inline-block text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium">
                                Veure vídeos →
                            </a>
                        </div>

                        <div class="bg-indigo-50 dark:bg-gray-700 p-6 rounded-lg shadow transition duration-300 ease-in-out hover:shadow-md hover:transform hover:-translate-y-1">
                            <div class="text-indigo-500 dark:text-indigo-300 text-3xl mb-2">📺</div>
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Les teves Sèries</h4>
                            <p class="text-gray-600 dark:text-gray-300">Organitza els teus vídeos en sèries temàtiques.</p>
                            <a href="{{ url('series') }}" class="mt-4 inline-block text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium">
                                Veure sèries →
                            </a>
                        </div>

                        <div class="bg-indigo-50 dark:bg-gray-700 p-6 rounded-lg shadow transition duration-300 ease-in-out hover:shadow-md hover:transform hover:-translate-y-1">
                            <div class="text-indigo-500 dark:text-indigo-300 text-3xl mb-2">👥</div>
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Usuaris</h4>
                            <p class="text-gray-600 dark:text-gray-300">Gestiona els usuaris de la plataforma.</p>
                            <a href="{{ url('users') }}" class="mt-4 inline-block text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium">
                                Veure usuaris →
                            </a>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-3">Accés Ràpid</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <a href="{{ url('videos/manage') }}" class="bg-white/20 hover:bg-white/30 p-3 rounded-lg text-center transition duration-300">
                                Gestió de Vídeos
                            </a>
                            <a href="{{ url('series/manage') }}" class="bg-white/20 hover:bg-white/30 p-3 rounded-lg text-center transition duration-300">
                                Gestió de Sèries
                            </a>
                            <a href="{{ url('users/manage') }}" class="bg-white/20 hover:bg-white/30 p-3 rounded-lg text-center transition duration-300">
                                Gestió d'Usuaris
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
