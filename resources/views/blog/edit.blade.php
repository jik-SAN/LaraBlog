<x-app-layout>
	<div class="w-4/5 m-auto my-10 text-left">
		<div class="py-15">
			<h1 class="text-4xl">
				Edit Post
			</h1>
		</div>
	</div>
	@if ($errors->any())
	<div class="w-4/5  m-auto">
		<ul>
			@foreach ($errors->all() as $error)
			<li class="w-full mb-1 text-red-700 py-2">
				{{ $error }}
			</li>
			@endforeach
		</ul>
	</div>
	@endif

	<div class="w-4/5 m-auto pt-5 space-x-10">
		<form
		action="/blog/{{ $post->slug }}"
		method="POST"
		enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<input
		type="text"
		name="title"
		placeholder="Title..."
		class="bg-transparent block border-b-2 w-full h-20 text-3xl mb-4 outline-none"
		value="{{ $post->title }}">

		<textarea
		placeholder="Description..."
		name="description"
		rows="12" class="block w-full bg-transparent border-b-2 w-full text-xl outline-none mb-4">{{ $post->description }}</textarea>

		<div class="bg-grey-lighter pt-15 mb-6">
			<label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase hover:border-blue-800 border border-blue cursor-pointer">
				<span class="mt-2 text-xl leading-normal">
					Change Image
				</span>
				<input
				type="file"
				name="image"
				class="hidden">
			</label>
		</div>

		<button
		type="submit"
		class="uppercase mt-15 bg-blue-500 hover:bg-blue-600 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
		Publish Post
	</button>
</form>
</div>
</x-app-layout>