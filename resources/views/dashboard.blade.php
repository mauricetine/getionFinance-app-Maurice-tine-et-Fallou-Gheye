<x-app-layout>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-blue-100 text-blue-900">
                    <div class="flex justify-between">
                        <div>

                            <h3>Informations du compte :</h3>
                            
                            
                        </div>

                    </div>
                </div>
            </div> -->
            <div class="container-xxl feature py-5">
                <div class="container">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6">
                            <div class="row g-4 align-items-center">
                                <div class="col-md-6">
                                    <div class="row g-4">
                                        <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                            <div class="feature-box border rounded p-4">

                                                <h3 class="mb-3">Nom:</h3>
                                                <p class="mb-3">{{ $user->name }}</p>

                                            </div>
                                        </div>
                                        <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                            <div class="feature-box border rounded p-4">

                                                <h3 class="mb-3">RIB:</h3>
                                                <p class="mb-3">{{ $user->rib }}</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
                                    <div class="feature-box border rounded p-4">

                                        <h3 class="mb-3">Compte:</h3>
                                        <p class="mb-3">{{ $user->type_compte }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="container-fluid facts my-5 py-5">
                                <div class="container py-5">
                                    <div class="row g-5">
                                        <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.01s">
                                            <i class="fa fa-coins fa-3x text-white mb-3"></i>
                                            <h1 class="display-4 text-white" data-toggle="counter-up">{{ $user->solde }}</h1>
                                            <span class="fs-5 text-white">solde</span>
                                            <hr class="bg-white w-25 mx-auto mb-0">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <center>
                <div class="card mt-4">



                    <!-- Ajoutez ici le code HTML et CSS pour le design de la carte bancaire -->

                    <div class="card">
                        <div class="card-inner">
                            <div class="card-front">
                                <div class="card-bg"></div>
                                <div class="card-glow"></div>
                                <svg width="72" height="24" viewBox="0 0 72 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="logo">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M52.3973 1.01093L51.5588 5.99054C49.0448 4.56717 43.3231 4.23041 43.3231 6.85138C43.3231 7.89285 44.6177 8.60913 46.178 9.47241C48.5444 10.7817 51.5221 12.4291 51.5221 16.062C51.5221 21.8665 45.4731 24 41.4645 24C37.4558 24 34.8325 22.6901 34.8325 22.6901L35.7065 17.4848C38.1115 19.4688 45.4001 20.032 45.4001 16.8863C45.4001 15.5645 43.9656 14.785 42.3019 13.8811C40.0061 12.6336 37.2742 11.1491 37.2742 7.67563C37.2742 1.30988 44.1978 0 47.1132 0C49.8102 0 52.3973 1.01093 52.3973 1.01093ZM66.6055 23.6006H72L67.2966 0.414276H62.5732C60.3923 0.414276 59.8612 2.14215 59.8612 2.14215L51.0996 23.6006H57.2234L58.4481 20.1566H65.9167L66.6055 23.6006ZM60.1406 15.399L63.2275 6.72235L64.9642 15.399H60.1406ZM14.7942 16.3622L20.3951 0.414917H26.7181L17.371 23.6012H11.2498L6.14551 3.45825C2.83215 1.41281 0 0.807495 0 0.807495L0.108643 0.414917H9.36816C11.9161 0.414917 12.1552 2.50314 12.1552 2.50314L14.1313 12.9281L14.132 12.9294L14.7942 16.3622ZM25.3376 23.6006H31.2126L34.8851 0.414917H29.0095L25.3376 23.6006Z" fill="white" />
                                </svg>
                                <div class="card-contactless">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="46" height="56">
                                        <path fill="none" stroke="#f9f9f9" stroke-width="6" stroke-linecap="round" d="m35,3a50,50 0 0,1 0,50M24,8.5a39,39 0 0,1 0,39M13.5,13.55a28.2,28.5
  0 0,1 0,28.5M3,19a18,17 0 0,1 0,18" />
                                    </svg>
                                </div>
                                <div class="card-chip"></div>
                                <div class="card-holder">{{ $user->name }}</div>
                                <div class="card-number">{{ $user->numero_carte }}</div>
                                <div class="card-valid">{{ $user->date_expiration }}</div>
                            </div>
                            <div class="card-back">
                                <div class="card-signature">{{ $user->name }}</div>
                                <div class="card-seccode">{{ $user->cvv }}</div>
                            </div>
                        </div>
                    </div>




                </div>
            </center>

        </div>
</x-app-layout>