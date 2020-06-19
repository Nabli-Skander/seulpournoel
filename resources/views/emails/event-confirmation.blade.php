@component('mail::message')
# {{ $user->first_name }} Votre événement a été créé !

Votre événement a été créé avec succès. Nous vous remercions pour votre confiance et nous vous souhaitons de
très belles fêtes de fin d’année.

# L'événement
* *Titre :* {{$event->title}}
* *Date :* {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y')}}
* *Heure :* {{ \Carbon\Carbon::parse($event->date)->format('H:i')}}
* *Lieu :* {{ $event->locationShort() }}

@component('mail::button', ['url' =>route('events.show', $event->id), 'color' => 'red'])
Consulter l'événement
@endcomponent
@endcomponent