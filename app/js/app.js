// Finds suggestions by making a GET request to the server and listing out any
// possible translations provided in the response.
const findSuggestions = async () => {
  const phrase = $('#phrase').val()
  const res = await $.get(`app.php?phrase=${phrase}`)

  if (!res.length) {
    return $('#suggestions').html('Suggestions will be filtered as you type into the English phrase box above.')
  }

  const data = JSON.parse(res)
  if (!data.length) {
    return $('#suggestions').html('No suggestions to show')
  }

  const html = data.map(d => `<li>${d.phrase}: ${d.translation}</li>`).join('');
  return $('#suggestions').html(html)
}


// Adds a translation by making a POST request to the server.
const addTranslation = async () => {
  const phrase = $('#phrase').val()
  const translation = $('#translation').val()

  $('#success').hide()
  $('#error').hide()

  if (!phrase.length || !translation.length) {
    return $('#error').text('You must specify a phrase and translation').show()
  }

  const res = await $.post('app.php', { phrase, translation })

  if (res === 'success') {
    $('#success').show()
  }
}

// Event handlers
$('#phrase').keyup(findSuggestions)
$('#add').click(addTranslation)
