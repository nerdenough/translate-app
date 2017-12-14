const translate = phrase => $.get(`app.php?phrase=${phrase}`)

const onTextChange = async () => {
  const phrase = $('#phrase').val()
  const res = await translate(phrase)

  if (!res.length) {
    return $('#translation').text('')
  }

  const data = JSON.parse(res);
  return $('#translation').text(data.join('\n'))
}

$('#phrase').keyup(onTextChange)
