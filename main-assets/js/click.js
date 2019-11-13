// Pay clicker
$('#click-demon').click(function (e) {
  applyClEff(true)

  let url = $('#5rala').val() + 'api/clicked'
  let token = $('#_ta4ka2na').val()

  let data = {
    _token: token
  }

  $.ajax({
    method: 'POST',
    url: url,
    data: data,

    success: res => {
      console.log(res)
      $('#click-mutant').html(`
        <p>Click/Tap on the button below and start earning. <br><span style="color: red">Note:</span> Do not right click on
        the button to open in a new tab, you will not be paid for that.</p>
        ${res}
      `)
      applyClEff(false)
    },
    error: error => {
      console.log(error)
      applyClEff(false)

      $('#error').attr('style', 'display: block;')
      $('#error').html(
        '<strong>Oops!</strong> Something went wrong. Please try again'
      )
      setInterval(() => {
        $('#error').attr('style', 'display: none;')
      }, 3000)
    }
  })
})

if (document.getElementById('click-demon') == undefined) {
  $('#click-magic').click(function (e) {
    e.preventDefault();

    applyClEff(true)

    let url = $('#5rala').val() + 'api/clicked'
    let token = $('#_ta4ka2na').val()

    let data = {
      _token: token,
      skip: true,
    }

    $.ajax({
      method: 'POST',
      url: url,
      data: data,

      success: res => {
        console.log(res)
        $('#click-mutant').html(`
        <p>Click/Tap on the button below and start earning. <br><span style="color: red">Note:</span> Do not right click on
        the button to open in a new tab, you will not be paid for that.</p>
        ${res}
      `)
        applyClEff(false)
      },
      error: error => {
        console.log(error)
        applyClEff(false)

        $('#error').attr('style', 'display: block;')
        $('#error').html(
          '<strong>Oops!</strong> Something went wrong. Please try again'
        )
        setInterval(() => {
          $('#error').attr('style', 'display: none;')
        }, 3000)
      }
    })
  });
}

function applyClEff(req) {
  if (req === true) {
    $('#main-half').attr('style', 'opacity: 0.5')
    $('#click-loader').attr('style', 'display: block; position: fixed;')
  } else {
    $('#main-half').removeAttr('style')
    $('#click-loader').attr('style', 'display: none;')
  }
}