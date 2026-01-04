<nav class="w-full bg-brand-bg border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- LEFT: BRAND -->
        <a href="<?= base_url() ?>" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-brand-primary flex items-center justify-center">
                <ion-icon name="cut-outline" class="text-white text-lg"></ion-icon>
            </div>
            <span class="text-white font-semibold text-lg">
                Clipminer
            </span>
        </a>

        <!-- RIGHT -->
        <div class="flex items-center gap-6 text-sm font-medium">

            <!-- MENU -->
            <a href="<?= base_url('dashboard') ?>"
               class="text-white/70 hover:text-white transition">
                Try Demo
            </a>

            <a href="#"
               class="text-white/70 hover:text-white transition">
                Pricing
            </a>

            <a href="#"
               class="text-white/70 hover:text-white transition">
                Login
            </a>

            <!-- LANGUAGE TOGGLE -->
            <div class="flex items-center gap-1 px-2 py-1 rounded-lg
                        bg-white/5 border border-white/10">

                <a href="?lang=id"
                   class="px-2 py-1 rounded text-xs
                   <?= ($this->session->userdata('site_lang') === 'indonesian')
                        ? 'bg-brand-primary text-white'
                        : 'text-white/60 hover:text-white' ?>">
                    ID
                </a>

                <a href="?lang=en"
                   class="px-2 py-1 rounded text-xs
                   <?= ($this->session->userdata('site_lang') === 'english')
                        ? 'bg-brand-primary text-white'
                        : 'text-white/60 hover:text-white' ?>">
                    EN
                </a>
            </div>

            <!-- CTA -->
            <a href="#"
               class="px-4 py-2 rounded-lg bg-brand-primary
                      hover:opacity-90 transition text-white font-semibold">
                Sign Up
            </a>
        </div>

    </div>
</nav>
