
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    
    <table class="table table-bordered">
  <thead >
    <tr>
      <th>ID</th>
      <th>User_id</th>
      <th>Name</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>Created</th>
      <th>Updated</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($clients as $client)
    <tr>
        <td>{{$client->id}}</td>
        <td>{{$client->user_id}}</td>
        <td>{{$client->client_name}}</td>
        <td>{{$client->client_email}}</td>
        <td>{{$client->client_mobile}}</td>
        <td>{{$client->created_at}}</td>
        <td>{{$client->updated_at}}</td>
        <td>
            <a href="{{ url('/') }}" class="btn btn-danger"> Delete </a>
        </td>
    </tr>
    @endforeach
</table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


