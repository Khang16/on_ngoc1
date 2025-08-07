document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.querySelector('#blog-search-input')
  const searchButton = document.querySelector('.blog-search svg')

  if (searchInput && searchButton) {
    // handle search
    function handleSearch() {
      const searchValue = searchInput.value.trim()
      if (searchValue) {
        // logic to handle search
        window.location.href = `/?s=${encodeURIComponent(searchValue)}`
      }
    }

    searchButton.addEventListener('click', function () {
      handleSearch()
    })

    searchInput.addEventListener('keypress', function (event) {
      if (event.key === 'Enter') {
        event.preventDefault()
        handleSearch()
      }
    })

  }
})
