document.addEventListener('DOMContentLoaded', function () {
  console.log('Launch Date:', launchDate)
  // Lấy ngày đếm ngược từ PHP
  // Đảm bảo launchDate là string ISO hoặc định dạng hợp lệ cho Safari
  let launchDateTime
  if (typeof launchDate === 'string' && launchDate.includes('-')) {
    // Safari không parse được 'YYYY-MM-DD HH:mm:ss', cần thay ' ' thành 'T'
    const safeDate = launchDate.replace(' ', 'T')
    launchDateTime = new Date(safeDate).getTime()
  } else {
    launchDateTime = new Date(launchDate).getTime()
  }

  function updateCountdown() {
    // Lấy thời gian hiện tại
    const now = new Date().getTime()

    // Tìm khoảng cách giữa thời gian hiện tại và ngày launch
    const distance = launchDateTime - now

    // Tính toán ngày, giờ, phút, giây
    const days = Math.floor(distance / (1000 * 60 * 60 * 24))
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))

    // Cập nhật các phần tử HTML
    const daysElem = document.getElementById('days')
    const hoursElem = document.getElementById('hours')
    const minutesElem = document.getElementById('minutes')
    if (daysElem && hoursElem && minutesElem) {
      daysElem.innerHTML = days < 10 ? '0' + days : days
      hoursElem.innerHTML = hours < 10 ? '0' + hours : hours
      minutesElem.innerHTML = minutes < 10 ? '0' + minutes : minutes
    }

    // Nếu đếm ngược kết thúc
    if (distance < 0) {
    //   clearInterval(countdownTimer)
      if (daysElem && hoursElem && minutesElem) {
        daysElem.innerHTML = '00'
        hoursElem.innerHTML = '00'
        minutesElem.innerHTML = '00'
      }
    }
  }

  // init
  updateCountdown()

  const countdownTimer = setInterval(updateCountdown, 1000 * 60) // Cập nhật mỗi phút
})


// Đăng ký sự kiện click cho nút đăng ký
document.getElementById('subscribe-btn').addEventListener('click', function (e) {
  e.preventDefault()
  var email = document.getElementById('subscribe-email').value.trim()
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  var loading = document.getElementById('subscribe-loading')
  var message = document.getElementById('subscribe-message')
  var btn = document.getElementById('subscribe-btn')
  message.textContent = ''
  message.className = 'subscribe-message'

  if (!email) {
    message.textContent = 'Vui lòng nhập email!'
    message.classList.add('error')
    return
  }
  if (!emailRegex.test(email)) {
    message.textContent = 'Email không hợp lệ!'
    message.classList.add('error')
    return
  }

  loading.style.display = 'inline-block'
  loading.innerHTML = '' // spinner only
  btn.style.pointerEvents = 'none'
  btn.style.opacity = '0.7'
  message.textContent = ''

  var formData = new FormData()
  // Lấy các trường hidden từ cf7Data nếu có
  if (typeof cf7Data !== 'undefined') {
    for (var key in cf7Data) {
      if (cf7Data.hasOwnProperty(key)) {
        formData.append(key, cf7Data[key])
      }
    }
  }
  formData.append('your-email', email)

  // Lấy ID form từ biến cf7Data
  const formId = cf7Data['_wpcf7']
  
if (typeof grecaptcha !== 'undefined' && grecaptcha.execute) {
  grecaptcha.ready(function() {
    grecaptcha.execute('6LdFJZMrAAAAANXiCXiqz4Uf0Rn8wwKObV89dnx2').then(function(token) {
      formData.append('_wpcf7_recaptcha_response', token);
      sendCF7Ajax(formData, formId, loading, btn, message, email);
    });
  });
} else {
  // fallback nếu không có grecaptcha
  sendCF7Ajax(formData, formId, loading, btn, message, email);
}
return; // Đợi token rồi mới gửi

  function sendCF7Ajax(formData, formId, loading, btn, message, email) {
    fetch(`/wp-json/contact-form-7/v1/contact-forms/${formId}/feedback`, {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        loading.style.display = 'none'
        btn.style.pointerEvents = ''
        btn.style.opacity = ''
        if (data.status === 'mail_sent') {
          message.textContent = 'Đăng ký thành công!'
          message.classList.add('success')
          document.getElementById('subscribe-email').value = ''
          setTimeout(function () {
            message.textContent = ''
            message.className = 'subscribe-message'
          }, 3000)
        } else if (data.status === 'spam') {
          message.textContent = 'Spam!!!'
          message.classList.add('error')
        } else {
          message.textContent = 'Có lỗi xảy ra!'
          message.classList.add('error')
        }
      })
      .catch(() => {
        loading.style.display = 'none'
        btn.style.pointerEvents = ''
        btn.style.opacity = ''
        message.textContent = 'Có lỗi xảy ra!'
        message.classList.add('error')
      })
  }
})
