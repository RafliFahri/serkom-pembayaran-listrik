@extends('.admin.app')
@section('content')
    <span class="text-2xl mb-4 font-bold">Edit Tarif</span>
    <form method="POST" action="{{route('admin.tarif.update', ['tarif' => $tarif])}}">
        @csrf
        @method('PATCH')
        <div class="mb-5">
            <label for="daya" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Daya</label>
            <input type="number" name="daya" id="daya" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="300" value="{{$tarif->daya}}"/>
        </div>
        <div class="mb-5">
            <label for="tarif" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tarif per Kwh</label>
            <input type="number" name="tarifperkwh" step="0.01" id="tarif" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1000.00" value="{{$tarif->tarifperkwh}}"/>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
@endsection
