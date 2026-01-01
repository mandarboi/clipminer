<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clipminer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',     // indigo-600
                        primaryDark: '#4338ca', // indigo-700
                        accent: '#10b981'       // emerald-500
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-8">

        <!-- Header -->
        <div class="mb-6 flex items-center gap-3">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-primary text-white">
                <ion-icon name="cut-outline" class="text-2xl"></ion-icon>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Clipminer</h1>
                <p class="text-gray-500 text-sm">
                    Turn long videos into viral shorts
                </p>
            </div>
        </div>

        <!-- Form -->
        <form id="clipForm" method="post" action="/dashboard/submit" class="space-y-4" novalidate>

            <!-- Error message -->
            <div id="errorBox" class="hidden flex items-center gap-2 bg-red-50 border border-red-200 text-red-600 text-sm rounded-lg px-4 py-3">
                <ion-icon name="alert-circle-outline" class="text-lg"></ion-icon>
                <span id="errorMessage">Invalid URL</span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    YouTube Video URL
                </label>

                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <ion-icon name="logo-youtube"></ion-icon>
                    </span>

                    <input
                        type="text"
                        id="youtubeUrl"
                        name="youtube_url"
                        placeholder="https://www.youtube.com/watch?v=xxxxx"
                        class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-3
                            focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                    >


                </div>
            </div>

            <button
                type="submit"
                class="w-full flex items-center justify-center gap-2
                       bg-primary hover:bg-primaryDark
                       text-white font-semibold py-3 rounded-lg transition"
            >
                <ion-icon name="rocket-outline"></ion-icon>
                Create Clip Job
            </button>
        </form>

        <!-- Job List -->

        <!-- Footer -->
        <div class="mt-6 text-center text-sm text-gray-400 flex items-center justify-center gap-2">
            <ion-icon name="sparkles-outline"></ion-icon>
            AI-powered · Shorts-Reels-Tiktok Video · Viral Hunt
        </div>

    </div>
    <script>
        const form = document.getElementById('clipForm');
        const input = document.getElementById('youtubeUrl');
        const errorBox = document.getElementById('errorBox');
        const errorMessage = document.getElementById('errorMessage');

        form.addEventListener('submit', function (e) {
            const value = input.value.trim();

            errorBox.classList.add('hidden');

            if (value === '') {
                e.preventDefault();
                showError('Please paste a YouTube video URL.');
                return;
            }

            if (!value.includes('youtube.com') && !value.includes('youtu.be')) {
                e.preventDefault();
                showError('That doesn’t look like a valid YouTube URL.');
                return;
            }
        });

        function showError(message) {
            errorMessage.textContent = message;
            errorBox.classList.remove('hidden');
        }
    </script>


</body>
</html>
