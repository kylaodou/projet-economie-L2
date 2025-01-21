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
                    <h2>Crée un mouvement</h2>
                    <div class="userlist">
                        <form action="/traitement" method="post">
                            @csrf
                            <table>
                                <thead style="background-color: #d65479 !important;">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Libellé</th>
                                        <th>Compte</th>
                                        <th>Montant</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody id="movementTableBody">

                                    <tr class="row-border">
                                        <td>
                                            1
                                        </td>

                                        <td>
                                            <label for="floatingInput">Date :</label>
                                            <input type="date" id="start" name="dates[]" value="{{ old('dates.0', date('Y-m-d')) }}" required/>
                                        </td>
                                        <td>
                                            <div class="form-floating mb">
                                                <input type="text" class="form-control" name="libelles[]"
                                                    id="floatingInput" placeholder="name@example.com" required>
                                                <label for="floatingInput">Description</label>
                                            </div>
                                        </td>
                                        <td>
                                            <select class="form-select form-select-lg mb select2" name="comptes[]"
                                                aria-label="Large select example">
                                                <option selected>Choisir le numéro de compte</option>
                                                <option value="10">10 Capital</option>
                                                <option value="401">401 Fournisseurs</option>
                                                <option value="411">411 Clients</option>
                                                <option value="521">521 Banques</option>
                                                <option value="571">571 Caisse</option>
                                                <option value="661">661 Rénumération du personnel</option>
                                                <option value="701">701 Vente de marchandise</option>
                                                <option value="6047">6047 Fournitures de bureau</option>
                                                <option value="6052">6052 Electricité</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="number" id="typeNumber" class="form-control" name="montant[]" required/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="types[0]" value="Débité"
                                                    >
                                                <label class="form-check-label" for="debitDefault1">
                                                    Débité
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="types[0]" value="Crédité"
                                                    checked>
                                                <label class="form-check-label" for="creditDefault2">
                                                    Crédité
                                                </label>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="boutton" type="button" id="addMovement">Ajouter un mouvement</button>
                                <button class="bouttonsup" type="button" id="removeMovement">Supprimer un mouvement</button>

                            </div>
                                <button type="submit" class="envoi">Arrêté le compte</button>
                                            </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Félicitation!",
                text: "Votre jounal a ajouter avec succès",
                icon: "success",
                allowOutsideClick: false, // **Désactivation de la fermeture en cliquant en dehors**
                showConfirmButton: true, // **Affichage du bouton OK**
            });
        </script>
    @endif
    <script src="../js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var counter = 1; // Initialiser le compteur de lignes

            // Fonction pour ajouter une ligne
            document.getElementById('addMovement').addEventListener('click', function() {
                const tableBody = document.getElementById('movementTableBody');
                const newRow = document.createElement('tr');
                newRow.classList.add('row-border');
                newRow.innerHTML = `
            <td>${++counter}</td>
            <td>
                <label>Date :</label>
                <input type="date" class="start" name="dates[]" value="{{ date('Y-m-d') }}" />
            </td>
            <td>
                <div class="form-floating mb">
                    <input type="text" name="libelles[]" class="form-control" placeholder="Description">
                    <label>Description</label>
                </div>
            </td>
            <td>
                <select class="form-select form-select-lg mb select2" name="comptes[]" aria-label="Large select example">
                    <option selected>Choisir le numéro de compte</option>
                                                <option value="10">10 Capital</option>
                                                <option value="401">401 Fournisseurs</option>
                                                <option value="411">411 Clients</option>
                                                <option value="521">521 Banques</option>
                                                <option value="571">571 Caisse</option>
                                                <option value="661">661 Rénumération du personnel</option>
                                                <option value="701">701 Vente de marchandise</option>
                                                <option value="6047">6047 Fournitures de bureau</option>
                                                <option value="6052">6052 Electricité</option>
                </select>
            </td>
            <td>
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="number" id="typeNumber" class="form-control" name="montant[]"/>
                                            </div>
                                        </td>
            <td>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="types[${counter - 1}]" value="Débité">
        <label class="form-check-label">Débité</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="types[${counter - 1}]" value="Crédité" checked>
        <label class="form-check-label">Crédité</label>
    </div>
</td>


        `;
        tableBody.appendChild(newRow);

                // Réinitialiser Select2 pour les nouveaux éléments select
                $(`#accountSelect${counter}`).select2({
                    width: 'style', // Assurez-vous que la largeur est définie selon le style CSS
                    dropdownAutoWidth: true // Permet au dropdown de s'ajuster à la largeur du select
                });
            });

            // Fonction pour supprimer la dernière ligne
            document.getElementById('removeMovement').addEventListener('click', function() {
                const tableBody = document.getElementById('movementTableBody');
                if (tableBody.rows.length > 1) {
                    tableBody.deleteRow(-1);
                    counter--;
                }
            });
        });
    </script>

    </script>
</body>

</html>
