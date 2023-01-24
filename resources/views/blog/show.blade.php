<x-app-layout>
	<div class="w-4/5 m-auto text-left">
		<div class="py-15">
			<h1 class="text-4xl pt-10">
				{{ $post->title }}
			</h1>
		</div>
	</div>

	<div class="w-4/5 m-auto pt-4">
		<span class="text-gray-500">
			By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
		</span>

		<div class="w-1/3 pt-4">
		<img src="{{ asset('/storage/' .$post->image_path) }}" alt="image">
	</div>

		<p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
			{{ $post->description }}
		</p>
	</div>

</x-app-layout>