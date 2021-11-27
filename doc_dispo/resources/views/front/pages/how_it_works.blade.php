@extends('front.layouts.app')


@section('content')
<div id="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="#">Accueil</a></li>
            <li>Comment ça marche ?</li>
        </ul>
    </div>
</div>
<div class="container margin_60">
    <div class="row">
        
        <!--/aside -->
        
        <div class="col-lg-12" id="faq">
            <div role="tablist" class="add_bottom_45 accordion" id="payment">
                <div class="card">
                    <div class="card-header" role="tab">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapseOne_payment" aria-expanded="true"><i class="indicator icon_plus_alt2"></i>Dois-je payer pour prendre RDV ?                            </a>
                        </h5>
                    </div>

                    <div id="collapseOne_payment" class="collapse" role="tabpanel" data-parent="#payment">
                        <div class="card-body">
                            <p>Non, la prise de RDV sur le site est totalement gratuite pour le patient.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /card -->
                <div class="card">
                    <div class="card-header" role="tab">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo_payment" aria-expanded="false">
                                <i class="indicator icon_plus_alt2"></i>Comment faire pour prendre RDV avec un médecin ou un praticien ?
                            </a>
                        </h5>
                    </div>
                    <div id="collapseTwo_payment" class="collapse" role="tabpanel" data-parent="#payment">
                        <div class="card-body">
                            <p>- Si vous êtes déjà patient d’un médecin inscrit sur le site il vous suffit de renseigner le nom de votre médecin en cliquant sur le bouton « Trouver un médecin » dans le 
                                bandeau supérieur de la page d’accueil. Vous accèderez ainsi au calendrier de ses prochaines disponibilités et 
                                pourrez sélectionner un RDV qui vous convient.
                            </p>
                            <p>
                                - Vous cherchez un nouveau médecin : il vous suffit de renseigner le nom du médecin ou la spécialité recherchée, votre ville/quartier souhaité dans 
                                la zone de recherche de la page d’accueil. Vous n’aurez plus qu’à faire votre choix parmi les médecins et les RDV 
                                disponibles qui vous seront proposés. Un mail et un SMS de confirmation vous sera envoyé à la suite de votre 
                                validation avec toutes les informations pratiques vous permettant de vous rendre à votre RDV. Vous recevrez 
                                également des SMS de rappel à J-1 avant votre RDV.
                            </p>

                        </div>
                    </div>
                </div>
                <!-- /card -->
                <div class="card">
                    <div class="card-header" role="tab">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseThree_payment" aria-expanded="false">
                                <i class="indicator icon_plus_alt2"></i>Comment joindre mon médecin en cas d'urgence ?
                            </a>
                        </h5>
                    </div>
                    <div id="collapseThree_payment" class="collapse" role="tabpanel" data-parent="#payment">
                        <div class="card-body">
                            <p>En cas urgence vous avez toujours la possibilité de joindre son cabinet par téléphone ou d'appeler le 118.</p>
                        </div>
                    </div>
                </div>
                <!-- /card -->
            </div>
            <!-- /accordion payment -->
            
            <div role="tablist" class="add_bottom_45 accordion" id="tips">
                <div class="card">
                    <div class="card-header" role="tab">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapseOne_tips" aria-expanded="true"><i class="indicator icon_plus_alt2"></i>Puis-je prendre RDV avec mon compte pour des 
                                membres de ma famille, un enfant ou pour une tierce personne ?</a>
                        </h5>
                    </div>

                    <div id="collapseOne_tips" class="collapse" role="tabpanel" data-parent="#tips">
                        <div class="card-body">
                            <p>
                                Si vous prenez RDV avec un praticien (en renseignant son nom ou son lieu d’exercice ou sa spécialité) nous vous invitons à ne prendre RDV que pour vous ou une personne dont vous avez la charge et qui est déjà suivie par ce praticien. Attention, si vous prenez RDV pour votre enfant, la durée de consultation peut nécessiter plus de temps qu'une consultation normale. Nous vous invitons à lire les informations pratiques du médecin avant de valider votre RDV.
                                Pour toute autre personne, nous vous invitons à contacter le secrétariat du praticien par téléphone.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /card -->
                <div class="card">
                    <div class="card-header" role="tab">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo_tips" aria-expanded="false">
                                <i class="indicator icon_plus_alt2"></i>Puis-je modifier ou annuler un RDV pris sur le site ou l’application mobile ?
                            </a>
                        </h5>
                    </div>
                    <div id="collapseTwo_tips" class="collapse" role="tabpanel" data-parent="#tips">
                        <div class="card-body">
                            <p>
                                Oui. Vous pouvez modifier ou annuler un RDV 1H avant via le site ou l’application 
                                mobile.Attention, en cas d'annulations répétées, le praticien a la possibilité de 
                                vous interdire l'accès à ce service.

                            </p>
                        </div>
                    </div>
                </div>
                <!-- /card -->
                <div class="card">
                    <div class="card-header" role="tab">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseThree_tips" aria-expanded="false">
                                <i class="indicator icon_plus_alt2"></i>Serais-je averti si le praticien annule mon RDV ?
                            </a>
                        </h5>
                    </div>
                    <div id="collapseThree_tips" class="collapse" role="tabpanel" data-parent="#tips">
                        <div class="card-body">
                            <p>
                                En cas d'annulation de votre RDV par le praticien, vous serez contacté par son 
                                secrétariat par mail ou par téléphone.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /card -->
            </div>
            <!-- /accordion suggestions -->
            
            <div role="tablist" class="add_bottom_45 accordion" id="reccomendations">
                <div class="card">
                    <div class="card-header" role="tab">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapseOne_reccomendations" aria-expanded="true"><i class="indicator icon_plus_alt2"></i>Pouvez-vous me conseiller un professionnel de santé ?</a>
                        </h5>
                    </div>

                    <div id="collapseOne_reccomendations" class="collapse" role="tabpanel" data-parent="#reccomendations">
                        <div class="card-body">
                            <p>
                                Nous facilitons votre choix en mettant à votre disposition toutes les 
                                informations dont nous disposons concernant le praticien : informations pratiques 
                                et tarifaires, photos, avis d'autres patients.

                            </p>
                        </div>
                    </div>
                </div>
                <!-- /card -->
                <div class="card">
                    <div class="card-header" role="tab">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo_reccomendations" aria-expanded="false">
                                <i class="indicator icon_plus_alt2"></i>Qu'allez-vous faire de mes données ?
                            </a>
                        </h5>
                    </div>
                    <div id="collapseTwo_reccomendations" class="collapse" role="tabpanel" data-parent="#reccomendations">
                        <div class="card-body">
                            <p>
                                Vos données sont uniquement communiquées au médecin et à son secrétariat. 
                                Nous nous engageons à ne pas transmettre vos informations à des tiers. 
                                Consultez nos conditions d'utilisation.

                            </p>
                        </div>
                    </div>
                </div>
                <!-- /card -->
                <div class="card">
                    <div class="card-header" role="tab">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseThree_reccomendations" aria-expanded="false">
                                <i class="indicator icon_plus_alt2"></i>Ce service ne va-t-il pas remplacer les secrétaires ?
                            </a>
                        </h5>
                    </div>
                    <div id="collapseThree_reccomendations" class="collapse" role="tabpanel" data-parent="#reccomendations">
                        <div class="card-body">
                            <p>
                                Non, ce service a pour but de faciliter le  travail des secrétaires. Il leur 
                                permet de leur faire gagner du temps pour se consacrer à d'autres tâches pour 
                                le médecin (gestion des dossiers, rédaction de courriers, accueil, …). De plus, 
                                vous avez toujours la possibilité de joindre le secrétariat du médecin pour obtenir 
                                un complément d'informations ou en cas d'urgence.

                            </p>
                        </div>
                    </div>
                </div>
                <!-- /card -->
            </div>
            <!-- /accordion Reccomendations -->
            
            

        </div>
        <!-- /col -->
    </div>
    <!-- /row -->
</div>

@endsection