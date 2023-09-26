<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/base.css">
</head>

<body>
    <style>
        .mobileNav {
            display: none;
        }

        @media only screen and (max-width: 1250px) {
            .mobileNav {
                width: 100%;
                padding-block: 15px;
                background-color: #fff;
                display: flex;
                justify-content: space-between;
                position: fixed;
                bottom: 10px;
                box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
                z-index: 45;
                padding: 0 5%;
                border-radius: 50px;
            }

            .mobileOne {
                height: 50px;
                width: 50px;

                background-color: #000;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border: 2px solid;
                color: #fff;
                cursor: pointer;
                margin-block: 25px;

            }

            .mobileOne:hover {
                box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            }

            .mobileOne p {
                font-size: 10px;
            }
        }
    </style>
    <div class="mobileNav">
        <div class="mobileOne">
            <h4><i class="fas fa-home"></i></h4>
            <p>Home</p>
        </div>
        <div class="mobileOne">
            <h4><i class="fas fa-info-circle"></i></h4>
            <p>About</p>
        </div>
        <div class="mobileOne">
            <h4><i class="fas fa-donate"></i></h4>
            <p>Donate</p>
        </div>
        <div class="mobileOne">
            <h4><i class="fas fa-sign-out-alt"></i></h4>
            <p>Logout</p>
        </div>
    </div>
</body>

</html>