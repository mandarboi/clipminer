<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clips Ready · Clipminer</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0f1220] text-white min-h-screen">

    <!-- NAVBAR -->
    <?php $this->load->view('component/navbar'); ?>

    <!-- PAGE CONTENT -->
    <main class="max-w-7xl mx-auto px-6 py-12">

        <!-- Title -->
        <h1 class="text-3xl font-bold mb-10">
            Success! Your clips are ready!
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- LEFT: CLIPS PREVIEW -->
            <div class="lg:col-span-2">
                <div class="flex flex-col sm:flex-row gap-6">

                    <?php foreach ($previews as $clip): ?>
                        <div class="w-full sm:w-56 bg-[#1a1f36] rounded-2xl p-4 shadow-lg">
                            
                            <div class="aspect-[9/16] bg-black/30 rounded-xl mb-4 flex items-center justify-center text-white/30">
                                <!-- thumbnail placeholder -->
                                Preview
                            </div>

                            <div class="space-y-1">
                                <p class="font-semibold">
                                    <?= $clip['title'] ?>
                                </p>
                                <p class="text-sm text-white/60">
                                    <?= $clip['duration'] ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <!-- RIGHT: CTA -->
            <div class="bg-[#1a1f36] rounded-2xl p-8 shadow-xl flex flex-col justify-between">

                <div>
                    <h2 class="text-xl font-semibold mb-4">
                        Let AI do the work
                    </h2>

                    <ul class="space-y-3 text-white/80 text-sm">
                        <li class="flex gap-2">
                            <span>✔</span>
                            <span>Turn videos into short viral clips</span>
                        </li>
                        <li class="flex gap-2">
                            <span>✔</span>
                            <span>Automatic captions</span>
                        </li>
                        <li class="flex gap-2">
                            <span>✔</span>
                            <span>Easy editing</span>
                        </li>
                        <li class="flex gap-2">
                            <span>✔</span>
                            <span>Share to TikTok & Shorts</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8">
                    <a href="<?= base_url('login') ?>"
                       class="block w-full text-center rounded-xl bg-indigo-600 hover:bg-indigo-500 transition py-4 font-semibold text-white">
                        Continue →
                    </a>

                    <p class="text-center text-xs text-white/50 mt-4">
                        Sign up to download your clips. It only takes a minute.
                    </p>
                </div>

            </div>
        </div>

    </main>

</body>
</html>
