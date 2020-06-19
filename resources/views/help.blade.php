@extends('layouts.default')

@section('title', __('Aide'))



@section('content')
    <section class="content">


        <div class="container">

            <br> <br>
            <div class="box">

                <h2>J'ai oublié <u>mon mot de passe</u></h2>
                <p>Rendez-vous sur la page <a href="/mot-de-passe-oublie/request">mot de passe oublié</a>
                    pour récupérer votre mot de passe.</p>
            </div>
            <br>

            <div class="box">
                <h2>Quelles sont les règles de prudence ?</h2>
                <ul>
                    <li>Contactez la personne par téléphone avant de la recevoir chez vous ou encore avant
                        de vous rendre chez elle.
                    </li>
                    <li>Assurez -vous de ne pas être la seule ou le seul convive.</li>
                    <li>Communiquez à votre entourage (amis , voisins,...) l'adresse à laquelle vous vous
                        rendez.
                    </li>
                    <li>Renseignez-vous obligatoirement sur la véritable identité de vos hôtes. (Via les
                        réseaux sociaux tels que Facebook ou Linkedin par exemple).
                    </li>
                    <li>Gardez toujours un moyen de communiquer avec vos proches (téléphone portable) et
                        assurez-vous d'être en total autonomie (venez par vos propres moyens : voiture,
                        vélo, pieds)
                    </li>
                </ul>

                <p>&nbsp;</p>

                <p>Le site vous recommande très fortement de rencontrer un première fois vos hôtes dans un
                    lieu public (bar , restaurant, salle des fêtes...). Nous ne contrôlons pas l'identité
                    des utilisateurs du site, vous êtes responsable de votre sécurité.<br>
                    Vous avez une obligation de vous renseigner par tous moyens.</p>
            </div>
            <br>

            <div class="box">
                <h2>Je n'arrive pas à insérer une image sur mon
                    profil</h2>
                <p>Vous devez utiliser un fichier image en .jpg, .png ou .gif.</p>

                <p>Pour votre profil, nous vous recommandons d'utiliser une photo au format carré (ou
                    portrait)&nbsp;de 200px de large par 200px de haut.</p>
            </div>
            <br>

            <div class="box">
                <h2>Je n'arrive pas à insérer une image sur mon
                    événement</h2>
                <p>Vous devez utiliser un fichier image en .jpg, .png ou .gif.</p>

                <p>Pour votre évènement, nous vous recommandons d'utiliser une photo au format paysage de
                    1920px de large par 360px de haut.</p>
            </div>
            <br>

            <div class="box">
                <h2>Je souhaite supprimer mon compte</h2>
                <p>Pour supprimer votre compte, rendez-vous sur <a href="{{ route('profile.edit') }}">votre profil</a>
                    et cliquez sur supprimer mon
                    compte.
                    Celui-ci sera automatiquement supprimé de la base de données</p>
            </div>
            <br>

            <div class="box">
                <h2>Je souhaite partager mon expérience</h2>
                <p>Contactez-nous <a href="mailto:team@seulpournoel.fr">directement par email</a>.</p>
            </div>
            <br>

        </div>
    </section>
@endsection









