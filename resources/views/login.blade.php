 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

     <style>
         @import url('https://fonts.googleapis.com/css?family=Montserrat|Quicksand');

         * {
             font-family: 'quicksand', Arial, Helvetica, sans-serif;
             box-sizing: border-box;
         }

         body {
             background: #fff;
         }

         .form-modal {
             position: relative;
             width: 450px;
             height: auto;
             margin-top: 4em;
             left: 50%;
             transform: translateX(-50%);
             background: #fff;
             border-top-right-radius: 20px;
             border-top-left-radius: 20px;
             border-bottom-right-radius: 20px;
             box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1)
         }

         .form-modal button {
             cursor: pointer;
             position: relative;
             text-transform: capitalize;
             font-size: 1em;
             z-index: 2;
             outline: none;
             background: #fff;
             transition: 0.2s;
         }

         .form-modal .btn {
             border-radius: 20px;
             border: none;
             font-weight: bold;
             font-size: 1.2em;
             padding: 0.8em 1em 0.8em 1em !important;
             transition: 0.5s;
             border: 1px solid #ebebeb;
             margin-bottom: 0.5em;
             margin-top: 0.5em;
         }

         .form-modal .login,
         .form-modal .signup {
             background: #57b846;
             color: #fff;
         }

         .form-modal .login:hover,
         .form-modal .signup:hover {
             background: #222;
         }

         .form-toggle {
             position: relative;
             width: 100%;
             height: auto;
         }

         .form-toggle button {
             width: 50%;
             float: left;
             padding: 1.5em;
             margin-bottom: 1.5em;
             border: none;
             transition: 0.2s;
             font-size: 1.1em;
             font-weight: bold;
             border-top-right-radius: 20px;
             border-top-left-radius: 20px;
         }

         .form-toggle button:nth-child(1) {
             border-bottom-right-radius: 20px;
         }

         .form-toggle button:nth-child(2) {
             border-bottom-left-radius: 20px;
         }

         #login-toggle {
             background: #57b846;
             color: #ffff;
         }

         .form-modal form {
             position: relative;
             width: 90%;
             height: auto;
             left: 50%;
             transform: translateX(-50%);
         }

         #login-form,
         #signup-form {
             position: relative;
             width: 100%;
             height: auto;
             padding-bottom: 1em;
         }

         #signup-form {
             display: none;
         }


         #login-form button,
         #signup-form button {
             width: 100%;
             margin-top: 0.5em;
             padding: 0.6em;
         }

         .form-modal input {
             position: relative;
             width: 100%;
             font-size: 1em;
             padding: 1.2em 1.7em 1.2em 1.7em;
             margin-top: 0.6em;
             margin-bottom: 0.6em;
             border-radius: 20px;
             border: none;
             background: #ebebeb;
             outline: none;
             font-weight: bold;
             transition: 0.4s;
         }

         .form-modal input:focus,
         .form-modal input:active {
             transform: scaleX(1.02);
         }

         .form-modal input::-webkit-input-placeholder {
             color: #222;
         }


         .form-modal p {
             font-size: 16px;
             font-weight: bold;
         }

         .form-modal p a {
             color: #57b846;
             text-decoration: none;
             transition: 0.2s;
         }

         .form-modal p a:hover {
             color: #222;
         }


         .form-modal i {
             position: absolute;
             left: 10%;
             top: 50%;
             transform: translateX(-10%) translateY(-50%);
         }

         .fa-google {
             color: #dd4b39;
         }

         .fa-linkedin {
             color: #3b5998;
         }

         .fa-windows {
             color: #0072c6;
         }

         .-box-sd-effect:hover {
             box-shadow: 0 4px 8px hsla(210, 2%, 84%, .2);
         }

         @media only screen and (max-width:500px) {
             .form-modal {
                 width: 100%;
             }
         }

         @media only screen and (max-width:400px) {
             i {
                 display: none !important;
             }

         }

         .error-message {
             position: fixed;
             top: 20px;
             right: 20px;
             background-color: red;
             color: white;
             padding: 10px;
             border-radius: 5px;
             z-index: 9999;
         }
     </style>
 </head>

 <body>

     @if($errors->any())
     <div id="error-message" class="error-message">
         {{ $errors->first('message') }}
     </div>
     @endif 

    

     <div class="form-modal">

         <div class="form-toggle">
             <button id="login-toggle" onclick="toggleLogin()">log in</button>
             <button id="signup-toggle" onclick="toggleSignup()">sign up</button>
         </div>

         <div id="login-form">
             <form action="{{ route('login') }}" method="POST">
                 @csrf
                 @method('POST')
                 <!-- <label for="identifier">Mobile Number or Email:</label> -->
                 <label for="identifier">Mobile Number or Email:</label>
                 <input type="text" id="identifier" name="identifier" required placeholder="Enter mobile or email">

                 <div id="otp-section" style="display: none;">
                     <label for="otp">OTP:</label>
                     <input type="text" id="otp" name="otp" placeholder="Enter OTP">
                     <button type="button" class="btn" id="sendOTP">Send OTP</button>
                 </div>

                 <div id="password-section" style="display: none;">
                     <label for="password">Password:</label>
                     <input type="password" id="password" name="password" placeholder="Enter Password">
                 </div>

                 <!-- <div>
        <label for="login_type">Login Type:</label>
        <select id="login_type" name="login_type" required>
            <option value="password">Password</option>
            <option value="otp">OTP</option>
        </select>
    </div> -->


                 <button type="submit" class="btn login" value="Log In"> Login</button>
                 <!-- <input type="text" placeholder="Enter email or mobile"/>
            <input type="password" placeholder="Enter password"/>
            <button type="button" class="btn login">login</button> -->
                 <!-- <p><a href="javascript:void(0)">Forgotten account</a></p> -->

             </form>
         </div>

         <div id="signup-form">
             <form action="{{ route('signup') }}" method="POST">
                 @csrf
                 @method('POST')
                 <input type="text" name="name" placeholder="Enter your name" />
                 <input type="email" name="email" placeholder="Enter your email" />
                 <input type="text" name="mobile" placeholder="Enter your mobile number" />
                 <input type="password" name="password" placeholder="Create password" />
                 <button type="submit" class="btn signup">create account</button>

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


     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     {{-- toastr js --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>


     <script>
         // Get the necessary elements
         const identifierInput = document.getElementById('identifier');
         const otpSection = document.getElementById('otp-section');
         const otpInput = document.getElementById('otp');
         const sendOTPButton = document.getElementById('sendOTP');
         const passwordSection = document.getElementById('password-section');

         // Event listener for identifier input change
         identifierInput.addEventListener('input', function() {
             const identifierValue = identifierInput.value.trim();

             // Check if the identifier is a mobile number
             const isValidMobileNumber = /^\d{10}$/.test(identifierValue);

             // Show/hide the appropriate sections based on the identifier type
             if (isValidMobileNumber) {
                 otpSection.style.display = 'block';
                 passwordSection.style.display = 'none';
             } else {
                 otpSection.style.display = 'none';
                 passwordSection.style.display = 'block';
             }
         });

         // Event listener for send OTP button click
         sendOTPButton.addEventListener('click', function() {
             const identifierValue = identifierInput.value.trim();

             // Perform AJAX request to send the OTP to the user's mobile number
             // You need to implement this part using your preferred AJAX method

             $.ajax({
                 url: '{{url("/send-otp")}}', // Replace with your server-side endpoint URL
                 method: 'POST',
                 headers: {
                     'X-CSRF-Token': '{{ csrf_token() }}',
                 },
                 data: {
                     identifier: identifierValue
                 },
                 success: function(response) {
                     // Handle the success response (e.g., show success message)
                     console.log('OTP sent successfully');
                 },
                 error: function(xhr, status, error) {
                     // Handle the error response (e.g., show error message)
                     console.log('Error sending OTP:', error);
                 }
             });


             // Assuming the OTP is sent successfully, show the OTP input field
             otpInput.style.display = 'block';
         });
        
  
        //   document.addEventListener('DOMContentLoaded', function() {
              //  Your code here


              //   Show error message
        //       function showError(message, duration) {
        //           // Display the error message in your desired element
        //           //   const errorMessage = "This is an error message.";

        //           const errorElement = document.getElementById('error-message');
        //           errorElement.textContent = message;
        //           // console.log(textContent);
        //           // Show the error message element
        //           errorElement.style.display = 'block';

        //           // Refresh the page after the specified duration
        //           setTimeout(function() {
        //               // Hide the error message
        //               errorElement.style.display = 'none';
        //               location.reload();
        //           }, duration);
        //       }

        //       // Usage
        //       const errorMessage = ;
        //     //   errorMessage.textContent = message;
        //       const duration = 1000;
        //       showError(message, duration);
        //       //    showError('An error occurred. Please try again later.', 3000); 
        //       //  Show error message
        //   });
     </script>
     

     <script>
         // document.getElementById('identifier').addEventListener('input', function() {
         //   var identifier = this.value;
         //   var otpSection = document.getElementById('otp-section');
         //   var passwordSection = document.getElementById('password-section');

         //   if (isValidMobileNumber(identifier)) {
         //     otpSection.style.display = 'block';
         //     passwordSection.style.display = 'none';

         //   } else if (isValidEmail(identifier)) {
         //     otpSection.style.display = 'none';
         //     passwordSection.style.display = 'block';
         //   } else {
         //     otpSection.style.display = 'none';
         //     passwordSection.style.display = 'none';
         //   }
         // });

         // function isValidMobileNumber(identifier) {
         //   // Implement your validation logic for mobile number
         //   // Return true if valid, false otherwise
         //    // Remove any non-digit characters from the mobile number
         //    var pattern = /^\d{10}$/; // Matches a 10-digit number
         //   return pattern.test(identifier);

         // }

         // function isValidEmail(identifier) {
         //   // Implement your validation logic for email address
         //   // Return true if valid, false otherwise

         //   var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
         //   return pattern.test(identifier);
         // }


         function toggleSignup() {
             document.getElementById("login-toggle").style.backgroundColor = "#fff";
             document.getElementById("login-toggle").style.color = "#222";
             document.getElementById("signup-toggle").style.backgroundColor = "#57b846";
             document.getElementById("signup-toggle").style.color = "#fff";
             document.getElementById("login-form").style.display = "none";
             document.getElementById("signup-form").style.display = "block";
         }

         function toggleLogin() {
             document.getElementById("login-toggle").style.backgroundColor = "#57B846";
             document.getElementById("login-toggle").style.color = "#fff";
             document.getElementById("signup-toggle").style.backgroundColor = "#fff";
             document.getElementById("signup-toggle").style.color = "#222";
             document.getElementById("signup-form").style.display = "none";
             document.getElementById("login-form").style.display = "block";
         }
     </script>
 </body>

 </html>