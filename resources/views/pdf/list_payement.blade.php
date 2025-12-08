<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Educas est une application de gestion d'ecole dans son ensemble">
    <meta name="author" content="Jean-Marius Yao">
    <title>liste paiement {{ $value }}</title>
</head>
<style>
    @page {
        margin: 150px 15px 100px 15px; /* top, right, bottom, left */
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
    <div class="watermark">liste paiement</div>
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
                                <hr style="width: 30%; margin: 0px auto; border: 1px dotted black">
                                {{-- <hr style="width: 20%; margin: 0px auto; border: 1px dotted black"> --}}
                                <i style="font-size: 11px">{{ date('d-m-Y à H:m') }}</i>
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
        <div style="margin-top: 15px; padding-top: 6%; paddin-bottom: 15px">
            <div style="margin: 20px auto; padding: 15px; width: 50%; border: 1px solid black">
              <div style="text-align: center; font-size: 20px; text-transform: uppercase;">
                <b>Liste Payement {{ ucwords($value) }}</b>
              </div>
            </div>

            <div style="margin-top: 8%">
              <table border="2" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 90%; margin: 5px auto; border: 1px solid black;">
                <thead>
                    <tr>
                        <th style="width: 5%; padding: 5px;"></th>
                        <th style="width: 10%; text-align: left; padding: 5px;">Matricule</th>
                        <th style="width: 45%; text-align: left; padding: 5px;">Nom & Prenoms</th>
                        <th style="width: 10%; text-align: left; padding: 5px;">Groupe</th>
                        <th style="width: 30%; text-align: left; padding: 5px;">Type</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; $total = 0;  @endphp
                    @foreach ($data as $item)
                    <tr>
                      <td style="text-align: center">{{ $i <= 9 ? '0'.$i++:$i++ }}</td>
                      <td style="text-align: center">{{ $item->matricule }}</td>
                      <td>{{ strtoupper($item->first_name).' '.Str::limit(ucwords($item->last_name), '30', '...') }}</td>
                      <td style="text-align: center">{{ ucwords($item->group) }}</td>
                      <td style="text-align: center">{{ ucwords($item->libelle) }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
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