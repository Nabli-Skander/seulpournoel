@extends('layouts.default')

@section('title', __('Conditions Générales d\'Utilisation'))

@section('content')

    <section class="content">


        <div class="container">

            <br> <br>

            <div class="box">
                <h2>1. Définition</h2>
                <p>
                <ul>
                    <li><strong>Site :
                        </strong>
                        Le Site désigne le site Internet www.seulpournoel.fr
                    </li>
                    <li><strong>Utilisateur
                            :</strong>
                        L'Utilisateur est toute personne qui utilise le Site ou l'un des services proposés sur
                        le Site.
                    </li>
                    <li><strong>Membre :</strong>
                        Le terme « Membre » désigne un utilisateur identifié sur le
                        site
                    </li>
                    <li><strong>Événement :</strong>
                        Le terme « Événement » désigne les festivités organisées par
                        les membres du site.
                    </li>
                </ul>
                <br>
                </p>
            </div>
            <br>
            <div class="box">
                <h2>2. Accès au site et aux services fournis</h2>

                <p> Le site est une plateforme dont l’objectif est de faciliter l’échange et l’organisation de
                    festivités
                    entre personnes seules pour les fêtes de fin d’année.
                    <br>La création d’événements nécessite de s’acquitter d’un montant forfaitaire de 2 euros.
                    Cette transaction réalisée grâce à l’outil STRIPE est totalement sécurisée et indépendante du site.
                    Le site n’a pas accès à vos données bancaires.
                    <br>Ce <strong>paiement symbolique</strong> nous permet d’assurer le sérieux de vos hôtes. Le
                    bénéfice éventuel réalisé sera attribué aux frais de fonctionnement du site et à son amélioration,
                    mais ne constitue pas une contrepartie financière au service rendu par le site.
                </p>
            </div>
            <br>
            <div class="box">
                <h2>3. Propriété intellectuelle</h2>

                <p>Les logos, les images et autres signes distinctifs sont la propriété du site. Le recopiage ou encore
                    l’utilisation du contenu est soumis à autorisation par l’éditeur du site et<strong>tout contenu
                        copié peut entraîner de lourdes sanctions</strong>.</p>
            </div>
            <br>
            <div class="box">
                <h2>4. Responsabilité et sécurité</h2>

                Le site est une interface permettant aux personnes qui sont seules pour Noël de se rencontrer.
                L'inscription
                est gratuite et sans engagement. Attention toutefois à rester prudent !
                Les utilisateurs et les membres s'engagent à respecter les obligations suivantes :
                <ul>
                    <li>Gardez toujours un moyen de communiquer avec vos proches (téléphone portable) et assurez-vous
                        d'être en totale autonomie (venez par vos propres moyens : voiture, vélo, pieds)
                    </li>
                    <li>Tout utilisateur doit communiquer en respectant les valeurs du respect, du partage, de la
                        solidarité, de l'entraide et de l'écoute mutuelle.
                    </li>
                    <li>Tout utilisateur devra prendre garde à surveiller son langage et à ne pas manquer de respect à
                        un autre utilisateur, ou encore à ne pas être agressif ou malveillant.
                    </li>
                    <li>Les propos racistes, xénophobes ou encore détériorant l'image de la femme son interdit.</li>
                    <li><strong>Soyez vigilant</strong>, contactez la personne par téléphone avant de la recevoir chez
                        vous ou encore avant de vous rendre chez elle. Assurez-vous de ne pas être la seule ou le seul
                        convive . Communiquer à votre entourage (amis , voisins...) l'adresse à laquelle vous vous
                        rendez.
                    </li>
                    <li><strong>Renseignez-vous obligatoirement</strong>, sur la véritable identité de vos hôtes. (Via
                        les réseaux sociaux tels que Facebook ou Linkedin par exemple).
                    </li>
                    <li><strong>Le site vous recommande très fortement de rencontrer une première fois vos hôtes, pour
                            une première prise de contact dans un lieu public (bar , restaurant, salle des fêtes…). Nous
                            ne contrôlons pas l'identité des utilisateurs du site, vous êtes responsable de votre
                            sécurité. Vous avez une obligation de vous renseigner par tous moyens.</strong></li>
                    <li><strong>En cas d’annulation</strong>, d’un événement ou de tout autres désagréments constatés
                        par les utilisateurs et membres au sujet d’un ou plusieurs événements, le site ne pourra être
                        tenu pour responsable.
                    </li>
                    <li><strong>Les organisateurs de soirée sont responsables</strong>, de la tenue et du bon
                        déroulement des festivités qu’ils se sont proposé d’organiser.
                    </li>
                    <li><strong>Les participants sont tenus de participer au partage des frais</strong>, liés au coût de
                        l’organisation de la soirée quand cela était précisé sur l’annonce de l’événement. Le site ne
                        peut en aucun cas être tenu pour responsable d’une défaillance d’un participant quant à sa
                        participation financière ou quant à son comportement lors des festivités.
                    </li>
                </ul>
            </div>
            <br>
            <div class="box">

                <h2>5. Protection des données à caractère personnel</h2>

                <p>Les données collectées pour les besoins du site (création profil et d’événements) sont à
                    usage exclusif du site et n’ont aucunement vocation à être transmises à des tiers.<br> Vous restez
                    maître de vos données : Le bouton <strong>Supprimer mon profil</strong> vous permet de supprimer la
                    totalité de vos
                    informations de notre base de données.</p>
            </div>
            <br>
            <div class="box">
                <h2>6. Liens hypertextes</h2>

                <p>www.seulpournoel.fr propose des e-mails et liens hypertextes, vers des sites web édités et/ou
                    gérés par destiers. Dans la mesure où aucun contrôle n'est exercé sur ces ressources externes,
                    l'Utilisateur reconnaîtque www.seulpournoel.fr n'assume aucune responsabilité relative à la mise à
                    disposition de ces ressources, et ne peut être tenue responsable quant à leur contenu.</p>
            </div>
            <br>
        </div>
    </section>
@endsection

@section('head')
    <style lang="text/css">
        .content {
            color: #000;
        }
    </style>
@endsection






