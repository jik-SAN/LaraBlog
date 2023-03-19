<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{ $data['name'] }} Profile</title>
</head>
<body>
    <div class="h-full bg-gray-200 p-8">
        <div class="absolute mb-3 mt-2">
         <a class="bg-indigo-500 hover:shadow-xl rounded text-white p-2 mx-4 hover:bg-indigo-700" href="{{ url()->previous() }}">
    <span>Back</span>
        </a>
    </div>
        @if(Auth::id() == $data['id'])
        <div x-data="{ openSettings: false }" class="absolute right-12 mt-4 rounded">
            <button @click="openSettings = !openSettings" class="border border-gray-400 p-2 rounded text-gray-300 hover:text-gray-300 bg-gray-100 bg-opacity-10 hover:bg-opacity-20" title="Settings">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                </svg>
            </button>
            <div x-show="openSettings" @click.away="openSettings = false" class="bg-white absolute right-0 w-40 py-2 mt-1 border border-gray-200 shadow-2xl" style="display: none;">
                <div class="py-2 border-b">
                    <!-- <p class="text-gray-400 text-xs px-6 uppercase mb-1">Settings</p> -->
                    <button class="w-full flex items-center px-6 py-1.5 space-x-2 hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                      </svg>
                      <a href="/">
                          <span class="text-sm text-gray-700">Home</span></a>
                      </button>
                      <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200 hover:text-red-500 text-sm text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                          </svg>
                          <p>Logout</p>
                      </button>
                  </form>
              </div>
          </div>
      </div>
      @endif
      <div class="bg-white rounded-lg shadow-xl pb-8 pt-20">
   <!--  <div class="w-full h-[250px]">
        <img src="#" class="w-full h-full rounded-tl-lg rounded-tr-lg" alt="profile">
    </div> -->

    <div class="flex flex-col items-center -mt-20">
        <button>
           <div class="m-3 flex h-20 w-20 items-center justify-center rounded-full bg-green-200">
            <p class="text-4xl text-white font-light">A</p>
        </div>
    </button>
    <div class="flex items-center space-x-2 mt-2">
        <p class="text-2xl">{{ $data['name'] }}</p>
    </div>
                <!-- <p class="text-gray-700">Senior Software Engineer at Tailwind CSS</p>
                    <p class="text-sm text-gray-500">New York, USA</p> -->
                </div>
            </div>


            <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
                <div class="w-full flex flex-col 2xl:w-1/3">
                    <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                        <h4 class="text-xl text-gray-900 font-bold">Profile Info</h4>
                        <ul class="mt-2 text-gray-700">
                            <li class="flex border-y py-2">
                                <span class="font-bold w-24">Name:</span>
                                <span class="text-gray-700">{{ $data['name'] }}</span>
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Email:</span>
                                <span class="text-gray-700">{{ $data['email'] }}</span>
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">Joined on:</span>
                                <span class="text-gray-700">{{ date('jS M Y', strtotime($data->created_at)) }}</span>
                            </li>
                            <li class="flex border-b py-2">
                                <span class="font-bold w-24">No of posts:</span>
                                <span class="text-gray-700">{{ $data['post_no'] }}</span>
                            </li>
                            <li class="flex items-center border-b py-2 space-x-2">
                                <span class="font-bold w-24">Socials:</span>
                                <a href="#" title="Facebook">
                                    <svg class="w-5 h-5" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 506.86 506.86"><defs><style>.cls-1{fill:#1877f2;}.cls-2{fill:#fff;}</style></defs><path class="cls-1" d="M506.86,253.43C506.86,113.46,393.39,0,253.43,0S0,113.46,0,253.43C0,379.92,92.68,484.77,213.83,503.78V326.69H149.48V253.43h64.35V197.6c0-63.52,37.84-98.6,95.72-98.6,27.73,0,56.73,5,56.73,5v62.36H334.33c-31.49,0-41.3,19.54-41.3,39.58v47.54h70.28l-11.23,73.26H293V503.78C414.18,484.77,506.86,379.92,506.86,253.43Z"></path><path class="cls-2" d="M352.08,326.69l11.23-73.26H293V205.89c0-20,9.81-39.58,41.3-39.58h31.95V104s-29-5-56.73-5c-57.88,0-95.72,35.08-95.72,98.6v55.83H149.48v73.26h64.35V503.78a256.11,256.11,0,0,0,79.2,0V326.69Z"></path></svg>
                                </a>
                                <a href="#" title="Twitter">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 333333 333333" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"><path d="M166667 0c92048 0 166667 74619 166667 166667s-74619 166667-166667 166667S0 258715 0 166667 74619 0 166667 0zm90493 110539c-6654 2976-13822 4953-21307 5835 7669-4593 13533-11870 16333-20535-7168 4239-15133 7348-23574 9011-6787-7211-16426-11694-27105-11694-20504 0-37104 16610-37104 37101 0 2893 320 5722 949 8450-30852-1564-58204-16333-76513-38806-3285 5666-5022 12109-5022 18661v4c0 12866 6532 24246 16500 30882-6083-180-11804-1876-16828-4626v464c0 17993 12789 33007 29783 36400-3113 845-6400 1313-9786 1313-2398 0-4709-247-7007-665 4746 14736 18448 25478 34673 25791-12722 9967-28700 15902-46120 15902-3006 0-5935-184-8860-534 16466 10565 35972 16684 56928 16684 68271 0 105636-56577 105636-105632 0-1630-36-3209-104-4806 7251-5187 13538-11733 18514-19185l17-17-3 2z" fill="#1da1f2"></path></svg>
                                </a>
                                <a href="#" title="LinkedIn">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 333333 333333" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"><path d="M166667 0c92048 0 166667 74619 166667 166667s-74619 166667-166667 166667S0 258715 0 166667 74619 0 166667 0zm-18220 138885h28897v14814l418 1c4024-7220 13865-14814 28538-14814 30514-1 36157 18989 36157 43691v50320l-30136 1v-44607c0-10634-221-24322-15670-24322-15691 0-18096 11575-18096 23548v45382h-30109v-94013zm-20892-26114c0 8650-7020 15670-15670 15670s-15672-7020-15672-15670 7022-15670 15672-15670 15670 7020 15670 15670zm-31342 26114h31342v94013H96213v-94013z" fill="#0077b5"></path></svg>
                                </a>
                                <a href="#" title="Github">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="0" height="0" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 640 640"><path d="M319.988 7.973C143.293 7.973 0 151.242 0 327.96c0 141.392 91.678 261.298 218.826 303.63 16.004 2.964 21.886-6.957 21.886-15.414 0-7.63-.319-32.835-.449-59.552-89.032 19.359-107.8-37.772-107.8-37.772-14.552-36.993-35.529-46.831-35.529-46.831-29.032-19.879 2.209-19.442 2.209-19.442 32.126 2.245 49.04 32.954 49.04 32.954 28.56 48.922 74.883 34.76 93.131 26.598 2.882-20.681 11.15-34.807 20.315-42.803-71.08-8.067-145.797-35.516-145.797-158.14 0-34.926 12.52-63.485 32.965-85.88-3.33-8.078-14.291-40.606 3.083-84.674 0 0 26.87-8.61 88.029 32.8 25.512-7.075 52.878-10.642 80.056-10.76 27.2.118 54.614 3.673 80.162 10.76 61.076-41.386 87.922-32.8 87.922-32.8 17.398 44.08 6.485 76.631 3.154 84.675 20.516 22.394 32.93 50.953 32.93 85.879 0 122.907-74.883 149.93-146.117 157.856 11.481 9.921 21.733 29.398 21.733 59.233 0 42.792-.366 77.28-.366 87.804 0 8.516 5.764 18.473 21.992 15.354 127.076-42.354 218.637-162.274 218.637-303.582 0-176.695-143.269-319.988-320-319.988l-.023.107z"></path></svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="flex flex-col w-full 2xl:w-2/3">
                        <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                            <h4 class="text-xl text-gray-900 font-bold">About</h4>
                            <p class="mt-2 text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt voluptates obcaecati numquam error et ut fugiat asperiores. Sunt nulla ad incidunt laboriosam, laudantium est unde natus cum numquam, neque facere. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, magni odio magnam commodi sunt ipsum eum! Voluptas eveniet aperiam at maxime, iste id dicta autem odio laudantium eligendi commodi distinctio!</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>