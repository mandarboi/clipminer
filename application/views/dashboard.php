<?php $this->load->view('component/head', ['title' => lang('dashboard') . ' · Clipminer']); ?>

<body class="text-gray-600 min-h-screen flex flex-col">

<?php $this->load->view('component/navbar'); ?>

<main class="min-h-screen text-gray-600">

    <div class="text-center mt-20 space-y-6">

        <div class="flex justify-center gap-6 text-3xl">
            <ion-icon name="logo-instagram" class="text-pink-500"></ion-icon>
            <ion-icon name="logo-tiktok" class="text-cyan-400"></ion-icon>
            <ion-icon name="logo-youtube" class="text-red-500"></ion-icon>
        </div>

        <h1 class="text-3xl font-bold">
            Turn videos into <span class="text-brand-primary">social-ready clips</span>
        </h1>

        <p class="text-gray-600/60">
            Optimized for Reels, TikTok & YouTube Shorts
        </p>

    </div>


    <!-- INPUT BAR -->
    <section class="sticky top-0 z-20 bg-brand-bg/80 backdrop-blur border-b border-white/5">
        <div class="max-w-5xl mx-auto px-6 py-5">
            <form class="max-w-2xl mx-auto mt-10 space-y-4">

                <input
                    placeholder="Paste YouTube link here..."
                    class="w-full px-5 py-4 rounded-xl
                        bg-white/5 border border-white/10
                        focus:ring-2 focus:ring-brand-primary
                        text-sm"
                >

                <button
                    class="w-full py-4 rounded-xl
                        bg-brand-primary font-semibold
                        hover:opacity-90 transition">
                    Generate Clips
                </button>

                <p class="text-center text-xs text-gray-600/40">
                    Free preview · No credit card required
                </p>

            </form>

        </div>
    </section>

    <!-- CONTENT -->
    <section class="max-w-5xl mx-auto px-6 py-10 space-y-6">

        <h1 class="text-xl font-semibold">Your Jobs</h1>

        <?php if (empty($jobs)): ?>
            <!-- EMPTY STATE -->
            <div class="border border-white/10 rounded-2xl p-10 text-center text-gray-600/50">
                Paste a YouTube link above to generate your first clip.
            </div>
        <?php endif; ?>

        <?php foreach (array_slice(array_reverse($jobs), 0, 3) as $job): ?>
            <div class="flex items-center justify-between
                        border border-white/10 rounded-xl
                        px-5 py-4 bg-white/5">

                <!-- LEFT -->
                <div class="space-y-1">
                    <p class="text-sm font-medium truncate max-w-md">
                        <?= $job['youtube_url'] ?>
                    </p>
                    <p class="text-xs text-gray-600/50">
                        <?= $job['created_at'] ?>
                    </p>
                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-3 text-sm">

                    <?php if ($job['status'] === 'preview_ready'): ?>
                        <span class="px-3 py-1 rounded-full bg-brand-primary/20
                                     text-brand-primary text-xs">
                            Preview ready
                        </span>

                        <a href="<?= base_url('dashboard/preview/'.$job['id']) ?>"
                           class="text-brand-primary hover:underline">
                            View →
                        </a>

                    <?php else: ?>
                        <span class="px-3 py-1 rounded-full bg-white/10 text-xs">
                            Processing…
                        </span>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; ?>

    </section>

</main>

<?php $this->load->view('component/footer'); ?>

