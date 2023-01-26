<x-app-layout>
	<div class="w-4/5 mx-auto mb-4 mt-6 py-5 text-center">
		<div class="border-b border-gray-200">
			<h1 class="text-5xl">
				Blog Posts
			</h1>
		</div>
	</div>
	@if (session()->has('message'))
	<div class="w-4/5 mx-auto mt-10 pl-2">
		<p class="w-full mb-4 text-gray-50 text-center bg-green-300 rounded-3xl py-4">
			{{ session('message') }}
		</p>
	</div>
	@endif

	@auth
	<div class="pt-15 w-2/3 m-auto mb-12">
		<a
		href="/blog/create"
		class="bg-blue-500 uppercase text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
		Create post
	</a>
</div>
@endauth
@foreach($posts as $post)
<div class="sm:grid grid-cols-2 gap-20 w-2/3 mx-auto mt-0 pt-15 pb-24 border-b border-gray-200">
	<div>
		<img src="{{ asset('/storage/' .$post->image_path) }}" alt="image">
	</div>
	<div>
		<h2 class="text-gray-700 font-bold text-4xl pb-4 pt-2">
			{{ $post->title }}
		</h2>
		<span class="text-gray-500">
			By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->created_at)) }}
		</span>
		<p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
			{{ Str::limit($post->description, 60) }}
		</p>
		<a href="/blog/{{ $post->slug }}" class="uppercase text-gray-100 bg-blue-500 hover:bg-blue-600 text-lg font-extrabold py-4 px-8 rounded-2xl">
			Keep Reading
		</a>
		@if (Auth::check() && Auth::id() == $post->user_id)
		<span class="float-right">
			<form
			action="/blog/{{ $post->slug }}"
			method="POST">
			@csrf
			@method('delete')

			<button
			class="text-gray-700 italic hover:text-black bg-red-200 hover:bg-red-500 rounded-md px-4 py-2 border-b-2 hover:border-black-300 text-center"
			type="submit"><svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="h-4 w-4"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
      />
    </svg>
		</button>

	</form>
</span>
<span class="float-right">
	<a
	href="/blog/{{ $post->slug }}/edit">
	<button
	class="text-gray-700 italic hover:text-gray-900 bg-green-200 hover:bg-green-400 rounded-md px-4 py-2 border-b-2 hover:border-black-300 mx-2">
	<svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="h-4 w-4"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
      />
    </svg>
</a>
</button>
</span>
@endif
</div>
</div>
@endforeach
<div class="absolute flex right-0">
{{ $posts->links() }}
</div>
</x-app-layout>