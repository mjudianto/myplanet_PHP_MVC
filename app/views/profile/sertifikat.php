<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sertifikat</title>
    <!--bootstrap harus tetep di atas file css-->
    <link rel="stylesheet" href="<?= BASEURL ?>/css/app.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- <style>
        /* CSS style to set the background image */
        body {
        background-image: url('/public/assets/certif.jpeg');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        }
    </style> -->
    
</head>

<body class="d-flex justify-content-center" id="body">
    <page>
    <img style="width: 1054px;height: 816px;display: block;"  src="<?= BASEURL ?>assets/certif.jpeg">

    <div style="position: absolute; width: 100%; top: 10px;    text-align: center; font-size: 50px;color: #14727C;">
        <h1 class="name">Nanda Raditya</h1>
    </div>
    <div style="position: absolute; top: 355px;left: 420px; font-size: 28px; color: #14727C;">
        <h5 class="nik">230100022</h5>
    </div>
    <div style="position: absolute; width: 100%; top: 386px;  text-align: center; font-size: 28px; color: #14727C;">
        <h5 class="title-learning">Leadership</h5>
    </div>
    <div style="position: absolute; width: 100%; top: 470px; text-align: center; font-size: 20px; color: #14727C;">
    </div>
    </page>

    <button id="downloadPdfBtn" style="float:right; margin-bottom:5vh; margin-right: 5vh; margin-top:5vh;"><i class="fa fa-download"></i>Download</button>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <script>
        
    // get the button element
    const downloadBtn = document.getElementById('downloadPdfBtn');

    // add click event listener to the button
    downloadBtn.addEventListener('click', () => {
    // get the div content to be converted to PDF
    const divContent = document.body;

    // set the PDF options
    const pdfOptions = {
        margin: [0, 0],
        filename: 'myDiv.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' },
    };

    // convert div content to PDF
    html2pdf().set(pdfOptions).from(divContent).save();
    });


</script>

    
</body>

</html>
