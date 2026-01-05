        <footer class="mt-2 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-6 py-10
                        flex flex-col md:flex-row items-center justify-between
                        text-sm text-white/50 gap-4">

                <!-- LEFT -->
                <div class="flex items-center gap-2">
                    <ion-icon name="cut-outline" class="text-brand-primary"></ion-icon>
                    <span>© <?= date('Y') ?> Clipminer</span>
                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-6">
                    <a href="#" class="hover:text-white transition">Privacy</a>
                    <a href="#" class="hover:text-white transition">Terms</a>
                    <a href="#" class="hover:text-white transition">Contact</a>
                </div>

            </div>
        </footer>

        <div x-cloak>
            <div x-show="openSignUp"
                class="fixed inset-0 z-[99] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
                x-transition.opacity>

                <div @click.away="openSignUp = false"
                    class="bg-brand-surface border border-white/10 w-full max-w-md rounded-3xl p-8 shadow-2xl relative">

                    <button @click="openSignUp = false" class="absolute top-6 right-6 text-gray-500 hover:text-white text-2xl">
                        <ion-icon name="close"></ion-icon>
                    </button>
                </div>
            </div>
        </div>
        </body>

        </html>