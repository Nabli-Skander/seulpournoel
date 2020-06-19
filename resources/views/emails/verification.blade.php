@component('mail::message')
# Bienvenue {{ $user->first_name }} !

Pour valider votre compte, merci de cliquer sur le lien suivant :

@component('mail::button', ['url' => route('verify', $user->email_token), 'color' => 'red'])
Vérifier mon compte
@endcomponent

@endcomponent