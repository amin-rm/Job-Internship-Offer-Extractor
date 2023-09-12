function generateCaptcha() {
    var captcha = "";
    var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  
    for (var i = 0; i < 6; i++) {
      captcha += characters.charAt(Math.floor(Math.random() * characters.length));
    }
  
    return captcha;
  }
  
  function initializeCaptcha() {

    var captchaImage = document.getElementById("captcha-image");
    var captchaInput = document.getElementById("captcha-input");
    var captchaSubmit = document.getElementById("captcha-submit");
    var captchaStatus = document.getElementById("captcha-status");
  
    var captchaCode = generateCaptcha();
    captchaImage.textContent = captchaCode;

    captchaSubmit.addEventListener("click", function() {
      if (captchaInput.value.toLowerCase() === captchaCode.toLowerCase()) {
        document.location.href="login.html";
      } else {
        captchaStatus.textContent = "Code captcha incorrect. Veuillez réessayer.";
        captchaStatus.style.color = "red";
  
        captchaCode = generateCaptcha();
        captchaImage.textContent = captchaCode;
      }
    });
  }
  
  window.addEventListener("load", initializeCaptcha);
  