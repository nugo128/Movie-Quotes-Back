<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
    <style>
        body {
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .bg {
            padding-top: 40px;
            background-color: #181623;
        }

        .texts {
            color: #fff;
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo img {
            width: 50px;
            height: 50px;
        }

        h2 {
            color: #DDCCAA;
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .spacing {
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background-color: red;
            border-radius: 4px;
            padding: 8px 16px;
            text-decoration: none;
            color: #fff;
        }

        .link {
            word-wrap: break-word;
            color: #fff;
            margin-bottom: 0;
        }

        .support {
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="bg">
        <div class="texts">
            <div class="logo">
                <img src="https://i.ibb.co/tcT7SHJ/mail.png" alt="mail">
                <h2>MOVIE QUOTES</h2>
            </div>
            <h2 class="spacing">Hola {{$user->name}}</h2>
            <h2 class="spacing">Thanks for joining Movie quotes! We really appreciate it. Please click the button below to reset your password:</h2>
            <a href="{{env('FRONTEND_URL')}}/reset?token={{$user->reset_token}}" class="button spacing">reset password</a>
            <h2 class="spacing">If clicking doesn't work, you can try copying and pasting the following URL into your browser:</h2>
            <div class="spacing">
               
                    <p class="link">{{env('FRONTEND_URL')}}/reset?token={{$user->reset_token}}</p>
                
            </div>
            <h2 class="spacing">If you have any problems, please contact us: support@moviequotes.ge</h2>
            <h2 class="spacing">MovieQuotes Crew</h2>
            <p class="support">MovieQuotes support</p>
        </div>
    </div>
</body>
</html>
