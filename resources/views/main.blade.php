<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Url Shortener</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://kit.fontawesome.com/1bbdeb312a.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <h1 class="title">
            Url Shortener
        </h1>
    </header>
    <div class="content">
        <div class="form-wrapper">
            <form action="api/urls" method="post" id="url-form">
                <h1 class="form-title">Get your url</h1>
                <div class="inp-wrapper">
                    <input type="url" name="original_url" id="original-url" required>
                </div>
                <div class="btn-wrapper">
                    <button type="button" id="submit-btn">Submit</button>
                </div>
            </form>
        </div>
        <div class="hide" id="hide-form">
            <h2>
                Copy your result!
            </h2>
            <div class="response-wrapper">
                <div id="copy-alert">Copied</div>
                <div class="url-response" id="url-response"></div>
                <p class="ico-wrapper" id="ico-wrapper">
                    <i class="fas fa-clipboard" id="ico-btn"></i>
                </p>
            </div>
        </div>
    </div>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>