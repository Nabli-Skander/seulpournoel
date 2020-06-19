@component('mail::message')
# {{ $user->first_name }} ne participe plus à votre événement.

# L'événement
* *Titre :* {{$event->title}}
* *Date :* {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y')}}
* *Heure :* {{ \Carbon\Carbon::parse($event->date)->format('H:i')}}
* *Lieu :* {{ $event->locationShort() }}

@component('mail::button', ['url' =>route('events.show', $event->id), 'color' => 'red'])
Consulter l'événement
@endcomponent

@endcomponent