<div class="bg">
    <div style="text-align: center; margin-bottom: 80px;">
        <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M22 10C22 15.3158 17.0748 19.625 11 19.625C9.91052 19.6265 8.82556 19.485 7.77287 19.2043C6.96987 19.6112 5.126 20.3923 2.024 20.901C1.749 20.945 1.54 20.659 1.64863 20.4032C2.13538 19.2537 2.57538 17.722 2.70738 16.325C1.023 14.6338 0 12.42 0 10C0 4.68425 4.92525 0.375 11 0.375C17.0748 0.375 22 4.68425 22 10ZM9.89175 8.30325C9.80112 8.16798 9.6965 8.04262 9.57963 7.92925C9.39586 7.74001 9.17677 7.58866 8.93475 7.48375L8.92375 7.47825C8.59811 7.32705 8.24327 7.24914 7.88425 7.25C6.567 7.25 5.5 8.27575 5.5 9.54212C5.5 10.8071 6.567 11.8329 7.88425 11.8329C8.35588 11.8329 8.7945 11.7022 9.16438 11.4754C8.976 12.0103 8.62813 12.5809 8.05062 13.1529C7.99623 13.206 7.95328 13.2696 7.92442 13.34C7.89556 13.4103 7.8814 13.4858 7.88281 13.5618C7.88423 13.6378 7.90119 13.7127 7.93265 13.7819C7.96412 13.8511 8.00941 13.9131 8.06575 13.9641C8.30363 14.1841 8.68038 14.1772 8.91 13.9504C10.7443 12.123 10.7937 10.1581 10.2039 8.85462C10.1172 8.66195 10.0127 8.47781 9.89175 8.30463V8.30325ZM15.125 11.4754C14.938 12.0103 14.5887 12.5809 14.0112 13.1529C13.9569 13.2061 13.9141 13.2698 13.8853 13.3402C13.8566 13.4106 13.8426 13.4861 13.8441 13.5621C13.8457 13.6381 13.8628 13.7129 13.8943 13.7821C13.9259 13.8512 13.9713 13.9132 14.0278 13.9641C14.2642 14.1841 14.641 14.1772 14.8706 13.9504C16.7049 12.123 16.7544 10.1581 16.1659 8.85462C16.0788 8.66192 15.9738 8.47778 15.8524 8.30463C15.7618 8.16886 15.6572 8.04304 15.5402 7.92925C15.3565 7.73999 15.1374 7.58863 14.8954 7.48375L14.8844 7.47825C14.5592 7.32725 14.2048 7.24934 13.8462 7.25C12.5304 7.25 11.462 8.27575 11.462 9.54212C11.462 10.8071 12.5304 11.8329 13.8462 11.8329C14.3179 11.8329 14.7565 11.7022 15.1264 11.4754H15.125Z"
                fill="#D9D9D9" />
        </svg>
        <h2 style="color:#DDCCAA">MOVIE QUOTES</h2>
    </div>
    <div class="texts main-container">
        <h2 class="spacing">Hola {{$user->name}}</h2>
        <h2 class="spacing">Thanks for joining Movie quotes! We really appreciate it. Please click the button below to verify your
            account:</h2>
        <a href="#" class="button spacing">Verify account</a>
        <h2 class="spacing">If clicking doesn't work, you can try copying and pasting it to your browser:</h2>
        <div style="width: 1300px;" class="spacing"> 
        <a href="#" class="link">
                <p >https://moviequotes/verify?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdHYiOjIsImp0aSI6ImRkNTVkMTM1LTFhMGEtNDBjNi04NDQ5LThmZjdkZGFlNDc3MyIsImVtYWlsVmVyaWZpZWQiOmZhbHNlLCJpYXQiOjE2MDE2NzIxMIyYjk2NDNhNjdjNjU1NmQ5MSJ9.ok1qXOM-RY9_x2_xKjDj2aK6NG9w9xAMcDpchUnbn4c
                </p>
            </a></div>
        <h2 class="spacing">If you have any problems, please contact us: support@moviequotes.ge</h2>
        <h2>MovieQuotes Crew</h2>
    </div>
</div>

<style>
    .bg {
        margin: 0;
        padding-top: 80px;
        background-color: #181623;
        height: 100%;
    }

    .texts {
        color: white;
    }

    .main-container {
        width: 1300px;
        margin-left: 200px;
    }
    .link {

    word-wrap: break-word;
  }
  .button{
    background-color: red;
    border-radius: 4px;
    padding: 8px;
    text-decoration: none;
    color: #fff;
  }
  .spacing{
    margin-bottom: 40px;
  }
  </style>
