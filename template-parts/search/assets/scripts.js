document.addEventListener('DOMContentLoaded', function () {
  var input = document.getElementById('search-input')
  var submit = document.querySelector('.search-submit')
  input.addEventListener('input', function () {
    submit.href = '/?s=' + encodeURIComponent(input.value)
  })

  // enter key event for search input
  input.addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
      event.preventDefault()
      submit.click()
    }
  })

  // save search history
  const searchHistory = JSON.parse(localStorage.getItem('search-history')) || []
  if (!searchHistory.includes(input.value) && input.value.trim() !== '') {
    searchHistory.push(input.value)
    localStorage.setItem('search-history', JSON.stringify(searchHistory))
    if (searchHistory.length > 10) {
      searchHistory.shift() // keep only the last 10 searches
    }
    if (window?._SearchHandler) {
      window._SearchHandler.generateRecommendList() // class definition is in the header scripts.js
    }
  }
})
