<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laravel Task List App</title>
  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>


{{-- blade-formatter-disable --}}
<style type="text/tailwindcss">
.btn{
  @apply rounded-md px-2 py-1 text-center font-medium text-slate-700 shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50;
}

.link{
  @apply font-medium text-gray-700 underline decoration-pink-500;
}

 input, textarea{
 @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none;
}
.error{
  @apply  text-red-700 text-sm;
}

.flash-message{
  @apply relative mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700;  
}
.close-btn {
    @apply absolute top-0 bottom-0 right-0 px-4 py-3;
  }
  .close-icon {
    @apply h-6 w-6 cursor-pointer;
  }
</style>
{{-- blade-formatter-enable --}}

@yield('styles')
</head>

<body class="container mx-auto mt-10 mb-10 max-w-lg">
  <h1 class="mb-4 text-2xl">@yield('title')</h1>
  
  <div x-data="{ flash: true }">
    @if (session()->has('Success'))
      
      <div x-show="flash"
        class="flash-message"
        role="alert">
        
        <strong class="font-bold">Success!</strong>
        
        <div>{{ session('Success') }}</div>
        
        <span class="close-btn">

          <svg xmlns="<http://www.w3.org/2000/svg>" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" @click="flash = false"
            stroke="currentColor" class="close-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
          
        </span>
        
      </div>
    @endif

    @yield('content')
  </div>
</body>
</html>