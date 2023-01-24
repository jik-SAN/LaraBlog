<x-app-layout>
	<div class="w-4/5 m-auto my-12 py-5 text-center">
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
	<div class="pt-15 w-4/5 m-auto mb-12">
		<a
		href="/blog/create"
		class="bg-blue-500 uppercase text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
		Create post
	</a>
</div>
@endauth

@foreach($posts as $post)
<div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto mt-0 pt-15 pb-24 border-b border-gray-200">
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
			type="submit">
			Delete
		</button>

	</form>
</span>
<span class="float-right">
	<a
	href="/blog/{{ $post->slug }}/edit">
	<button
	class="text-gray-700 italic hover:text-gray-900 bg-green-200 hover:bg-green-400 rounded-md px-4 py-2 border-b-2 hover:border-black-300 mx-2">
	Edit
</a>
</button>
</span>
@endif
</div>
</div>
@endforeach
</x-app-layout>