@component('mail::message')
{{ $text }}

# L'événement :
* *Titre :* {{$event->title}}
* *Date :* {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y')}}
* *Heure :* {{ \Carbon\Carbon::parse($event->date)->format('H:i')}}
* *Lieu :* {{ $event->locationShort() }}

@if ($link)
@component('mail::button', ['url' =>route('events.show', $event->id), 'color' => 'red'])
Consulter l'événement
@endcomponent
@endif
@endcomponent