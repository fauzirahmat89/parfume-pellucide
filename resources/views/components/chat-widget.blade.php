<div x-data="chatWidget()" class="chat-widget fixed bottom-6 right-6 z-50">
    <button
        type="button"
        class="chat-toggle flex items-center gap-2 px-4 py-3 rounded-full shadow-lg"
        @click="toggle()"
        :aria-expanded="open"
    >
        <span class="text-sm font-semibold">Chat Pellucide</span>
        <span class="relative flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
        </span>
    </button>

    <div
        x-show="open"
        x-transition
        @click.away="close($event)"
        class="chat-panel glass-panel border border-white/10 backdrop-blur-xl rounded-2xl shadow-2xl"
    >
        <div class="flex items-center justify-between px-4 py-3 border-b border-white/10">
            <div>
                <p class="font-semibold text-sm">Pellucide Assistant</p>
                <p class="text-xs text-gray-300">Tanya seputar produk & penggunaan</p>
            </div>
            <button type="button" class="text-gray-300 hover:text-white" @click="open=false">
                x
            </button>
        </div>
        <div class="chat-messages" x-ref="scroll">
            <template x-for="(item, idx) in thread" :key="idx">
                <div class="mb-3" :class="item.role === 'user' ? 'text-right' : 'text-left'">
                    <div
                        class="inline-block px-3 py-2 rounded-2xl text-sm leading-relaxed"
                        :class="item.role === 'user' ? 'bg-red-500 text-white' : 'bg-white/10 text-gray-100'"
                        x-text="item.content"
                    ></div>
                </div>
            </template>
            <div class="flex items-center gap-2 text-gray-300 text-xs" x-show="loading">
                <span class="loading-dot"></span>
                <span class="loading-dot"></span>
                <span class="loading-dot"></span>
                <span>Mengetik...</span>
            </div>
        </div>
        <form class="chat-input border-t border-white/10" @submit.prevent="send">
            <textarea
                x-model="message"
                placeholder="Tulis pertanyaanmu..."
                class="w-full bg-transparent text-sm text-white placeholder-gray-400 outline-none resize-none"
                rows="2"
                maxlength="500"
                @keydown.enter.prevent="send"
            ></textarea>
            <div class="flex items-center justify-between mt-2">
                <p class="text-[11px] text-gray-400">Jaga privasi, jangan kirim data sensitif.</p>
                <button type="submit" class="btn-send" :disabled="loading || !message.trim()">
                    Kirim
                </button>
            </div>
        </form>
    </div>
</div>

@pushOnce('scripts')
<script>
    function chatWidget() {
        return {
            open: false,
            loading: false,
            message: '',
            thread: [
                { role: 'assistant', content: 'Halo! Ada yang bisa saya bantu tentang produk Pellucide?' }
            ],
            toggle() {
                this.open = !this.open;
                this.$nextTick(() => this.scrollToBottom());
            },
            close(event) {
                if (event.target.closest('.chat-panel')) return;
                this.open = false;
            },
            scrollToBottom() {
                if (this.$refs.scroll) {
                    this.$refs.scroll.scrollTop = this.$refs.scroll.scrollHeight;
                }
            },
            async send() {
                if (this.loading) return;
                const content = this.message.trim();
                if (!content) return;

                this.thread.push({ role: 'user', content });
                this.message = '';
                this.loading = true;
                this.$nextTick(() => this.scrollToBottom());

                let errorMsg = 'Maaf, saya tidak bisa menjawab saat ini. Coba lagi beberapa saat.';
                try {
                    const res = await fetch('{{ route('chat.send') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            message: content,
                        }),
                    });

                    const data = await res.json();

                    if (!res.ok || !data.reply) {
                        errorMsg = data.message || errorMsg;
                        throw new Error(errorMsg);
                    }

                    if (data.usage) {
                        console.log('GLM usage:', data.usage);
                    }

                    this.thread.push({ role: 'assistant', content: data.reply });
                } catch (error) {
                    this.thread.push({
                        role: 'assistant',
                        content: errorMsg,
                    });
                    console.error(error);
                } finally {
                    this.loading = false;
                    this.$nextTick(() => this.scrollToBottom());
                }
            },
        };
    }
</script>
@endPushOnce
