$(document).ready(function () {

    var tc_copies = 1;

    qz.security.setCertificatePromise(function(resolve, reject) {
        resolve("-----BEGIN CERTIFICATE-----\n" +
            "MIIDlTCCAn2gAwIBAgIJAJrIkCi1trLMMA0GCSqGSIb3DQEBCwUAMGExCzAJBgNV\n" +
            "BAYTAkFVMRMwEQYDVQQIDApTb21lLVN0YXRlMSEwHwYDVQQKDBhJbnRlcm5ldCBX\n" +
            "aWRnaXRzIFB0eSBMdGQxGjAYBgNVBAMMEWVudG9ybm9wcnVlYmFzLmNvMB4XDTE4\n" +
            "MDYyOTE4MzUyMVoXDTI4MDYyNjE4MzUyMVowYTELMAkGA1UEBhMCQVUxEzARBgNV\n" +
            "BAgMClNvbWUtU3RhdGUxITAfBgNVBAoMGEludGVybmV0IFdpZGdpdHMgUHR5IEx0\n" +
            "ZDEaMBgGA1UEAwwRZW50b3Jub3BydWViYXMuY28wggEiMA0GCSqGSIb3DQEBAQUA\n" +
            "A4IBDwAwggEKAoIBAQDSk1zcg/yW4uzn3WJYSG3Qv908I52FSr84lTqCwQjPGU1q\n" +
            "P1/9swRkqcxBChpFiDTyJT+Ajl+Qd5O06XN0SfrRKlY3zJNyc18VoNPUN802aSeW\n" +
            "5ix5LWvmtXQnft2GPIin+5elwlAG0YD+1wxTzMzHQuhQMiL0U1H9hmg52qD3q4Tq\n" +
            "RjgBmVKgPh6Ei43XLj/C10OZEYKdeqJJRCn81CDxIM2TQhANVF5fvvCuzK1RPCG4\n" +
            "FsT07kHh0YRDXly4pmU5JnbkHQHQm0Q68HmsiIkh+w1j7rpNTBw/NKc2nE6KoBFE\n" +
            "WIEQQfkdrrfzQxWwYPExa3DZ2N/i4Z2E/fPiXdiFAgMBAAGjUDBOMB0GA1UdDgQW\n" +
            "BBT4XNx5MaqAnJ4idHWmONxvLp4NuTAfBgNVHSMEGDAWgBT4XNx5MaqAnJ4idHWm\n" +
            "ONxvLp4NuTAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBCwUAA4IBAQDKShdzAWoO\n" +
            "KAzEfkLQrd2tweooWuHAS2LepV42dSbgsbCBTGqxtT8yChqCMgP59FQYxxGmfq8O\n" +
            "8OpjGn7qNYN0R+iAaw3A8ss8PZ6y5N/qIzgXE9ZWyaQB7MUGDU3KKtANdg2Fx4hd\n" +
            "k6p1Xx/HZ0pt1e2BNj4VwlU3Gqb1z7WkrJJQRfNDLgnNq0z7mrRxzIcf3Ko8kfDW\n" +
            "U8i6wCB81ebv4kpoQRhxlOEHw9eZqd7iVqNS7RCZD+SrLXUAhCjQBgRAGErH1gud\n" +
            "3Zwqkc6WYaSHg/ubvRuF7csa2CfSNN8/LtMqAdWq1BqBEqbF58bgMZAFgvN7PAbi\n" +
            "aFIVBNuZX/N9\n" +
            "-----END CERTIFICATE-----");
    });

    qz.security.setSignaturePromise(function(toSign) {
        return function(resolve, reject) {
            $.ajax(url+"?request=" + toSign).then(resolve, reject);
        };
    });

    qz.websocket.connect().then(function() {
        //alert('Conectado');
        console.log(">> CONECTADO A QZ <<");
        //displayMessage("<strong>Conectado</strong><br/>");
    });

    function findPrinters() {
        qz.printers.find().then(function(data) {
            var list = '';
            for (var i = 0; i < data.length; i++) {
                list += "-" + data[i] + "-";
            }
            console.log("Impresoras disponibles");
            console.log(list);
            //displayMessage("<strong>Impresoras disponibles:</strong><br/>" + list);
        }).catch(function(e) {
            console.error(e);
        });
    }

    // $("#generar")[0].submit(function (e) {
    //     e.preventDefault();
    //     imprimir();
    // });
    
    $('[name="generar"]').on('submit', function (e) {
        console.log(e.preventDefault());
        imprimir();
        $('[name="generar"]')[0].submit();
    });

    function imprimir() {
        console.log("IMPRIMIENDO CON LA IMPRESORA:");
        console.log(printer);
        var config = qz.configs.create(printer, {
            copies: tc_copies
        });

        var dataL = [{
                type: 'raw',
                format: 'image',
                data: 'data:image/jpeg;base64,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',
            options: {
                language: "ESC/POS",
                dotDensity: 'double'
            }
        },
        {
            type: 'raw',
            data: ticket
        },
        {
            type: 'raw',
            data: '\x0A' + '\x0A' + '\x0A' + '\x0A' + '\x0A' + '\x0A' + '\x1B' + '\x69'
        }
    ];
    console.log(dataL);
    qz.print(config, dataL).catch(function(e) { console.error(e); });


}
});