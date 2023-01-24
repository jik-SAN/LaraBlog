<x-app-layout>
	<div class="w-4/5 m-auto my-16 py-5 text-left">
		<div class="py-15">
			<h1 class="text-6xl">
				Create Post
			</h1>
		</div>
	</div>
	<div class="w-4/5 m-auto pt-20 space-x-10 space-y-6">
		<form
		action="/blog"
		method="POST"
		enctype="multipart/form-data">
		@csrf

		<input
		type="text"
		name="title"
		placeholder="Title..."
		class="bg-transparent block border-b-2 w-full h-20 text-3xl mb-4 outline-none">

		<textarea id="message" rows="4" class="block p-12 w-full bg-transparent block border-b-2 w-full h-60 text-xl outline-none mb-4" placeholder="Description..."></textarea>

		<div class="bg-grey-lighter pt-15 mb-6">
			<label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
				<span class="mt-2 text-xl leading-normal">
					Add Image
				</span>
				<input
				type="file"
				name="image"
				class="hidden">
			</label>
		</div>

		<button
		type="submit"
		class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
		Publish Post
	</button>
</form>
</div>
</x-app-layout>