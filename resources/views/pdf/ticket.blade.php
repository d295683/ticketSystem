<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (isset($ticket->id))
            Ticket {{ $ticket->id }} |
        @endif {{ config('app.name', 'Laravel') }}
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .mt {
            margin-top: 5rem;
        }
    </style>
</head>

<body>

    <table width="100%">
        <tr>
            <td align="left">
                {{-- <img src="data:image/png;base64,{{ $qrCode }}" alt="Ticket QR Code"> --}}
                <img src="data:image/svg+xml;base64, {!! base64_encode(QrCode::size(150)->generate($ticket->code)) !!} ">
            </td>

            <td align="right">
                <h1>
                    @if (isset($ticket->id))
                        Ticket {{ $ticket->id }} |
                    @endif {{ config('app.name', 'Laravel') }}
                </h1>
                <h2 style="margin: 0px;">
                    {{ $event->title }}
                </h2>
                <pre>
                        Location: {{ $event->location }}
                        Date: {{ Carbon\Carbon::parse($event->datetime)->format('d/m/Y') }}
                        Time: {{ Carbon\Carbon::parse($event->datetime)->format('H:i') }}
                    </pre>
            </td>
        </tr>

    </table>

    <div class="mt">
        <h2>{{ $event->title }}</h2>
        {!! $event->description !!}
    </div>

</body>

</html>
