<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Vensemart Vendor">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Login | vensemart</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('nk5/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('nk5/assets/css/theme.css?ver=2.9.1') }}">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    
    
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<style>#google_translate_element,.skiptranslate{display:none;}body{top:0!important;}</style>
<div id="google_translate_element"></div>
<script>

const userLocale =
  navigator.languages && navigator.languages.length
    ? navigator.languages[0]
    : navigator.language;

console.log(userLocale); // 👉️ "en-US"

// 👇️ ["en-US", "en", "de"]
console.log(navigator.languages);




if (userLocale.includes('en')) {
  var included = 'en'

} else if (userLocale.includes('fr')) {
  var included = 'fr'
} else if (userLocale.includes('es')) {
  var included = 'es'
} else if (userLocale.includes('it')) {
  var included = 'it'
} else if (userLocale.includes('pt')) {
  var included = 'pt'
} else if (userLocale.includes('de')) {
  var included = 'de'
}else if (userLocale.includes('ar')) {
  var included = 'ar'
}else if (userLocale.includes('id')) {
  var included = 'id'
}else if (userLocale.includes('sl')) {
  var included = 'sl'
} else {
 var included = 'en'
}


$.ajax({ 
    url: "http://ajaxhttpheaders.appspot.com", 
    dataType: 'jsonp', 
    success: function(headers) {
        language = headers['Accept-Language'];
        alert(headers['Accept-Language']);
        if (language.includes('en')) {
  var included = 'fr'

} else if (language.includes('fr')) {
  var included = 'fr'
} else if (language.includes('es')) {
  var included = 'es'
} else if (language.includes('it')) {
  var included = 'it'
} else if (language.includes('pt')) {
  var included = 'pt'
} else if (language.includes('de')) {
  var included = 'de'
}else if (language.includes('ar')) {
  var included = 'ar'
}else if (language.includes('id')) {
  var included = 'id'
}else if (language.includes('sl')) {
  var included = 'sl'
} else {
 var included = 'en'
}
        function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en', 
            includedLanguages: included, 
            autoDisplay: false
        }, 'google_translate_element');
        var a = document.querySelector("#google_translate_element select");
        a.selectedIndex=1;
        a.dispatchEvent(new Event('change'));
    }
    
   
    }
});


    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en', 
            includedLanguages: included, 
            autoDisplay: false
        }, 'google_translate_element');
        var a = document.querySelector("#google_translate_element select");
        a.selectedIndex=1;
        a.dispatchEvent(new Event('change'));
    }
    
   
    

</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

   
   <style>
       a.dropdown-toggle.dropdown-indicator.has-indicator.nav-link{
           visibility:hidden;
       }
   </style>
   
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="https://vensemart.com" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="https://vensemart.com/assets/images/logo.png" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="https://vensemart.com/assets/images/logo.png" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Sign-In</h4>
                                        <div class="nk-block-des">
                                            <p>Access the vensemart panel using your email and passcode.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                   @if($errors->any())
    <div class="alert alert-danger">
        <p><strong>Opps Something went wrong</strong></p>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
@endif
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email or Username</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" name="email" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address or username">
                                        </div>
                             @error('email')
            @csrf
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
                                    </div>
                                    <div class="form-group">
                                         @csrf
                                        <div class="form-label-group">
                                             @csrf
                                            <label class="form-label" for="password">Passcode</label>
                                            
                @if (Route::has('password.request'))
              
                @csrf
                <a class="link link-primary link-sm" href="password/reset/">Forgot passcode?</a>
               @csrf
              @endif
                                            
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your passcode">
                                        </div>

                                        @error('password')
            @csrf
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"> New on our platform? <a href="register">Create an account</a>
                                </div>
                                <!--<div class="text-center pt-4 pb-3">-->
                                <!--    <h6 class="overline-title overline-title-sap"><span>OR</span></h6>-->
                                <!--</div>-->
                                <!--<ul class="nav justify-center gx-4">-->
                                <!--    <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>-->
                                <!--    <li class="nav-item"><a class="nav-link" href="#">Google</a></li>-->
                                <!--</ul>-->
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Help</a>
                                        </li>
                                        <li class="nav-item dropup">
                                            <a class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-toggle="dropdown" data-offset="0,10"><span>English</span></a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/english.png" alt="" class="language-flag">
                                                            <span class="language-name">English</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/spanish.png" alt="" class="language-flag">
                                                            <span class="language-name">Español</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/french.png" alt="" class="language-flag">
                                                            <span class="language-name">Français</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/turkey.png" alt="" class="language-flag">
                                                            <span class="language-name">Türkçe</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; 2022 vensemart. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('nk5/assets/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('nk5/assets/js/scripts.js?ver=2.9.1') }}"></script>
  
    
    <!-- <script src="//code.tidio.co/asmwujszbggxibmhytylweozfqgv5ywe.js" async></script> -->
    <!--<script type="text/javascript">-->
    <!--    (function () {-->
    <!--        var options = {-->
                <!--whatsapp: "+1(417)393-8105", // WhatsApp number-->
                <!--call_to_action: "Message us", // Call to action-->
                <!--position: "left", // Position may be 'right' or 'left'-->
    <!--        };-->
    <!--        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;-->
    <!--        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';-->
    <!--        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };-->
    <!--        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);-->
    <!--    })();-->
    <!--</script>-->
    
    <style>
        .sc-1au8ryl-0 {
            visibility:hidden;
        }
    </style>

</html>