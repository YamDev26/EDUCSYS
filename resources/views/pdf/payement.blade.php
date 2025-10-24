<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Educas est une application de gestion d'ecole dans son ensemble">
    <meta name="author" content="Jean-Marius Yao">
    <title>reçu de paiement</title>
</head>
<style>
    @page {
        margin: 150px 30px 150px 30px; /* top, right, bottom, left */
    }

    body {
        font-size: .875em;
        overflow-x: hidden;
        color: #353c4e;
        font-family: "Open Sans", sans-serif;
    }


    header {
        position: fixed;
        top: -80px;
        left: 0px;
        right: 0px;
        height: 50px;
        text-align: center;
        font-size: 18px;
    }

    .watermark {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-50deg);
        font-size: 100px;
        color: rgba(0, 0, 0, 0.05);
        z-index: -1;
        white-space: nowrap;
        pointer-events: none;
        text-transform: uppercase;
    }

    footer {
        position: fixed;
        border-top: 5px double rgb(8, 47, 79);
        bottom: -100px;
        left: 0px;
        right: 0px;
        height: 50px;
        text-align: center;
        font-size: 12px;
        color: #4d4b4b;
    }
</style>
<body>
    <div class="watermark">Réçu de paiement</div>
    <header style="margin: 15px auto; height: 100px;">
        <div style="display: flex; flex-direction: row; justify-content: space-between;">
            <table style="width: 100%">
                <tbody>
                    <tr style="margin-bottom: 0%">
                        <td style="width: 50%; border:none">
                            <div style="text-align: center; font-size: 13px">
                                <b>REPUBLIQUE DE COTE D'IVOIRE</b><br>
                                <i>Union - Discipline - Travail</i>
                                <hr style="width: 50%; margin: 10px auto; border: 1px dotted black">
                                <hr style="width: 30%; margin: 10px auto; border: 1px dotted black">
                                <hr style="width: 20%; margin: 0px auto; border: 1px dotted black">
                                <i style="font-size: 11px">N° {{ random_int(100, 1000).' - 01' }}</i>
                            </div>
                        </td>
                        <td style="width: 50%; border:none">
                            <div style="text-align: center; font-size: 13px;">
                                
                                <b style="font-size: 17px;" style="text-decoration: underline;">{{mb_strtoupper('centre thalith')}}</b>
                                <div style="margin: 10px auto">
                                    <img src="assets/images/logo/logo_1.jpg" class="img-fluid mt-1" alt="qr-code-image" height="60" width="80" style="border-radius: 5px">
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </header>


    <section style="margin: 30px auto;">
        <div style="margin-top: 25px; padding-top: 10%; paddin-bottom: 15px">
            <div style="margin: 20px auto; padding: 15px; width: 50%; border: 1px solid black">
                <div style="text-align: center; font-size: 27px; text-transform: uppercase;">
                    <b>Réçu de paiement</b>
                </div>
            </div>
            
            <div style="padding-top: 10%;  margin-top: 5px;">
                <table style="width: 90%; margin: 1px auto">
                    <tbody>
                        <tr>
                            <td style="width: 70%; border:none">
                                <table>
                                    <tbody>
                                        <tr>
                                            <th style="text-align: left; padding: 5px;">
                                                {{-- <h5 style="margin: 0px; color:#4d4b4b">Nom et Prénoms</h5> --}}
                                                <b style="margin: 0px; font-size: 19px">{{ strtoupper($student->student->first_name) .' '. ucwords($student->student->last_name) }}</b>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: left; padding: 5px; width: 80%">
                                                <h5 style="margin: 0px; color:#4d4b4b">Date et lieu de naissance</h5>
                                                <b style="margin: 0px; font-size: 15px">{{ $student->student->date_birth ? date('d/m/Y', strtotime($student->student->date_birth)).' '.($student->student->birth ? 'à '.ucwords($student->student->birth):'A definir'):'A definir' }}</b>
                                            </th>
                                            <th style="text-align: left; padding: 5px; width: 20%">
                                                <h5 style="margin: 0px; color:#4d4b4b">Genre</h5>
                                                <b style="margin: 0px; font-size: 14px">{{ $student->student->sexe == 'F' ? 'Feminin':'Masculin' }}</b>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: left; padding: 5px;">
                                                <h5 style="margin: 0px; color:#4d4b4b">Niveau d'étude</h5>
                                                <b style="margin: 0px; font-size: 14px">{{ ucwords($student->level->level) }} - {{ ucwords($student->originSchool->libelle) }}</b>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: left; padding: 5px;">
                                                <h5 style="margin: 0px; color:#4d4b4b">Parent</h5>
                                                <b style="margin: 0px; font-size: 14px">{{ ($student->student->studentParent->civility == 'm' ? 'M. ':'Mde ').strtoupper($student->student->studentParent->first_name) .' '. ucwords($student->student->studentParent->last_name) }}</b>
                                            </th>
                                        </tr>
                                        <th style="text-align: left; padding: 5px;">
                                            <h5 style="margin: 0px; color:#4d4b4b">Téléphone</h5>
                                            <b style="margin: 0px; font-size: 14px">{{ $student->student->studentParent->phon1 }} {{$student->student->studentParent->phon ? ' - '.$student->student->studentParent->phon2:null}}</b>
                                        </th>
                                    </tbody>
                                </table>
                            </td>
                            <td style="width: 30%; text-align:center">
                                <h3 style="font-weight: bold;">{{ $student->student->matricule }}</h3>
                                <div style="margin: 0px auto">
                                    <img src="assets/images/users/utilisateur.png" alt="team-member-image" height="105" width="120" style="margin: 0%">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 3%">
                <table border="2" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 90%; margin: 5px auto; border: 1px solid black;">
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align: center; padding: 5px;"></th>
                            <th style="width: 40%; text-align: center; padding: 5px;">Intitulé</th>
                            <th style="width: 15%; text-align: center; padding: 5px;">Durée</th>
                            <th style="width: 20%; text-align: center; padding: 5px;">Période</th>
                            <th style="width: 20%; text-align: center; padding: 5px;">Coût</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; $total = 0;  @endphp
                        @foreach ($datas as $item)
                        <tr>
                            <td style="text-align: center">{{ $i <= 9 ? '0'.$i++:$i++ }}</td>
                            <td>{{ ucfirst($item->parametre->libelle) }} {{ $item->section_id ? ' - Section '.$item->section->order:null }}</td>
                            <td style="text-align: center">{{ $item['section_id'] ? '3 mois':'1 mois' }}</td>
                            <td style="text-align: center">
                                Du {{ 
                                    $item['section_id'] ? (date('d/m/Y', strtotime($item->section->debut)).' au '.date('d/m/Y', strtotime($item->section->fin))):
                                    (date('d/m/Y', strtotime($item->debut)).' au '.date('d/m/Y', strtotime($item->fin)))
                                 }}
                            </td>
                            <td style="text-align: center">{{ $item->parametre->montant ? formatMontant($item->parametre->montant):'00' }}F</td>
                        </tr>
                        @php $total += $item->parametre->montant  @endphp
                        @endforeach
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 5px;">Net à payer</td>
                            <td style="text-align: center; padding: 5px; font-weight: bold;">{{ $total ? formatMontant($total):'00' }}F</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width: 50%; float: right; text-align:right; margin-right: 8%; margin-top: 4%">
                Abidjan, le <b>{{ date('d/m/Y') }}</b>.
            </div>
        </div>
    </section>
    <footer class="footer">
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between;">
            <table style="width: 100%">
                <thead>
                    <th>{{mb_strtoupper('centre thalith')}}</th>
                    <th>©{{'2025-2026'}}</th>
                    <th>{{'centrethalith@gmail.com'}} / {{'0141001038'}}</th>
                </thead>
            </table>
        </div>
    </footer>
</body>
</html>