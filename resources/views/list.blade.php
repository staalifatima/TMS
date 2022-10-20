<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Partner list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    
<table class="table table-bordered">
    <thead>
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
    @foreach ($partners as $partner)
    <tr>
        <td>{{$partner->id}}</td>
        <td>{{$partner->user_id}}</td>
        <td>{{$partner->partner_name}}</td>
        <td>{{$partner->partner_email}}</td>
        <td>{{$partner->partner_mobile}}</td>
        <td>{{$partner->created_at}}</td>
        <td>{{$partner->updated_at}}</td>
        <td>
            <a href="{{ url('/') }}" class="btn btn-danger"> Delete </a>
        </td>
    </tr>
    @endforeach
</tbody>
</table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>



