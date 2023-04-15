<x-mail::message>

    # {{ $data['subject'] }}

    {{ $data['email'] }}

    {{ $data['message'] }}



    Thanks, <br>

    {{ config('app.name') }}

</x-mail::message>
