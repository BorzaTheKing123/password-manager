<x-layout>
    <x-slot:heading>Generiranje gesel</x-slot:heading>
    <div class="display=block bg-grey">
        <form action="/" method="post">
            @csrf
            <label id="domain">Domena</label>
            <input id="domain" type="text" name="domain">
            <br>
            <label id="num">Število besed</label>
            <input id="num" type="text" name="num">
            <br>
            <label id="salt">Sol</label>
            <input id="salt" type="password" name="salt">

            <button type="submit" id="submit">Generiraj</button>
        </form>
        <br>
        @if($password)
            {{ $password }}
        @endif
    </div>
</x-layout>
