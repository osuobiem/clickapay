// Process Login
$('#loginForm').submit(function (e) {
  e.preventDefault()
  e.target.setAttribute('style', 'padding: 5px; opacity: 0.3')

  $('#loginButton').attr('disabled', '')

  $('#loginError').attr('style', 'display: none;')
  $('#loginLoader').attr('style', 'display: block; position: fixed;')

  let data = {
    _token: $('#_ta4ka2na').val(),
    emailPhone: $('#email-phone').val(),
    password: $('#lpassword').val(),
    remember: $('#rememberMe').val()
  }

  $.ajax({
    method: 'POST',
    url: $('#5rala').val() + 'api/login',
    data: data,

    success: res => {
      res = JSON.parse(res)
      if (res.status === false) {
        $('#loginError').attr('style', 'display: block;')
        $('#loginError').html(res.message)

        e.target.setAttribute('style', 'padding: 5px;')

        $('#loginButton').removeAttr('disabled')
        $('#loginLoader').attr('style', 'display: none;')
      } else {
        $('#account')[0].click()
      }
    },
    error: error => {
      $('#loginError').attr('style', 'display: block;')
      $('#loginError').html(
        '<strong>Oops!</strong> Something went wrong. Please try again'
      )

      e.target.setAttribute('style', 'padding: 5px;')

      $('#loginButton').removeAttr('disabled')
      $('#loginLoader').attr('style', 'display: none;')
      console.log(error)
    }
  })
})

// Manipulate Password
$('#showPass').click(function (e) {
  e.preventDefault()

  let pass_eye = $('#passEye').attr('class')
  if (pass_eye === 'fas fa-eye-slash') {
    $('#passEye').attr('class', 'fas fa-eye')
    $('#rpassword').attr('type', 'text')
  } else {
    $('#passEye').attr('class', 'fas fa-eye-slash')
    $('#rpassword').attr('type', 'password')
  }
})

// Process Registration
$('#regForm').submit(function (e) {
  e.preventDefault()
  e.target.setAttribute('style', 'padding: 5px; opacity: 0.3')

  $('#regButton').attr('disabled', '')

  $('#regError').attr('style', 'display: none;')
  $('#regLoader').attr('style', 'display: block; position: fixed;')

  let firstname = $('#fname').val()
  let lastname = $('#lname').val()
  let email = $('#email').val()
  let phone = $('#phone').val()
  let rpassword = $('#rpassword').val()
  let token = $('#_ta4ka2na').val()
  let url = $('#5rala').val() + 'api/register'

  let data = {
    _token: token,
    firstname: firstname,
    lastname: lastname,
    email: email,
    phone: phone,
    password: rpassword
  }

  $.ajax({
    method: 'POST',
    url: url,
    data: data,

    success: res => {
      res = JSON.parse(res)
      if (res.status === false) {
        $('#regError').attr('style', 'display: block;')
        $('#regError').html(res.message)

        e.target.setAttribute('style', 'padding: 5px;')

        $('#regButton').removeAttr('disabled')
        $('#regLoader').attr('style', 'display: none;')
        $('#error').attr('style', 'display: block;')
        $('#error').html('<strong>Error</strong>')
        setInterval(() => {
          $('#error').attr('style', 'display: none;')
        }, 2000)
      } else {
        $('#account')[0].click()
      }
    },
    error: error => {
      console.log(error)
      $('#regError').attr('style', 'display: block;')
      $('#regError').html(
        '<strong>Oops!</strong> Something went wrong. Please try again'
      )

      e.target.setAttribute('style', 'padding: 5px;')

      $('#regButton').removeAttr('disabled')
      $('#regLoader').attr('style', 'display: none;')
      $('#error').attr('style', 'display: block;')
      $('#error').html('<strong>Error</strong>')
      setInterval(() => {
        $('#error').attr('style', 'display: none;')
      }, 2000)
    }
  })
})

// Manipulate Password
$('#showProPass').click(function (e) {
  e.preventDefault()

  let pass_eye = $('#proEye').attr('class')
  if (pass_eye === 'fas fa-eye-slash') {
    $('#proEye').attr('class', 'fas fa-eye')
    $('#pro-password').attr('type', 'text')
  } else {
    $('#proEye').attr('class', 'fas fa-eye-slash')
    $('#pro-password').attr('type', 'password')
  }
})

// Process profile update
$('#proForm').submit(function (e) {
  e.preventDefault()
  e.target.setAttribute('style', 'opacity: 0.3')
  $('#saveButton').attr('disabled', '')

  $('#proError').attr('style', 'display: none;')
  $('#proLoader').attr('style', 'display: block; position: fixed;')

  let firstname = $('#firstname').val()
  let lastname = $('#lastname').val()
  let phone = $('#pro-phone').val()
  let password = $('#pro-password').val()
  let token = $('#_ta4ka2na').val()
  let url = $('#5rala').val() + 'api/update-user'

  let data = {
    _token: token,
    firstname: firstname,
    lastname: lastname,
    phone: phone,
    password: password
  }

  $.ajax({
    method: 'POST',
    url: url,
    data: data,

    success: res => {
      res = JSON.parse(res)
      if (res.status === false) {
        $('#proError').attr('style', 'display: block;')
        $('#proError').html(res.message)

        $('#regButton').removeAttr('disabled')
        $('#pro-email').attr('disabled', '')
        e.target.removeAttribute('style')
        $('#proLoader').attr('style', 'display: none;')

        $('#error').attr('style', 'display: block;')
        $('#error').html('<strong>Error</strong>')
        setInterval(() => {
          $('#error').attr('style', 'display: none;')
        }, 2000)
        $('#saveButton').removeAttr('disabled', '')
      } else {
        $('#message').html('Profile updated successfully')
        $('#message').attr('style', 'display: block;')

        e.target.removeAttribute('style')
        $('#proLoader').attr('style', 'display: none;')

        setInterval(() => {
          $('#message').attr('style', 'display: none;')
        }, 2000)
        $('#saveButton').removeAttr('disabled', '')
      }
    },
    error: error => {
      $('#proError').attr('style', 'display: block;')
      $('#proError').html(
        '<strong>Oops!</strong> Something went wrong. Please try again'
      )

      $('#regButton').removeAttr('disabled')
      e.target.removeAttribute('style')
      $('#proLoader').attr('style', 'display: none;')

      $('#error').attr('style', 'display: block;')
      $('#error').html('<strong>Error</strong>')
      setInterval(() => {
        $('#error').attr('style', 'display: none;')
      }, 2000)
      $('#saveButton').removeAttr('disabled', '')

      console.log(error)
    }
  })
})

// Sidebar Links
function loadView (url) {
  let id = url.split('/')[2]
  let current = $('#current').val()

  if (id !== current) {
    $('#loader').attr('style', 'display: block; position: fixed;')
    $('#main-half').attr('style', 'opacity: 0.3;')

    $.ajax({
      method: 'GET',
      url: url,

      success: res => {
        res = JSON.parse(res)
        if (res.status === false) {
          $('#error').attr('style', 'display: block;')
          $('#error').html(
            '<strong>Oops!</strong> Something went wrong. Please try again'
          )

          setInterval(() => {
            $('#error').attr('style', 'display: none;')
          }, 3000)
          $('#loader').attr('style', 'display: none;')
          $('#main-half').removeAttr('style')
        } else {
          $('#main-half').html(res.content)
          $('#loader').attr('style', 'display: none;')
          $('#main-half').removeAttr('style')
          $('#' + id).attr('class', 'nav-item-active')
          $('#' + current).attr('class', 'nav-item')
          $('#current').attr('value', id)
          showPass()
        }
      },
      error: error => {
        $('#error').attr('style', 'display: block;')
        $('#error').html(
          '<strong>Oops!</strong> Something went wrong. Please try again'
        )

        setInterval(() => {
          $('#error').attr('style', 'display: none;')
        }, 3000)
        $('#loader').attr('style', 'display: none;')
        $('#main-half').removeAttr('style')

        console.log(error)
      }
    })
  }
}

// Manipulate Password
function showPass () {
  $('#showProPass').click(function (e) {
    e.preventDefault()

    let pass_eye = $('#proEye').attr('class')
    if (pass_eye === 'fas fa-eye') {
      $('#proEye').attr('class', 'fas fa-eye')
      $('#pro-password').attr('type', 'text')
    } else {
      $('#proEye').attr('class', 'fas fa-eye-slash')
      $('#pro-password').attr('type', 'password')
    }
  })
}

// Add Bank Account
$('#bankForm').submit(function (e) {
  e.preventDefault()
  e.target.setAttribute('style', 'opacity: 0.3')

  $('#baButton').attr('disabled', '')

  $('#baError').attr('style', 'display: none;')
  $('#baLoader').attr('style', 'display: block; position: fixed;')

  let account_name = $('#baAcct').val()
  let bank = $('#baBank').val()
  let account_number = $('#baNumber').val()
  let token = $('#_ta4ka2na').val()
  let url = $('#5rala').val() + 'api/add-account'

  let data = {
    _token: token,
    account_name: account_name,
    bank: bank,
    account_number: account_number
  }

  $.ajax({
    method: 'POST',
    url: url,
    data: data,

    success: res => {
      res = JSON.parse(res)
      if (res.status === false) {
        $('#baError').attr('style', 'display: block;')
        $('#baError').html(res.message)

        $('#baButton').removeAttr('disabled')

        e.target.removeAttribute('style')
        $('#baLoader').attr('style', 'display: none;')
        $('#error').attr('style', 'display: block;')
        $('#error').html('<strong>Error</strong>')
        setInterval(() => {
          $('#error').attr('style', 'display: none;')
        }, 2000)
      } else {
        $('#message').html('Bank Details Added Successfully')
        $('#message').attr('style', 'display: block;')

        $('#baButton').removeAttr('disabled')
        e.target.removeAttribute('style')
        $('#baLoader').attr('style', 'display: none;')

        setInterval(() => {
          $('#message').attr('style', 'display: none;')
        }, 3000)
      }
    },
    error: error => {
      $('#baError').attr('style', 'display: block;')
      $('#baError').html(
        '<strong>Oops!</strong> Something went wrong. Please try again'
      )

      $('#baButton').removeAttr('disabled')
      e.target.removeAttribute('style')
      $('#baLoader').attr('style', 'display: none;')
      $('#error').attr('style', 'display: block;')
      $('#error').html('<strong>Error</strong>')
      setInterval(() => {
        $('#error').attr('style', 'display: none;')
      }, 2000)

      console.log(error)
    }
  })
})

// Update Bank Account
$('#accForm').submit(function (e) {
  e.preventDefault()
  e.target.setAttribute('style', 'opacity: 0.3')

  $('#baButton').attr('disabled', '')

  $('#baError').attr('style', 'display: none;')
  $('#baLoader').attr('style', 'display: block; position: fixed;')

  let account_name = $('#baAcct').val()
  let bank = $('#baBank').val()
  let account_number = $('#baNumber').val()
  let token = $('#_ta4ka2na').val()
  let url = $('#5rala').val() + 'api/update-account'

  let data = {
    _token: token,
    account_name: account_name,
    bank: bank,
    account_number: account_number
  }

  $.ajax({
    method: 'POST',
    url: url,
    data: data,

    success: res => {
      res = JSON.parse(res)
      if (res.status === false) {
        $('#baError').attr('style', 'display: block;')
        $('#baError').html(res.message)

        $('#baButton').removeAttr('disabled')

        e.target.removeAttribute('style')
        $('#baLoader').attr('style', 'display: none;')
        $('#error').attr('style', 'display: block;')
        $('#error').html('<strong>Error</strong>')
        setInterval(() => {
          $('#error').attr('style', 'display: none;')
        }, 2000)
      } else {
        $('#message').html('Bank Details Updated Successfully')
        $('#message').attr('style', 'display: block;')

        $('#baButton').removeAttr('disabled')
        e.target.removeAttribute('style')
        $('#baLoader').attr('style', 'display: none;')

        setInterval(() => {
          $('#message').attr('style', 'display: none;')
        }, 3000)
      }
    },
    error: error => {
      $('#baError').attr('style', 'display: block;')
      $('#baError').html(
        '<strong>Oops!</strong> Something went wrong. Please try again'
      )

      $('#baButton').removeAttr('disabled')
      e.target.removeAttribute('style')
      $('#baLoader').attr('style', 'display: none;')
      $('#error').attr('style', 'display: block;')
      $('#error').html('<strong>Error</strong>')
      setInterval(() => {
        $('#error').attr('style', 'display: none;')
      }, 2000)

      console.log(error)
    }
  })
})

// Withdrawal Request
$('#withForm').submit(function (e) {
  e.preventDefault()
  e.target.setAttribute('style', 'opacity: 0.3')

  $('#baButton').attr('disabled', '')

  $('#baError').attr('style', 'display: none;')
  $('#baLoader').attr('style', 'display: block; position: fixed;')

  let amount = $('#wiAmt').val()
  let token = $('#_ta4ka2na').val()
  let url = $('#5rala').val() + 'api/withdraw'

  let data = {
    _token: token,
    amount: amount
  }

  $.ajax({
    method: 'POST',
    url: url,
    data: data,

    success: res => {
      res = JSON.parse(res)
      if (res.status === false) {
        $('#baError').attr('style', 'display: block;')
        $('#baError').html(res.message)

        $('#baButton').removeAttr('disabled')

        e.target.removeAttribute('style')
        $('#baLoader').attr('style', 'display: none;')
        $('#error').attr('style', 'display: block;')
        $('#error').html('<strong>Error</strong>')
        setInterval(() => {
          $('#error').attr('style', 'display: none;')
        }, 2000)
      } else {
        $('#message').html('Withdrawal Request Successfully')
        $('#message').attr('style', 'display: block;')

        $('#baButton').removeAttr('disabled')
        e.target.removeAttribute('style')
        $('#baLoader').attr('style', 'display: none;')

        setInterval(() => {
          $('#message').attr('style', 'display: none;')
        }, 3000)
      }
    },
    error: error => {
      $('#baError').attr('style', 'display: block;')
      $('#baError').html(
        '<strong>Oops!</strong> Something went wrong. Please try again'
      )

      $('#baButton').removeAttr('disabled')
      e.target.removeAttribute('style')
      $('#baLoader').attr('style', 'display: none;')
      $('#error').attr('style', 'display: block;')
      $('#error').html('<strong>Error</strong>')
      setInterval(() => {
        $('#error').attr('style', 'display: none;')
      }, 2000)

      console.log(error)
    }
  })
})

// Forgot password
$('#fpForm').submit(function (e) {
  e.preventDefault()
  e.target.setAttribute('style', 'opacity: 0.3')

  $('#fpError').attr('style', 'display: none;')
  $('#fpLoader').attr('style', 'display: block; position: absolute;')

  let email = $('#fpemail').val()
  let token = $('#_ta4ka2na').val()
  let url = $('#5rala').val() + 'api/forgot-password'

  let data = {
    _token: token,
    email: email
  }

  $.ajax({
    method: 'POST',
    url: url,
    data: data,

    success: res => {
      res = JSON.parse(res)
      if (res.status === false) {
        $('#fpError').attr('style', 'display: block;')
        $('#fpError').html(res.message)

        e.target.removeAttribute('style')
        $('#fpLoader').attr('style', 'display: none;')
      } else {
        let link = email.split('@')[1]
        $('#fpForm').html(
          `<p>A password reset link has been sent to <a href="#">${email}</a></p>`
        )
        e.target.removeAttribute('style')
        $('#fpLoader').attr('style', 'display: none;')
      }
    },
    error: error => {
      $('#fpError').attr('style', 'display: block;')
      $('#fpError').html(
        '<strong>Oops!</strong> Something went wrong. Please try again'
      )
      e.target.removeAttribute('style')
      $('#fpLoader').attr('style', 'display: none;')
      console.log(error)
    }
  })
})

$(document).ready(function () {
  setInterval(() => {
    $('#error').attr('style', 'display: none;')
  }, 4000)
  setInterval(() => {
    $('#message').attr('style', 'display: none;')
  }, 4000)
})
