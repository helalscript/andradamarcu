<div id="openModal" modal-center
        class="fixed flex flex-col transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show hidden">
        <div class=" md:w-[50rem] bg-white shadow rounded-md dark:bg-zink-600">
            <div class="flex items-center justify-between p-4 border-b dark:border-zink-500">
                <h5 class="text-16" id="openLabel">{{ $title }}</h5>
                <button data-modal-close="openModal" id="closeButton"
                    class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500"><i data-lucide="x"
                        class="size-5"></i></button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto" id="modalBody">
                {{ $slot }} {{-- Slot for dynamic modal content --}}
            </div>
        </div>
    </div><!--end add Attribute-->