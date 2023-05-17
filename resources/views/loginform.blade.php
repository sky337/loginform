 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      @import url('https://fonts.googleapis.com/css?family=Montserrat|Quicksand');

*{
    font-family: 'quicksand',Arial, Helvetica, sans-serif;
    box-sizing: border-box;
}

body{
    background:#fff;
}

.form-modal{
    position:relative;
    width:450px;
    height:auto;
    margin-top:4em;
    left:50%;
    transform:translateX(-50%);
    background:#fff;
    border-top-right-radius: 20px;
    border-top-left-radius: 20px;
    border-bottom-right-radius: 20px;
    box-shadow:0 3px 20px 0px rgba(0, 0, 0, 0.1)
}

.form-modal button{
    cursor: pointer;
    position: relative;
    text-transform: capitalize;
    font-size:1em;
    z-index: 2;
    outline: none;
    background:#fff;
    transition:0.2s;
}

.form-modal .btn{
    border-radius: 20px;
    border:none;
    font-weight: bold;
    font-size:1.2em;
    padding:0.8em 1em 0.8em 1em!important;
    transition:0.5s;
    border:1px solid #ebebeb;
    margin-bottom:0.5em;
    margin-top:0.5em;
}

.form-modal .login , .form-modal .signup{
    background:#57b846;
    color:#fff;
}

.form-modal .login:hover , .form-modal .signup:hover{
    background:#222;
}

.form-toggle{
    position: relative;
    width:100%;
    height:auto;
}

.form-toggle button{
    width:50%;
    float:left;
    padding:1.5em;
    margin-bottom:1.5em;
    border:none;
    transition: 0.2s;
    font-size:1.1em;
    font-weight: bold;
    border-top-right-radius: 20px;
    border-top-left-radius: 20px;
}

.form-toggle button:nth-child(1){
    border-bottom-right-radius: 20px;
}

.form-toggle button:nth-child(2){
    border-bottom-left-radius: 20px;
}

#login-toggle{
    background:#57b846;
    color:#ffff;
}

.form-modal form{
    position: relative;
    width:90%;
    height:auto;
    left:50%;
    transform:translateX(-50%);  
}

#login-form , #signup-form{
    position:relative;
    width:100%;
    height:auto;
    padding-bottom:1em;
}

#signup-form{
    display: none;
}


#login-form button , #signup-form button{
    width:100%;
    margin-top:0.5em;
    padding:0.6em;
}

.form-modal input{
    position: relative;
    width:100%;
    font-size:1em;
    padding:1.2em 1.7em 1.2em 1.7em;
    margin-top:0.6em;
    margin-bottom:0.6em;
    border-radius: 20px;
    border:none;
    background:#ebebeb;
    outline:none;
    font-weight: bold;
    transition:0.4s;
}

.form-modal input:focus , .form-modal input:active{
    transform:scaleX(1.02);
}

.form-modal input::-webkit-input-placeholder{
    color:#222;
}


.form-modal p{
    font-size:16px;
    font-weight: bold;
}

.form-modal p a{
    color:#57b846;
    text-decoration: none;
    transition:0.2s;
}

.form-modal p a:hover{
    color:#222;
}


.form-modal i {
    position: absolute;
    left:10%;
    top:50%;
    transform:translateX(-10%) translateY(-50%); 
}

.fa-google{
    color:#dd4b39;
}

.fa-linkedin{
    color:#3b5998;
}

.fa-windows{
    color:#0072c6;
}

.-box-sd-effect:hover{
    box-shadow: 0 4px 8px hsla(210,2%,84%,.2);
}

@media only screen and (max-width:500px){
    .form-modal{
        width:100%;
    }
}

@media only screen and (max-width:400px){
    i{
        display: none!important;
    }
}
    </style>
 </head>
 <body>
 <div class="form-modal">
    
    <div class="form-toggle">
        <button id="login-toggle" onclick="toggleLogin()">log in</button>
        <button id="signup-toggle" onclick="toggleSignup()">sign up</button>
    </div>

    <div id="login-form">
        <form action="{{ route('loginform') }}"  method="POST">
                @csrf
            @method('POST')
            <!-- <label for="identifier">Mobile Number or Email:</label> -->
            <label for="identifier">Mobile Number or Email:</label>
                <input type="text" id="identifier" name="identifier" required placeholder="Enter mobile or email">

                <div id="otp-section" style="display: none;">
                  <label for="otp">OTP:</label>
                  <input type="text" id="otp" name="otp" required placeholder="Enter OTP">
                </div>

                <div id="password-section" style="display: none;">
                  <label for="password">Password:</label>
                  <input type="password" id="password" name="password" required placeholder="Enter Password">
                </div>

                <input type="submit" class="btn login" value="Log In">
            <!-- <input type="text" placeholder="Enter email or mobile"/>
            <input type="password" placeholder="Enter password"/>
            <button type="button" class="btn login">login</button> -->
            <!-- <p><a href="javascript:void(0)">Forgotten account</a></p> -->
            
        </form>
    </div>

    <div id="signup-form">
        <form>
            <input type="text" placeholder="Enter your name"/>
            <input type="email" placeholder="Enter your email"/>
            <input type="text" placeholder="Enter your mobile number"/>
            <input type="password" placeholder="Create password"/>
            <button type="button" class="btn signup">create account</button>
            
        </form>
    </div>

</div>


 {{--<form action="{{ route('loginform') }}" method="POST">
    @csrf
    @method('POST')
  <label for="identifier">Mobile Number or Email:</label>
  <input type="text" id="identifier" name="identifier" required>

  <div id="otp-section" style="display: none;">
    <label for="otp">OTP:</label>
    <input type="text" id="otp" name="otp" required>
  </div>

  <div id="password-section" style="display: none;">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
  </div>

  <input type="submit" value="Log In">
</form> --}}



<script>
document.getElementById('identifier').addEventListener('input', function() {
  var identifier = this.value;
  var otpSection = document.getElementById('otp-section');
  var passwordSection = document.getElementById('password-section');

  if (isValidMobileNumber(identifier)) {
    otpSection.style.display = 'block';
    passwordSection.style.display = 'none';

  } else if (isValidEmail(identifier)) {
    otpSection.style.display = 'none';
    passwordSection.style.display = 'block';
  } else {
    otpSection.style.display = 'none';
    passwordSection.style.display = 'none';
  }
});

function isValidMobileNumber(identifier) {
  // Implement your validation logic for mobile number
  // Return true if valid, false otherwise
   // Remove any non-digit characters from the mobile number
   var pattern = /^\d{10}$/; // Matches a 10-digit number
  return pattern.test(identifier);

}

function isValidEmail(identifier) {
  // Implement your validation logic for email address
  // Return true if valid, false otherwise

  var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return pattern.test(identifier);
}


function toggleSignup(){
   document.getElementById("login-toggle").style.backgroundColor="#fff";
    document.getElementById("login-toggle").style.color="#222";
    document.getElementById("signup-toggle").style.backgroundColor="#57b846";
    document.getElementById("signup-toggle").style.color="#fff";
    document.getElementById("login-form").style.display="none";
    document.getElementById("signup-form").style.display="block";
}

function toggleLogin(){
    document.getElementById("login-toggle").style.backgroundColor="#57B846";
    document.getElementById("login-toggle").style.color="#fff";
    document.getElementById("signup-toggle").style.backgroundColor="#fff";
    document.getElementById("signup-toggle").style.color="#222";
    document.getElementById("signup-form").style.display="none";
    document.getElementById("login-form").style.display="block";
}
</script>
 </body>
 </html>