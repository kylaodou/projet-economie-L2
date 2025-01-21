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
                        <a href="/journal"><i class="fa-solid fa-table-list"></i><span class="menuText">Journal</span></a>
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
                    <h2>Liste des mouvement</h2>
                    <div class="userlist">
                        <!-- Sélecteur de compte -->
                        <select id="compteSelect" class="form-select">
                            <option value="">Sélectionnez un compte</option>
                            @foreach ($dataPourVue as $compte => $mouvements)
                                <option value="{{ $compte }}">{{ $compte }}</option>
                            @endforeach
                        </select>

                        <!-- Les informations des comptes seront affichées ici -->
                        <div id="informationsCompte"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectElement = document.getElementById('compteSelect');
            var informationsDiv = document.getElementById('informationsCompte');

            selectElement.addEventListener('change', function() {
                var compte = this.value;
                informationsDiv.innerHTML = ''; // Vider les informations précédentes

                if (compte) {
                    @foreach ($dataPourVue as $compte => $mouvements)
                        if (compte === "{{ $compte }}") {
                            var totalDebit = 0;
                            var totalCredit = 0;
                            var tableHTML = '<h3>Compte: ' + compte + '</h3>' +
                                '<table class="table">' +
                                '<thead class="th">' +
                                '<tr>' +
                                '<th>Date</th>' +
                                '<th >Libellé</th>' +
                                '<th>Débit</th>' +
                                '<th>Crédit</th>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>';
                            @foreach ($mouvements as $mouvement)
                                var debit = parseFloat("{{ $mouvement['debit'] }}");
                                var credit = parseFloat("{{ $mouvement['credit'] }}");
                                totalDebit += isNaN(debit) ? 0 : debit;
                                totalCredit += isNaN(credit) ? 0 : credit;

                                tableHTML += '<tr class="row-border">' +
                                    '<td class="col">{{ $mouvement['date'] }}</td>' +
                                    '<td class="col">{{ $mouvement['libelle'] }}</td>' +
                                    '<td class="col">' + debit + '</td>' +
                                    '<td class="col">' + credit + '</td>' +
                                    '</tr>';
                            @endforeach
                            // Calculer le solde et déterminer s'il est débiteur ou créditeur
                            var solde = totalDebit - totalCredit;
                            var soldeType = solde >= 0 ? 'Solde débiteur' : 'Solde créditeur';
                            let couleur = '';
                            if(solde<0){
                                        couleur = '#dc35458c'
                                    }else{
                                        couleur = '#2ECC71'
                                    }
                            var soldeValeur = Math.abs(solde);

                            // Ajouter la ligne de total et la ligne de solde
                            tableHTML += '<tr class="total-row">' +
                                '<td class="col" colspan="2">Total</td>' +
                                '<td class="col">' + totalDebit + '</td>' +
                                '<td class="col">' + totalCredit + '</td>' +
                                '</tr>' +
                                `<tr class="solde-row white" style="background:${couleur};">` +
                                '<td class="col" colspan="3">' + soldeType + '</td>' +
                                '<td class="col">' + soldeValeur + '</td>' +
                                '</tr>';
                            tableHTML += '</tbody></table>';
                            informationsDiv.innerHTML = tableHTML;
                        }
                    @endforeach
                }
            });
        });
    </script>
    <script src="../js/script.js"></script>

</body>

</html>
