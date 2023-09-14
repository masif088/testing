<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('document-create') }}" class="rounded-full bg-blue-200 py-2 p-3 mb-4" >Create New</a>
                <table class="table-auto border-collapse border border-slate-400 mt-4" style="width: 100%">
                    <thead>
                    <tr class="border-collapse border border-slate-400">
                        <th>title</th>
                        <th>content</th>
                        <th>signing</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                    <tr class="border-collapse border border-slate-400">
                        <td style="text-align: center">{{ $data->title }}</td>
                        <td style="text-align: center">{{ $data->content }}</td>
                        <td style="text-align: center">
                            <img src="{{ asset('storage/'.$data->signing) }}" alt="" style="width: 100px">
                        </td>
                        <td style="text-align: center">
                            <a href="{{ route('document-edit',$data->id) }}" class="rounded-full bg-blue-200 py-2 p-3" >Edit</a>

                            <a href="{{ route('document-edit',$data->id) }}" class="rounded-full bg-red-200 py-2 p-3" >Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
