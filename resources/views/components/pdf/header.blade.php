<!DOCTYPE html>
<meta charset="utf-8">
<style>
    .pageHeader {
        -webkit-print-color-adjust: exact;
        font-family: system-ui;
        font-size: 10px;
        width: 100%;
        /* display: flex; */
        /* justify-content: space-between; */
        /* align-items: center; */
        margin: 0 30px 0 30px;
        /* position: relative; */
        /* padding: 10px; */
        /* background-color: red; */

        /* Ajusta el color de fondo si es necesario */
    }

    .logo {
        height: 50px;
        /* Ajusta el tamaño del logo según sea necesario */
    }

    .header-item {
        display: flex;
        text-align: center;
        /* margin-left: 10rem */
    }
</style>
<header class="pageHeader">
    <table style="width: 100%">
        <tbody>
            <tr>
                <td style="width: 30%; text-align: left">
                    <img src="{{ $logoBase64 }}" alt="Logo" class="logo">
                </td>
                <td style="width: 40%; text-align: center">
                    <ul style="list-style: none; padding: 0; margin: 0; text-align: center;">
                        <li>San Juan Bautista de Huaral</li>
                        <li>RUC: 32134654684</li>
                        <li>CALLE TACNA N° 120 - HUARAL</li>
                    </ul>
                </td>
                <td style="text-align: right">
                    <span> Hospital ...</span>
                </td>
            </tr>
        </tbody>
    </table>
</header>
