<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind CSS Custom Colors Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-12 text-primary">Tailwind CSS Custom Colors Test</h1>
        
        <!-- Elephant Color Palette -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 text-elephant-900">Elephant Color Palette (Primary)</h2>
            <div class="grid grid-cols-11 gap-2">
                <div class="bg-elephant-50 p-4 rounded text-center text-xs font-medium text-elephant-900">
                    <div class="h-16 mb-2"></div>
                    50
                </div>
                <div class="bg-elephant-100 p-4 rounded text-center text-xs font-medium text-elephant-900">
                    <div class="h-16 mb-2"></div>
                    100
                </div>
                <div class="bg-elephant-200 p-4 rounded text-center text-xs font-medium text-elephant-900">
                    <div class="h-16 mb-2"></div>
                    200
                </div>
                <div class="bg-elephant-300 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    300
                </div>
                <div class="bg-elephant-400 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    400
                </div>
                <div class="bg-elephant-500 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    500
                </div>
                <div class="bg-elephant-600 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    600
                </div>
                <div class="bg-elephant-700 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    700
                </div>
                <div class="bg-elephant-800 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    800
                </div>
                <div class="bg-elephant-900 p-4 rounded text-center text-xs font-medium text-white border-4 border-yellow-400">
                    <div class="h-16 mb-2"></div>
                    900 (Primary)
                </div>
                <div class="bg-elephant-950 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    950
                </div>
            </div>
        </div>

        <!-- Forest Green Color Palette -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 text-forest-green-700">Forest Green Color Palette (Success)</h2>
            <div class="grid grid-cols-11 gap-2">
                <div class="bg-forest-green-50 p-4 rounded text-center text-xs font-medium text-forest-green-900">
                    <div class="h-16 mb-2"></div>
                    50
                </div>
                <div class="bg-forest-green-100 p-4 rounded text-center text-xs font-medium text-forest-green-900">
                    <div class="h-16 mb-2"></div>
                    100
                </div>
                <div class="bg-forest-green-200 p-4 rounded text-center text-xs font-medium text-forest-green-900">
                    <div class="h-16 mb-2"></div>
                    200
                </div>
                <div class="bg-forest-green-300 p-4 rounded text-center text-xs font-medium text-forest-green-900">
                    <div class="h-16 mb-2"></div>
                    300
                </div>
                <div class="bg-forest-green-400 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    400
                </div>
                <div class="bg-forest-green-500 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    500
                </div>
                <div class="bg-forest-green-600 p-4 rounded text-center text-xs font-medium text-white border-4 border-yellow-400">
                    <div class="h-16 mb-2"></div>
                    600 (Success)
                </div>
                <div class="bg-forest-green-700 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    700
                </div>
                <div class="bg-forest-green-800 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    800
                </div>
                <div class="bg-forest-green-900 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    900
                </div>
                <div class="bg-forest-green-950 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    950
                </div>
            </div>
        </div>

        <!-- Old Brick Color Palette -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 text-old-brick-700">Old Brick Color Palette (Danger)</h2>
            <div class="grid grid-cols-11 gap-2">
                <div class="bg-old-brick-50 p-4 rounded text-center text-xs font-medium text-old-brick-900">
                    <div class="h-16 mb-2"></div>
                    50
                </div>
                <div class="bg-old-brick-100 p-4 rounded text-center text-xs font-medium text-old-brick-900">
                    <div class="h-16 mb-2"></div>
                    100
                </div>
                <div class="bg-old-brick-200 p-4 rounded text-center text-xs font-medium text-old-brick-900">
                    <div class="h-16 mb-2"></div>
                    200
                </div>
                <div class="bg-old-brick-300 p-4 rounded text-center text-xs font-medium text-old-brick-900">
                    <div class="h-16 mb-2"></div>
                    300
                </div>
                <div class="bg-old-brick-400 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    400
                </div>
                <div class="bg-old-brick-500 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    500
                </div>
                <div class="bg-old-brick-600 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    600
                </div>
                <div class="bg-old-brick-700 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    700
                </div>
                <div class="bg-old-brick-800 p-4 rounded text-center text-xs font-medium text-white border-4 border-yellow-400">
                    <div class="h-16 mb-2"></div>
                    800 (Danger)
                </div>
                <div class="bg-old-brick-900 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    900
                </div>
                <div class="bg-old-brick-950 p-4 rounded text-center text-xs font-medium text-white">
                    <div class="h-16 mb-2"></div>
                    950
                </div>
            </div>
        </div>

        <!-- Component Examples -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Component Examples</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Primary Button -->
                <div class="text-center">
                    <button class="bg-primary hover:bg-elephant-800 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-200">
                        Primary Button
                    </button>
                    <p class="mt-2 text-sm text-gray-600">Primary Color (#253543)</p>
                </div>
                
                <!-- Success Button -->
                <div class="text-center">
                    <button class="bg-success hover:bg-forest-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-200">
                        Success Button
                    </button>
                    <p class="mt-2 text-sm text-gray-600">Success Color (#1b9938)</p>
                </div>
                
                <!-- Danger Button -->
                <div class="text-center">
                    <button class="bg-danger hover:bg-old-brick-900 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-200">
                        Danger Button
                    </button>
                    <p class="mt-2 text-sm text-gray-600">Danger Color (#992323)</p>
                </div>
            </div>
        </div>

        <!-- Alert Examples -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Alert Examples</h2>
            <div class="space-y-4">
                <div class="bg-elephant-50 border-l-4 border-elephant-600 p-4 rounded">
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-sm text-elephant-800">
                                <strong class="font-medium text-elephant-900">Info:</strong>
                                This is an informational alert using the elephant color palette.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-forest-green-50 border-l-4 border-forest-green-600 p-4 rounded">
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-sm text-forest-green-800">
                                <strong class="font-medium text-forest-green-900">Success:</strong>
                                This is a success alert using the forest green color palette.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-old-brick-50 border-l-4 border-old-brick-600 p-4 rounded">
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-sm text-old-brick-800">
                                <strong class="font-medium text-old-brick-900">Error:</strong>
                                This is an error alert using the old brick color palette.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-gray-600 text-sm">
            <p>Tailwind CSS setup complete with custom color themes!</p>
            <p class="mt-2">Visit <a href="/" class="text-primary hover:text-elephant-700 underline">homepage</a> to return to the main page.</p>
        </div>
    </div>
</body>
</html>