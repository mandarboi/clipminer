<?php $this->load->view('component/head', ['title' => lang('preview_ready') . ' · Clipminer']); ?>

<body class="bg-brand-bg text-white min-h-screen flex flex-col">
    <?php $this->load->view('component/navbar'); ?>

    <main class="max-w-7xl mx-auto px-6 py-12 flex-grow">
        <h1 class="text-4xl font-bold mb-10 "><?= lang('success_msg') ?></h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-8">
                <div id="loading-state" class="flex flex-col items-center justify-center py-24 bg-brand-surface rounded-[2.5rem] border border-white/5 shadow-2xl">
                    <div class="w-16 h-16 border-4 border-brand-primary border-t-transparent rounded-full animate-spin mb-4"></div>
                    <p class="text-gray-400 animate-pulse  tracking-widest text-xs font-bold">Extracting Real Subtitles...</p>
                </div>

                <div id="clips-container" class="grid grid-cols-1 sm:grid-cols-3 gap-6 hidden"></div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-brand-surface border border-white/5 rounded-3xl p-8 sticky top-24 shadow-2xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-brand-primary/20 rounded-2xl flex items-center justify-center text-brand-primary text-2xl shrink-0">
                            <ion-icon name="color-wand"></ion-icon>
                        </div>
                        <h2 class="text-xl font-bold"><?= lang('ai_work') ?></h2>
                    </div>
                    <ul class="space-y-4 mb-10 text-gray-400 text-sm">
                        <li class="flex items-center gap-3"><ion-icon name="checkmark-circle" class="text-brand-primary"></ion-icon> <?= lang('feature_clips') ?></li>
                        <li class="flex items-center gap-3"><ion-icon name="checkmark-circle" class="text-brand-primary"></ion-icon> <?= lang('feature_captions') ?></li>
                        <li class="flex items-center gap-3"><ion-icon name="checkmark-circle" class="text-brand-primary"></ion-icon> <?= lang('feature_share') ?></li>
                    </ul>
                    </ul>
                    <a href="<?= base_url('register') ?>" class="block w-full text-center bg-white text-black py-4 rounded-2xl font-black  tracking-widest hover:bg-brand-primary hover:text-white transition-all shadow-xl"><?= lang('continue') ?> →</a>
                </div>
            </div>
        </div>
    </main>

    <div id="loginModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-black/90 backdrop-blur-sm">
        <div class="bg-brand-surface border border-white/10 p-10 rounded-[2.5rem] max-w-sm w-full text-center shadow-2xl mx-6">
            <div class="text-6xl text-brand-primary mb-6 flex justify-center"><ion-icon name="lock-closed"></ion-icon></div>
            <h3 class="text-2xl font-bold mb-3  italic"><?= lang('unlock_access') ?></h3>
            <p class="text-gray-400 text-sm mb-10 leading-relaxed"><?= lang('unlock_desc') ?></p>
            <div class="space-y-3">
                <a href="<?= base_url('register') ?>" class="block w-full py-4 bg-brand-primary rounded-2xl font-bold text-white"><?= lang('continue') ?></a>
                <button onclick="closeModal()" class="text-[10px] text-gray-600  font-black tracking-widest mt-4 hover:text-white transition">Close Preview</button>
            </div>
        </div>
    </div>

    <?php if (!is_array($job) || !isset($job['id'])): ?>
        <div class="text-red-500 text-sm">
            Invalid job data. Please resubmit your video.
        </div>
    <?php return;
    endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gunakan site_url agar otomatis menangani index.php jika diperlukan
            const apiUrl = '<?= site_url("web/dashboard/get_clips_data/" . $job['id']) ?>';

            console.log("Fetching from:", apiUrl);

            fetch(apiUrl)
                .then(response => {
                    if (!response.ok) throw new Error('Status: ' + response.status);
                    return response.text();
                })
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        console.log("Data Transcript Ril:", data); // LIHAT DI CONSOLE F12
                        if (data.status === 'success') {
                            renderClips(data.previews);
                        }
                    } catch (e) {
                        console.error("JSON Error. Response received:", text);
                        document.getElementById('loading-state').innerHTML = '<p class="text-red-500 text-xs">Failed to extract real transcript. Refresh page.</p>';
                    }
                })
                .catch(err => console.error("Fetch Error:", err));
        });

        function renderClips(previews) {
            const container = document.getElementById('clips-container');
            container.innerHTML = previews.map(clip => `
        <div onclick="showLoginModal()" class="group cursor-pointer bg-brand-surface border border-white/5 rounded-[2rem] p-4 shadow-2xl transition-all hover:border-brand-primary/40">
            <div class="relative aspect-[9/16] bg-black rounded-[1.5rem] overflow-hidden border border-white/5 shadow-inner">
                <img src="${clip.thumbnail}" class="absolute inset-0 w-full h-full object-cover opacity-60">
                
                <div class="absolute inset-x-0 bottom-24 text-center px-4 z-20 pointer-events-none">
                    <span class="bg-yellow-400 text-black font-black italic px-3 py-1 text-[11px] uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] inline-block leading-tight line-clamp-2 italic">
                        "${clip.caption}"
                    </span>
                </div>

                <div class="relative z-10 flex h-full items-center justify-center text-brand-primary text-6xl opacity-0 group-hover:opacity-100 transition-opacity">
                    <ion-icon name="play-circle"></ion-icon>
                </div>

                <div class="absolute bottom-4 right-4 bg-black/70 backdrop-blur px-2 py-1 rounded-lg text-[10px] font-bold text-white/80">
                    ${clip.duration}
                </div>
            </div>
            <div class="mt-4 px-2 text-center">
                <p class="font-bold text-gray-200">${clip.title}</p>
                <p class="text-[9px] text-brand-primary font-black uppercase italic tracking-tighter">SARAN KLIP AI</p>
            </div>
        </div>`).join('');

            document.getElementById('loading-state').remove();
            container.classList.remove('hidden');
        }
    </script>
    <?php $this->load->view('component/footer'); ?>