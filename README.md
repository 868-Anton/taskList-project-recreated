# Styling Flash Messages with Tailwind CSS and Adding Interactivity with Alpine.js

## Steps and Code Explanation:

### **Add Tailwind and Alpine.js to the Project:**

- Use a CDN to include Tailwind CSS and **Alpine.js** in the project.
    
    ```html
    {{-- resources/views/layouts/app.blade.php --}}
    <head>
      <title>Laravel 10 Task List App</title>
      <script src="<https://cdn.tailwindcss.com>"></script>
      <script src="//unpkg.com/alpinejs" defer></script>
      @yield('styles')
    </head>
    
    ```
    

### **Define the Flash Message Styles:**

- Use Tailwind CSS classes to style the flash message box.
- Ensure the message is clearly visible with appropriate padding, margin, border, and background color.
    
    ```html
    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
      .btn {
        @apply rounded-md px-2 py-1 text-center font-medium text-slate-700 shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50;
      }
      .link {
        @apply font-medium text-gray-700 underline decoration-pink-500;
      }
      label {
        @apply block uppercase text-slate-700 mb-2;
      }
      input,
      textarea {
        @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none;
      }
      .error {
        @apply text-red-500 text-sm;
      }
      .flash-message {
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
    
    ```
    

### **Add Interactivity with Alpine.js:**

- Use Alpine.js to control the visibility of the flash message.
- Implement a close button to allow users to dismiss the flash message.
    
    ```php
    {{-- resources/views/layouts/app.blade.php --}}
    <body class="container mx-auto mt-10 mb-10 max-w-lg">
      <h1 class="mb-4 text-2xl">@yield('title')</h1>
      
      <div x-data="{ flash: true }">
        @if (session()->has('success'))
          
          <div x-show="flash"
            class="flash-message"
            role="alert">
            
            <strong class="font-bold">Success!</strong>
            
            <div>{{ session('success') }}</div>
            
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
    
    ```
    

## More on Adding Interactivity with Alpine.js

## **Add Close Button**

- Add a close button using an SVG element.

```php
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
stroke-width="1.5" @click="flash = false"
stroke="currentColor" class="h-6 w-6 cursor-pointer">
<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
</svg>
```

## **Include Alpine.js**

- Add the Alpine.js library to the project.

```php
<script src="//unpkg.com/alpinejs" defer></script>
```

## **Add Accessibility Attribute**

- Add a role attribute with the value "alert" to the flash message for screen readers.

```php
role = "alert" (container) class = "relative mb-10..."
```

## **Positioning Elements**

- Make the container div relative and the close button absolute.

```php
<span class="**absolute** **top-0 bottom-0 right-0 px-4 py-3**">

	<svg xmlns="http://www.w3.org/2000/svg" 
	fill="none" 
	viewBox="0 0 24 24"
	stroke-width="1.5" 
	@click="flash = false"
	stroke="currentColor" 
	class="h-6 w-6 cursor-pointer">
	<path stroke-linecap="round" 
	stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
	</svg>
	
</span>
```

## **Add Alpine.js Directives**

- Use the `x-data` directive to define a new Alpine component and initialize the flash variable.

```php
<div x-data="{flash:true}">
```

- Use the `x-show` directive to conditionally display the flash message based on the flash variable.
- 

```php
<div x-data="{flash:true}">
	**<div x-show="flash">**
	strong
	div
	span
	svg
	</div>
</div>
```

- Add an `@click` event handler to the close button to set the flash variable to false and hide the message.

```php
@click="flash = false"
```