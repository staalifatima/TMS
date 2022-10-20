<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <x-auth-validation-success/>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    
<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Role</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody>
    @foreach ($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>
        <img src="{{asset('/image/') .$user->avatar}}"  width="70px" height="70px" >
        </td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->mobile}}</td>
        <td>{{$user->type}}</td>
        <td>{{$user->created_at}}</td>
        <td>{{$user->updated_at}}</td>
        <td>
        <form method="POST" action="{{ route('userslist.delete', $user->id )}}">
                        @method('DELETE')
                        @csrf
            
                 <x-primary-button class="btn btn-danger">Delete</x-primary-button>
           
        </form>
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



