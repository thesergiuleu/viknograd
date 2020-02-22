

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>PressCheck Template</title>
    <link rel="stylesheet" href="{{asset('styles/css/bootstrap.min.css')}}">
    <!--    <link rel="stylesheet" href="css/presscheck_style.css">-->
    <!--    <link rel="stylesheet" href="css/font-awesome.min.css">-->
    <!--    <link rel="stylesheet" href="css/owl.carousel.css">-->
    <!--    <link rel="stylesheet" href="css/owl.theme.default.min.css">-->
    <!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>-->
    <!--    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">-->

    <style>


        .modal-wrapper {
            display: none;
            transition: all 0.3s ease-in-out;
            background-color: transparent;
        }

        .modal-wrapper.is-open {
            display: block;
            position: fixed;
            z-index: 1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            overflow-y:scroll;
        }

        .modal-body {
            animation: pop 0.5s ease;
            /*width: 90%;*/
            width: 500px;
        }

        header {
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        @keyframes pop {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }

            90% {
                transform: scale(1.02);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        * {
            box-sizing: border-box;
        }

        [data-modal-trigger] {
            outline: 0;
            color: #303030;
            border: 1px solid #303030;
            padding: 10px 20px;
            background-color: transparent;
            margin: 20px;
            position: relative;

        &:before {
             z-index: -1;
             transition: all 0.3s ease;
             position: absolute;
             top: 0;
             bottom: 0;
             left: 0;
             width: 0%;
             content: '';
             background-color:#FFC107;
         }

        &:hover {
        &:before {
             width: 100%;
         }
        }
        }

        .modal-body {
            margin: 30px auto;
            background-color: white;
            border-radius: 5px;
            box-shadow: 10px 10px 40px 0px rgba(0,0,0,0.35);


        .modal-main {
            padding: 10px;
        }

        .close {
            color: white;
            background-color: transparent;
            border: 0;
            outline: 0;
        }

        p {
            color: #727272;
        }
        .modal-body h3 {
            font-size: 21px;
        }
        .cta {
            background-color:#FFC107;
            transition: background-color 0.3s ease;
            color:#FFECB3;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: block;
            width: 200px;
            text-align: center;
            margin: 20px auto;

        &:hover, &:active {
                      background-color: #FFA000;
                  }
        }
        }


        h1, p {
            padding: 0;
            margin: 0;
        }
        }
        .text-bold {
            font-weight: bold;
        }
        .presscheck-title-block {
            font-size: 14px;
            font-weight: bold;
        }
        .presscheck-title-block h3 {
            line-height: 1;
            margin: 15px 0;
        }
        .pc-modal-header {
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        .presscheck-logo {
            text-align: right;
        }
        .presscheck-logo svg {
            max-width: 135px;
            height: 45px;
            opacity: 0.6;
        }
        .pc-review-block {
            margin: 15px 0;
        }
        .pc-review-block, .pc-description-block, .pc-review-criterias, .pc-more-details {
            padding: 15px;
        }
        .pc-more-details {
            text-align: right;
        }
        .reviews-mark {
            padding: 0;
            text-align: center;
        }
        .border-bottom {
            border-bottom: 1px solid #f5f5f5;
        }
        .review-criterias {
            padding: 0;
        }
        .review-criterias .criteria-columns {
            display: inline-flex;
        }
        .review-criterias .criteria-first-column,
        .review-criterias .criteria-second-column {
            width: 50%;
        }
        .review-criterias li {
            list-style: none;
            display: inline-flex;
            align-items: center;
            margin: 12px 0;
            width: 100%;
            padding-right: 10px;
        }
        .review-criterias li:hover img {
            transform: scale(1.2);
        }
        .review-criterias img {
            max-width: 30px;
            margin-right: 10px;
            transition: all 1s;
        }
        .review-criterias ul {
            padding: 10px;
        }


    </style>

</head>

<body>

<button data-modal-trigger="form">Trigger modal</button>

<!-- Content of modal #1 -->
<section data-modal="form" class="modal-wrapper">
    <article class="modal-body">

        <header>
            <div class="container-fluid">
                <div class="row pc-modal-header">
                    <div class="presscheck-title-block col-lg-6">
                        <h3 class="sc-bwzfXH iquTUf">
                            <span class="presscheck-title-normal"> bbc.com </span>
                        </h3>
                    </div>
                    <div class="presscheck-logo col-lg-6">
                        <a href="https://www.presscheck.com" target="" rel="noopener noreferrer">


                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="360.548" height="92.15" viewBox="0 0 360.548 92.15">
                                <defs>
                                    <pattern id="pattern" preserveAspectRatio="xMidYMid slice" width="100%" height="100%" viewBox="0 0 197 197">
                                        <image width="197" height="197" xlink:href="data:image/png;base64,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"/>
                                    </pattern>
                                </defs>
                                <g id="Group_601" data-name="Group 601" transform="translate(-155 -84)">
                                    <g id="Group_569" data-name="Group 569" transform="translate(-254.287 -2070.824)">
                                        <g id="Group_570" data-name="Group 570">
                                            <g id="Group_598" data-name="Group 598">
                                                <path id="Path_804" data-name="Path 804" d="M6.746-13.03V0h-2.7V-31.992h10.9a11.488,11.488,0,0,1,7.877,2.549,8.863,8.863,0,0,1,2.889,7.009,8.78,8.78,0,0,1-2.78,6.954q-2.78,2.45-8.053,2.45Zm0-2.285h8.2a8.648,8.648,0,0,0,6-1.871A6.678,6.678,0,0,0,23.005-22.4a6.989,6.989,0,0,0-2.054-5.292,8.24,8.24,0,0,0-5.834-2.014H6.746Zm39.928,1.978H37.379V0H34.655V-31.992H45.048q5.12,0,8,2.48a8.663,8.663,0,0,1,2.878,6.935,8.659,8.659,0,0,1-1.8,5.421,9.213,9.213,0,0,1-4.834,3.248l8,13.622V0H54.408Zm-9.294-2.285h8.284a7.675,7.675,0,0,0,5.471-1.937A6.566,6.566,0,0,0,53.2-22.577a6.594,6.594,0,0,0-2.153-5.26A8.922,8.922,0,0,0,45-29.707H37.379Zm46.542.286H68.958V-2.285h17.2V0H66.255V-31.992h19.8v2.285H68.958v12.085H83.921Zm29.008,7.471a5.178,5.178,0,0,0-1.868-4.208q-1.868-1.549-6.833-2.944a23.95,23.95,0,0,1-7.251-3.043,7.183,7.183,0,0,1-3.252-6.108,7.157,7.157,0,0,1,3.021-5.966,12.407,12.407,0,0,1,7.723-2.3,12.811,12.811,0,0,1,5.7,1.23,9.331,9.331,0,0,1,3.9,3.428,9,9,0,0,1,1.384,4.9h-2.725a6.722,6.722,0,0,0-2.241-5.278,8.724,8.724,0,0,0-6.021-1.995,9.484,9.484,0,0,0-5.845,1.64,5.116,5.116,0,0,0-2.175,4.28A4.842,4.842,0,0,0,98.4-20.243a18.127,18.127,0,0,0,6.262,2.718,29.434,29.434,0,0,1,6.526,2.441,9.3,9.3,0,0,1,3.34,3.021,7.559,7.559,0,0,1,1.121,4.153,7.231,7.231,0,0,1-3.021,6.064A12.867,12.867,0,0,1,104.667.439,15.613,15.613,0,0,1,98.46-.769a9.481,9.481,0,0,1-4.285-3.384,8.736,8.736,0,0,1-1.461-4.988h2.7A6.387,6.387,0,0,0,97.943-3.8a10.7,10.7,0,0,0,6.724,1.956,9.966,9.966,0,0,0,6-1.648A5.152,5.152,0,0,0,112.929-7.866Zm29.623,0a5.179,5.179,0,0,0-1.868-4.208q-1.868-1.549-6.833-2.944a23.949,23.949,0,0,1-7.251-3.043,7.183,7.183,0,0,1-3.252-6.108,7.157,7.157,0,0,1,3.021-5.966,12.407,12.407,0,0,1,7.723-2.3,12.811,12.811,0,0,1,5.7,1.23,9.331,9.331,0,0,1,3.9,3.428,9,9,0,0,1,1.384,4.9h-2.725a6.722,6.722,0,0,0-2.241-5.278,8.724,8.724,0,0,0-6.021-1.995,9.484,9.484,0,0,0-5.845,1.64,5.116,5.116,0,0,0-2.175,4.28,4.842,4.842,0,0,0,1.956,3.984,18.127,18.127,0,0,0,6.262,2.718,29.434,29.434,0,0,1,6.526,2.441,9.3,9.3,0,0,1,3.34,3.021,7.559,7.559,0,0,1,1.121,4.153,7.231,7.231,0,0,1-3.021,6.064A12.867,12.867,0,0,1,134.29.439a15.613,15.613,0,0,1-6.207-1.208A9.481,9.481,0,0,1,123.8-4.153a8.736,8.736,0,0,1-1.461-4.988h2.7A6.387,6.387,0,0,0,127.566-3.8a10.7,10.7,0,0,0,6.724,1.956,9.966,9.966,0,0,0,6-1.648A5.152,5.152,0,0,0,142.551-7.866Zm34.72-2.285a11.77,11.77,0,0,1-3.746,7.833A12.278,12.278,0,0,1,165.143.439a11.273,11.273,0,0,1-9.086-4.065Q152.641-7.69,152.641-14.5v-3.076a18.228,18.228,0,0,1,1.593-7.844,11.9,11.9,0,0,1,4.515-5.2,12.572,12.572,0,0,1,6.768-1.813,11.56,11.56,0,0,1,8.174,2.845,11.912,11.912,0,0,1,3.582,7.877h-4.241q-.549-3.835-2.384-5.554a7.213,7.213,0,0,0-5.131-1.719,7.548,7.548,0,0,0-6.339,2.991q-2.3,2.991-2.3,8.51v3.1a14.114,14.114,0,0,0,2.175,8.291,7.029,7.029,0,0,0,6.086,3.079A8.118,8.118,0,0,0,170.537-4.6q1.879-1.593,2.494-5.548ZM210.586,0h-4.241V-14.788H190.217V0H186V-31.992h4.219v13.755h16.128V-31.992h4.241Zm28.546-14.788H225.268V-3.45h16.106V0H221.049V-31.992h20.1v3.45H225.268v10.305h13.865Zm34,4.636a11.77,11.77,0,0,1-3.746,7.833A12.278,12.278,0,0,1,261,.439a11.273,11.273,0,0,1-9.086-4.065Q248.5-7.69,248.5-14.5v-3.076a18.228,18.228,0,0,1,1.593-7.844,11.9,11.9,0,0,1,4.515-5.2,12.573,12.573,0,0,1,6.768-1.813,11.56,11.56,0,0,1,8.174,2.845,11.912,11.912,0,0,1,3.582,7.877h-4.241q-.549-3.835-2.384-5.554a7.213,7.213,0,0,0-5.131-1.719,7.548,7.548,0,0,0-6.339,2.991q-2.3,2.991-2.3,8.51v3.1a14.114,14.114,0,0,0,2.175,8.291A7.029,7.029,0,0,0,261-3.01,8.118,8.118,0,0,0,266.393-4.6q1.879-1.593,2.494-5.548Zm16.857-4.724-3.911,4.065V0h-4.219V-31.992h4.219v15.82l14.216-15.82h5.1L292.8-17.864,306.376,0h-5.054Z" transform="translate(463.459 2246.535)" fill="#7698b7"/>
                                            </g>
                                        </g>
                                    </g>
                                    <path id="Asset_7hdpi" data-name="Asset 7hdpi" d="M0,0H91.538V91.538H0Z" transform="translate(155 84)" fill="url(#pattern)"/>
                                </g>
                            </svg>


                        </a>
                    </div>
                </div>
            </div>
        </header>


        <div class="modal-main">

            <div class="col-md-12 pc-review-block border-bottom">
                <div class="col-sm-12 col-md-3 reviews-mark d-flex ">
                    <img class="reviews-chart" src="{{asset('styles/images/gauge/semisphere-3-01.svg')}}">
                    <h4>6 / 10</h4>
                </div>
                <div class="col-sm-12 col-md-9 reviews-description">
                    <div class="review-website text-bold">BBC
                        <a href="https://www.bbc.com/">www.bbc.com</a>
                    </div>

                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
                </div>
            </div>
            <div class="col-md-12 pc-description-block ">
                <span>
                    The website for the U.K.-based British Broadcasting Corp., the world’s largest public news broadcaster. Its international news coverage is published in more than 40 languages.
                </span>

            </div>

            <div class="border-bottom pc-more-details">
                <a href="#">see more details » </a>
            </div>

            <div class="pc-review-criterias">
                <div class="review-criterias">
                    <ul class="criteria-columns">
                        <div class="criteria-first-column">
                            <h3>Cine sunt?</h3>
                            <li>
                                <img src="{{asset('styles/images/Group 289.svg')}}">
                                <span class="review-criteria">
                                            Site-ul publică date cu privire la locația redacției
                                        </span>
                            </li>
                            <li>

                                <img src="{{asset('styles/images/Group 289.svg')}}">
                                <span class="review-criteria">
                                            Site-ul publică numele reporterilor, editorilor
                                        </span>
                            </li>
                            <li>
                                <img src="{{asset('styles/images/Group 289.svg')}}">
                                <span class="review-criteria">
                                            Site-ul publică numele proprietarilor și beneficiarilor finali
                                        </span>
                            </li>
                            <li>
                                <img src="{{asset('styles/images/Group 289.svg')}}">
                                <span class="review-criteria">
                                            Site-ul nu este afiliat unor persoane sau entități politice
                                        </span>
                            </li>

                            <li>
                                <img src="{{asset('styles/images/Group 289.svg')}}">
                                <span class="review-criteria">
                                            Site-ul face publice datele despre finanțări și finanțatori
                                        </span>
                            </li>
                        </div>
                        <div class="criteria-second-column">
                            <h3>Ce reprezinta?</h3>
                            <li>
                                <img src="{{asset('styles/images/Group 289.svg')}}">
                                <span class="review-criteria">
                                            Site-ul publică conținut propriu în mare măsură
                                        </span>
                            </li>
                            <li>
                                <img src="{{asset('styles/images/Group 289.svg')}}">
                                <span class="review-criteria">
                                            Site-ul nu publică știri false, corectează falsurile
                                        </span>
                            </li>
                            <li>
                                <img src="{{asset('styles/images/Group 345.svg')}}">
                                <span class="review-criteria">
                                            Site-ul citează corect sursele, când preia conținutul altor media
                                        </span>
                            </li>
                            <li>
                                <img src="{{asset('styles/images/Group 289.svg')}}">
                                <span class="review-criteria">
                                            Site-ul separă faptele de opinii
                                        </span>
                            </li>
                            <li>
                                <img src="{{asset('styles/images/Group 289.svg')}}">
                                <span class="review-criteria">
                                            Site-ul evită senzaționalizarea titlurilor, imagini
                                        </span>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>


    </article>
</section>

</body>

<script>
    const modalService = () => {
        const d = document;
        const body = d.querySelector('body');
        const buttons = d.querySelectorAll('[data-modal-trigger]');

        // attach click event to all modal triggers
        for(let button of buttons) {
            triggerEvent(button);
        }

        function triggerEvent(button) {
            button.addEventListener('click', () => {
                const trigger = button.getAttribute('data-modal-trigger');
                const modal = d.querySelector(`[data-modal=${trigger}]`);
                const modalBody = modal.querySelector('.modal-body');
                // const closeBtn = modal.querySelector('.close');

                // closeBtn.addEventListener('click', () => modal.classList.remove('is-open'))
                modal.addEventListener('click', () => modal.classList.remove('is-open'));

                modalBody.addEventListener('click', (e) => e.stopPropagation());

                modal.classList.toggle('is-open');

                // Close modal when hitting escape
                body.addEventListener('keydown', (e) => {
                    if(e.keyCode === 27) {
                        modal.classList.remove('is-open')
                    }
                });
            });
        }
    };

    modalService();
</script>



</body>
</html>
