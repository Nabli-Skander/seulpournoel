@component('mail::message')
# {{ $user->first_name }} souhaite participer à votre événement.

Voici son message :
@component('mail::panel')
{{ $mess }}
@endcomponent

@component('mail::button', ['url' => route('events.show', $event->id), 'color' => 'red'])
Consulter la demande
@endcomponent

# L'événement
* *Titre :* {{$event->title}}
* *Date :* {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y')}}
* *Heure :* {{ \Carbon\Carbon::parse($event->date)->format('H:i')}}
* *Lieu :* {{ $event->locationShort() }}
@endcomponent