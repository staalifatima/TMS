<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard for Client') }}
        </h2>
        </x-slot>

        
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  <img src="{{asset(Auth::user()->avatar)}}"  style="height:60px;width:60px; border-radius:50%; margin-right:15px;" > 
                   You're logged in as Client!
                </div>
            </div>
        </div>
    </div>
    </x-app-layout>