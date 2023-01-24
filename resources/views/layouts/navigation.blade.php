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
      <nav class="hidden lg:flex gap-12">
        <a href="{{ route('index') }}" class="text-gray-200 hover:text-indigo-500 active:text-indigo-700 text-lg font-semibold transition duration-100">Home</a>
        <a href="/blog" class="text-gray-200 hover:text-indigo-500 active:text-indigo-700 text-lg font-semibold transition duration-100">Blog</a>
        <a href="#" class="text-gray-200 hover:text-indigo-500 active:text-indigo-700 text-lg font-semibold transition duration-100">About</a>
      </nav>
      <!-- nav - end -->

      <!-- buttons - start -->
      @guest
      <div class="hidden lg:flex flex-col sm:flex-row sm:justify-center lg:justify-start gap-2.5 -ml-8">
        <a href="{{ route('login') }}" class="inline-block focus-visible:ring ring-indigo-300 text-gray-100 hover:text-indigo-500 active:text-indigo-600 text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-4 py-3">Login</a>

        <a href="{{ route('register') }}" class="inline-block bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3">Register</a>
      </div>
      <!-- buttons - end -->
      @else
      <div class="hidden lg:flex flex-col sm:flex-row sm:justify-center lg:justify-start gap-2.5 -ml-8">
        <a href="#" class="inline-block focus-visible:ring ring-indigo-300 text-gray-100 hover:text-indigo-500 active:text-indigo-600 text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-4 py-3">
          {{ Auth::user()->name }}
        </a>

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
          this.closest('form').submit();"
          class="inline-block focus-visible:ring ring-indigo-300 text-gray-100 hover:text-indigo-500 active:text-indigo-600 text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-4 py-3">
            {{ __('Log Out') }}
          </a>
      </form>
    </div>
    @endguest
  </header>
</div>
</div>
