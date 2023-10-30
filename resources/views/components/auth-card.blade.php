<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-blue-300">


    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-200 shadow-md overflow-hidden sm:rounded-lg">
        <div class="text-3xl font-bold flex flex-col sm:justify-center items-center mb-3">
            {{ $title }}
        </div>
        {{ $slot }}
    </div>
</div>
