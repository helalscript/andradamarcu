<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title> {{ $page->page_title }} || {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/backend/favicon.ico') }}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="dark:bg-neutral-900">
    <!-- ========== HEADER ========== -->
    <header
        class="flex flex-wrap lg:justify-start lg:flex-nowrap z-50 w-full py-4 backdrop-blur-md
    relative bg-white/80 lg:bg-transparent lg:backdrop-blur-none dark:bg-neutral-900 dark:lg:bg-transparent">
        <nav class="max-w-[85rem] flex flex-wrap basis-full items-center w-full mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Logo Wrapper -->
            <div class="flex items-center sm:gap-x-2">
                <!-- Logo -->
                <a class="flex-none rounded-md focus:outline-none focus:opacity-80" href="#">
                    <img class="w-16 h-auto" src="{{ asset('/logo.png') }}" alt="logo">
                </a>
                <!-- End Logo -->


            </div>
            <!-- End Logo Wrapper -->



            <!-- Collapse -->
            <div id="main-navbar"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow ms-auto lg:block lg:w-auto lg:basis-auto lg:order-2 text-center text-4xl"
                aria-labelledby="main-navbar-collapse">

                @php
                    $activePage_slug = $page->page_slug;
                @endphp
                @foreach ($pages as $p)
                    <a class="inline-flex items-center text-gray-800 p-2 text-sm font-medium rounded-lg hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400  @if (request()->routeIs('pages', $p->page_slug) && $activePage_slug === $p->page_slug) text-blue-600 hover:text-blue-500 dark:text-blue-500 dark:hover:text-blue-400 @endif"
                        href="{{ route('pages', $p->page_slug) }}">
                        <svg class="shrink-0 size-4 me-3 block lg:hidden" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                        </svg>
                        {{ $p->page_title }}
                    </a>
                @endforeach

            </div>
            </div>
            <!-- End Collapse -->
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content">
        <!-- Heading -->
        <div class="md:max-w-screen-sm text-center px-4 sm:px-6 lg:px-8 pt-24 pb-6 mx-auto">
            <h1 class="mb-2 text-2xl font-bold md:text-4xl dark:text-white">{{ $page->page_title }}</h1>
            <p class="text-gray-700 dark:text-neutral-400">Last updated: {{ $page->updated_at }}</p>
        </div>
        <!-- End Heading -->

        <!-- Content -->
        <div class="md:max-w-screen-sm lg:max-w-[992px] px-4 sm:px-6 lg:px-8 pb-12 md:pt-6 sm:pb-20 mx-auto">
            {!! $page->page_content !!}
        </div>
        <!-- End Content -->
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- ========== FOOTER ========== -->
    <footer class="dark:bg-gradient-to-t dark:from-blue-900/10 dark:to-transparent">
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="pb-10">
                <!-- Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 mb-10">
                    <div class="col-span-full lg:col-span-1">
                        <a class="flex-none inline-block focus:outline-none focus:opacity-80" href="#">
                            <img class="w-16 h-auto" src="{{ asset('/logo.png') }}" alt="logo">
                        </a>
                    </div>
                    <!-- End Col -->


                    <div>
                        <h4 class="font-semibold text-gray-800 dark:text-neutral-200">pages</h4>

                        <div class="mt-3 grid space-y-3 text-sm">
                            @foreach ($pages as $p)
                                <p>
                                    <a class="text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 text-neutral-500 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                                        href="{{ route('pages', $p->page_slug) }}">{{ $p->page_title }}</a>
                                </p>
                            @endforeach
                        </div>
                    </div>
                    <!-- End Col -->

                </div>
                <!-- End Grid -->

                <p class="text-xs sm:text-sm text-gray-600 dark:text-neutral-500">
                    © 2024 {{ config('app.name') }}.
                </p>
            </div>

            <div
                class="bg-[radial-gradient(closest-side,theme(colors.violet.600),theme(colors.blue.600),transparent)] h-1">
            </div>
        </div>
    </footer>
</body>

</html>
