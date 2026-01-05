<main class="min-h-screen flex flex-col justify-center items-center container mx-auto px-6 py-12">
    <div class="w-full max-w-md">
        <div class="bg-brand-surface border border-white/5 rounded-3xl p-8 shadow-2xl">

            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-brand-primary/20 rounded-2xl flex items-center justify-center text-brand-primary text-3xl mb-4 mx-auto">
                    <ion-icon name="person-add"></ion-icon>
                </div>
                <h2 class="text-3xl font-bold text-white">Buat Akun</h2>
                <p class="text-gray-400 text-sm mt-2">Mulai mining klip YouTube Anda sekarang</p>
            </div>

            <a href="<?= $google_login_url ?>" class="w-full bg-white/5 border border-white/10 text-white font-semibold py-4 rounded-2xl hover:bg-white/10 transition-all duration-300 flex items-center justify-center gap-3 group mb-6">
                <ion-icon name="logo-google" class="text-xl"></ion-icon>
                <span>Daftar dengan Google</span>
            </a>

            <div class="relative mb-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-white/5"></div>
                </div>
                <div class="relative flex justify-center text-xs uppercase"><span class="bg-brand-surface px-2 text-gray-500">Atau gunakan email</span></div>
            </div>

            <form action="<?= base_url('auth/register_process') ?>" method="POST" class="space-y-4">
                <div class="space-y-2">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider ml-1">Nama Lengkap</label>
                    <input name="name" type="text" placeholder="Masukkan nama" required
                        class="w-full bg-brand-bg border border-white/10 rounded-2xl px-4 py-4 text-sm focus:ring-2 focus:ring-brand-primary outline-none transition-all text-gray-200">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider ml-1">Email</label>
                    <input name="email" type="email" placeholder="nama@email.com" required
                        class="w-full bg-brand-bg border border-white/10 rounded-2xl px-4 py-4 text-sm focus:ring-2 focus:ring-brand-primary outline-none transition-all text-gray-200">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider ml-1">Password</label>
                    <input name="password" type="password" placeholder="••••••••" required
                        class="w-full bg-brand-bg border border-white/10 rounded-2xl px-4 py-4 text-sm focus:ring-2 focus:ring-brand-primary outline-none transition-all text-gray-200">
                </div>

                <button type="submit" class="w-full bg-brand-primary text-white font-bold py-4 rounded-2xl hover:brightness-110 transition-all duration-300 flex items-center justify-center gap-2 group mt-4">
                    <span>Daftar Sekarang</span>
                    <ion-icon name="arrow-forward" class="group-hover:translate-x-1 transition-transform"></ion-icon>
                </button>
            </form>

            <p class="text-center text-gray-500 text-sm mt-8">
                Sudah punya akun? <a href="<?= base_url('auth/login') ?>" class="text-brand-primary font-bold hover:underline">Masuk</a>
            </p>
        </div>
    </div>
</main>