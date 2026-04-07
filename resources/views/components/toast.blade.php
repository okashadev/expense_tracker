@if(session('message'))
    @php
        $type = session('type') ?? 'info';
        $colors = [
            'success' => ['bg' => 'bg-green-600/80', 'progress' => 'bg-white'],
            'error' => ['bg' => 'bg-red-600/80', 'progress' => 'bg-white'],
            'warning' => ['bg' => 'bg-yellow-500/80', 'progress' => 'bg-white'],
            'info' => ['bg' => 'bg-blue-600/80', 'progress' => 'bg-white'],
        ];
        $bgColor = $colors[$type]['bg'];
        $progressColor = $colors[$type]['progress'];
    @endphp

    <div id="toast" class="fixed top-5 right-5 w-full z-50 max-w-xs p-4 text-sm rounded-xl shadow {{ $bgColor }} border border-current text-white">
        <div class="flex justify-between items-start w-full">
            <span>{{ session('message') }}</span>
            <button type="button" class="ml-4 text-white focus:outline-none"
                aria-label="Close"
                onclick="document.getElementById('toast').remove()">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <div class="mt-2 h-1 w-full {{ $progressColor }}/30 rounded-full overflow-hidden">
            <div id="toast-progress" class="h-1 {{ $progressColor }} rounded-full" style="width: 100%;"></div>
        </div>
    </div>

    <script>
        const toast = document.getElementById('toast');
        const progress = document.getElementById('toast-progress');
        let duration = 5000;
        let start = null;

        function animateProgress(timestamp) {
            if (!start) start = timestamp;
            const elapsed = timestamp - start;
            const width = Math.max(0, 100 - (elapsed / duration) * 100);
            progress.style.width = width + '%';
            if (elapsed < duration) {
                requestAnimationFrame(animateProgress);
            } else {
                if (toast) toast.remove();
            }
        }

        requestAnimationFrame(animateProgress);
    </script>
@endif
