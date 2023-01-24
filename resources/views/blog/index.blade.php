<x-app-layout>
	<div class="w-4/5 m-auto my-16 py-5 text-center">
		<div class="border-b border-gray-200">
			<h1 class="text-6xl">
				Blog Posts
			</h1>
		</div>
	</div>
	@auth
    <div class="pt-15 w-4/5 m-auto">
        <a
            href="/blog/create"
            class="bg-blue-500 uppercase text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
            Create post
        </a>
    </div>
@endauth
	@foreach($posts as $post)
	<div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto my-14 pt-15 pb-24 border-b border-gray-200">
		<div>
			<img src="https://cdn.pixabay.com/photo/2015/01/08/18/25/desk-593327_960_720.jpg" alt="">
		</div>
		<div>
			<h2 class="text-gray-700 font-bold text-4xl pb-4">
				{{ $post->title }}
			</h2>
			<span class="text-gray-500">
				By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->created_at)) }}
			</span>
			<p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
				{{ $post->description }}
			</p>
			<a href="/blog/{{ $post->slug }}" class="uppercase text-gray-100 bg-blue-500 text-lg font-extrabold py-4 px-8 rounded-2xl">
				Keep Reading
			</a>
		</div>
	</div>
	@endforeach
</x-app-layout>