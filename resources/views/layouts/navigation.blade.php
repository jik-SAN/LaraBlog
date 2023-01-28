<div class="bg-gray-700">
  <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
    <header class="flex justify-between items-center py-3 md:py-3">
      <!-- logo - start -->
      <a href="/" class="inline-flex items-center text-white text-2xl md:text-3xl font-bold gap-2.5" aria-label="logo">
        <svg width="95" height="94" viewBox="0 0 95 94" class="w-6 h-auto text-indigo-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path d="M96 0V47L48 94H0V47L48 0H96Z" />
        </svg>

        LaraBlog
      </a>
      <!-- logo - end -->

      <!-- nav - start -->
      <nav class="hidden lg:flex gap-8 flex absolute left-2/4">
        <a href="{{ route('index') }}" class="text-gray-200 hover:text-indigo-500 active:text-indigo-700 text-lg font-semibold">Home</a>
        <a href="/blog" class="text-gray-200 hover:text-indigo-500 active:text-indigo-700 text-lg font-semibold">Blog</a>
        <a href="/about" class="text-gray-200 hover:text-indigo-500 active:text-indigo-700 text-lg font-semibold">About</a>
        <div x-data="{ open: false }" x-on:click.outside="open = false">
          <button x-on:click="open = !open" class="text-gray-200 hover:text-indigo-500 active:text-indigo-700 text-lg font-semibold">
            Search
          </button>
          <div class="flex" x-show="open">
    <form method="GET" action="{{ route('search') }}" class="flex absolute right-0">
      @csrf
    <label for="simple-search" class="sr-only">Search</label>
    <div class="relative w-full mt-6">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
        </div>
        <input type="text" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>

    </div>
    <button type="submit" class="mt-6 p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        <span class="sr-only">Search</span>
    </button>
</form>
  </div>
        </div>
      </nav>
      <!-- nav - end -->

      <!-- buttons - start -->
      @guest
      <div class="hidden lg:flex flex-col sm:flex-row sm:justify-center lg:justify-start gap-2.5 -ml-8">
        <a href="{{ route('login') }}" class="inline-block focus-visible:ring ring-indigo-300 text-gray-100 hover:text-indigo-500 active:text-indigo-600 text-lg md:text-base font-semibold text-center rounded-lg outline-none px-4 py-3">Login</a>

        <a href="{{ route('register') }}" class="inline-block bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none px-8 py-3">Register</a>
      </div>
      <!-- buttons - end -->
      @else
      <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
      <div x-data="{ open: false }" x-on:click.outside="open = false" class="mr-9">
        <button x-on:click="open = !open" type="submit" class="flex items-center bg-gray-500 text-white hover:bg-purple-500 p-2 rounded-full text-sm w-auto">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
          </svg>
        </button>
        <div x-show="open" class="mr-2 opacity-100 absolute right-0 w-40 mt-4 py-0 bg-gray-700 rounded shadow-xl">
          <p class="h-6 font-bold bg-transparent rounded text-white text-center">{{ Auth::user()->name }}</p>
          <a href="{{ route('profile.index', ['name' => Auth::user()->name, 'id' => Auth::id() ]) }}" class="transition-colors duration-200 block px-4 py-2 text-normal text-gray-200 bg-gray-700 rounded hover:font-bold hover:bg-black hover:text-white">Profile</a>
          <form action="{{ route('logout') }}" method="post">
            @csrf
          <button class="transition-colors duration-200 block px-4 py-2 text-normal text-gray-200 w-full text-left bg-gray-700 rounded hover:font-bold hover:bg-black hover:text-red-500">
            {{ __('Logout') }}
          </button>
        </form>
        </div>
        <!-- // Dropdown Body -->
        @endguest
      </header>
    </div>
  </div>
