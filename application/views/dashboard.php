<?php $this->load->view('component/head', ['title' => lang('dashboard') . ' · Clipminer']); ?>

<?php $this->load->view('component/navbar'); ?>

<main class="flex flex-col justify-center container mx-auto px-6 py-12">

    <div class="grid grid-cols-12 gap-6">

        <div class="col-span-12 lg:col-span-4 space-y-6">
            <div class="bg-brand-surface border border-white/5 rounded-3xl p-8 sticky top-24 shadow-2xl">
                <div class="mb-8">
                    <div class="w-12 h-12 bg-brand-primary/20 rounded-2xl flex items-center justify-center text-brand-primary text-2xl mb-4">
                        <ion-icon name="sparkles"></ion-icon>
                    </div>
                    <h2 class="text-2xl font-bold"><?= lang('new_project') ?></h2>
                    <p class="text-gray-400 text-sm mt-2"><?= lang('project_desc') ?></p>
                </div>

                <form action="<?= base_url('dashboard/submit') ?>" method="POST" class="space-y-4">
                    <div class="space-y-2">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider ml-1"><?= lang('youtube_url') ?></label>
                        <input name="youtube_url" type="text"
                            class="w-full bg-brand-bg border border-white/10 rounded-2xl px-4 py-4 text-sm focus:ring-2 focus:ring-brand-primary outline-none transition-all text-gray-200"
                            placeholder="https://youtube.com/watch?v=..." required>
                    </div>

                    <button type="submit" class="w-full bg-white text-black font-bold py-4 rounded-2xl hover:bg-brand-primary hover:text-white transition-all duration-300 flex items-center justify-center gap-2 group">
                        <span><?= lang('mine_clips') ?></span>
                        <ion-icon name="arrow-forward" class="group-hover:translate-x-1 transition-transform"></ion-icon>
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-white/5 flex items-center gap-4">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full border-2 border-brand-surface bg-pink-500 flex items-center justify-center text-[10px]"><ion-icon name="logo-instagram"></ion-icon></div>
                        <div class="w-8 h-8 rounded-full border-2 border-brand-surface bg-cyan-500 flex items-center justify-center text-[10px]"><ion-icon name="logo-tiktok"></ion-icon></div>
                        <div class="w-8 h-8 rounded-full border-2 border-brand-surface bg-red-500 flex items-center justify-center text-[10px]"><ion-icon name="logo-youtube"></ion-icon></div>
                    </div>
                    <p class="text-[10px] text-gray-500 font-medium italic"><?= lang('platform_ready') ?></p>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-8">
            <div class="flex items-center justify-between mb-6 px-2">
                <h3 class="text-xl font-bold"><?= lang('recent_mining') ?></h3>
                <div class="flex gap-2">
                    <button class="p-2 bg-white/5 rounded-lg hover:bg-white/10 text-gray-400"><ion-icon name="grid-outline"></ion-icon></button>
                </div>
            </div>

            <?php if (empty($jobs)): ?>
                <div class="mt-auto h-96 border-2 border-dashed border-white/5 rounded-3xl flex flex-col items-center justify-center text-gray-600 py-12">
                    <ion-icon name="rocket-outline" class="text-4xl mb-2 opacity-20"></ion-icon>
                    <p><?= lang('no_projects') ?></p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach (array_reverse($jobs) as $job): ?>
                        <div class="group bg-brand-surface border border-white/5 rounded-3xl p-5 hover:border-brand-primary/50 transition-all duration-500 relative overflow-hidden">
                            <div class="relative z-10">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-10 h-10 bg-brand-bg rounded-xl flex items-center justify-center text-brand-primary text-xl shadow-inner">
                                        <ion-icon name="videocam-outline"></ion-icon>
                                    </div>
                                    <span class="px-3 py-1 rounded-lg bg-brand-bg border border-white/5 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                        <?= lang($job['status']) ?>
                                    </span>
                                </div>

                                <p class="text-sm font-semibold text-gray-200 truncate mb-1"><?= lang('video_id') ?>: <?= substr(basename($job['youtube_url']), 0, 15) ?>...</p>
                                <p class="text-[10px] text-gray-500 mb-6 flex items-center gap-1">
                                    <ion-icon name="time-outline"></ion-icon>
                                    <?= date('M d, Y • H:i', strtotime($job['created_at'])) ?>
                                </p>

                                <div class="flex items-center justify-between">
                                    <?php if ($job['status'] === 'preview_ready'): ?>
                                        <a href="<?= base_url('dashboard/preview/' . $job['id']) ?>"
                                            class="text-xs font-bold text-brand-primary group-hover:text-white transition-colors flex items-center gap-1">
                                            <?= lang('open_studio') ?> <ion-icon name="arrow-forward-outline"></ion-icon>
                                        </a>
                                    <?php else: ?>
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 bg-brand-primary rounded-full animate-pulse"></div>
                                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest"><?= lang('mining_status') ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</main>

<?php $this->load->view('component/footer'); ?>