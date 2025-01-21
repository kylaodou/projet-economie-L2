<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une tâche</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="contenair">
        <div class="tableau_sidebar" id="tableau_sidebar">
            <div class="user">
                <img src="../img/user1.png" alt="Image de l'utilisateur" id="usersimg">
                <span id="username">Projet Economie </span>
            </div>
            <div class="menu_tableau">
                <ul class="menu_list">
                    <li>
                        <a href="/ajouter"><i class="fa-solid fa-folder-plus"></i><span class="menuText"> Ajout
                                mouvement</span></a>
                    </li>
                    <li>
                        <a href="/liste"><i class="fa-solid fa-table-list"></i><span class="menuText"> Liste des
                                comptes</span></a>
                    </li>

                    <li>
                        <a href="/journal"><i class="fa-solid fa-table-list"></i><span
                                class="menuText">Journal</span></a>
                    </li>
                    <li>
                        <a href="/rapport"><i class="fa-solid fa-table-list"></i><span class="menuText">Rapport</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tableau_content" id="tableau_content">
            <div class="topNav">
                <a href="" id="barBtn"><i class="fa-solid fa-bars"></i></i></a>
            </div>
            <div class="content">
                <div class="content_mai">
                    <h2>Liste des mouvements du journal</h2>
                    <div class="userlist">
                        <div class="container">
                            <table class="table">
                                <thead>
                                    <tr class="white">
                                        <th>Date</th>
                                        <th>Libellé</th>
                                        <th>Compte</th>
                                        <th>Montant</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $previousDate = null;
                                        $previousLibelle = null;
                                    @endphp
                                    @foreach ($journal as $mouvement)
                                        <tr class="row-border">
                                            @if ($mouvement->date != $previousDate || $mouvement->libelle != $previousLibelle)
                                                @php
                                                    // Compter le nombre de mouvements avec la même date et le même libellé
                                                    $spanCount = $journal
                                                        ->where('date', $mouvement->date)
                                                        ->where('libelle', $mouvement->libelle)
                                                        ->count();
                                                @endphp
                                                <td class="col text-center align-middle" rowspan="{{ $spanCount }}">
                                                    {{ $mouvement->date }}</td>
                                                <td class="col text-center align-middle" rowspan="{{ $spanCount }}">
                                                    {{ $mouvement->libelle }}</td>
                                            @endif
                                            <td class="col text-center align-middle">{{ $mouvement->compte }}</td>
                                            <td class="col text-center align-middle">{{ $mouvement->montant }}</td>
                                            <td class="col text-center align-middle">{{ $mouvement->type }}</td>
                                        </tr>
                                        @php
                                            $previousDate = $mouvement->date;
                                            $previousLibelle = $mouvement->libelle;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>

</body>

</html>
