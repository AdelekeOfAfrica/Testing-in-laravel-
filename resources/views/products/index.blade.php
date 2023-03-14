<x-guest-layout>
   @auth()
      @if(auth()->user()->is_admin)
         <a href="/product/create">create</a>
      @endif
   @endauth
   @forelse($products as $product )
   {{$product->name}}
   {{$product->type}}
   {{$product->price}}

   @auth
   <button> buy product </button>
   @endauth

   @empty
   <h1>No product</h1>
   @endforelse

   <h1>no product</h1>
</x-guest-layout>