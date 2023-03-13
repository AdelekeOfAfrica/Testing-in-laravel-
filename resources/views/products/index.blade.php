<x-guest-layout>
   @forelse($products as $product )
   {{$product->name}}
   {{$product->type}}
   {{$product->price}}

   @empty
   <h1>No product</h1>
   @endforelse

   <h1>no product</h1>
</x-guest-layout>