const translate = async phrase => {
  const res = await $.get(`app.php?phrase=${phrase}`)
  return res || phrase
}

const onTextChange = async () => {
  const phrase = $('#phrase').val()
  const translated = await translate(phrase)
  $('#translation').text(translated)
}

$('#phrase').keyup(onTextChange)
